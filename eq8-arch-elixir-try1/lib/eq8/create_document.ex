defmodule Eq8.ProcessSNSNotification do
  defmodule SNSMessageMultipleBodies do
    defexception message: "SNS message contains more than one record"
  end

  use GenServer
  alias Eq8.SNSNotification
  alias Eq8.Document
  alias Eq8.Repo

  @aws_client Application.get_env(:eq8, :aws_client)

  # assync call
  def process_to_document(pid) do
    GenServer.cast(pid, :process_to_document)
  end

  def start_link(notification_id) do
    GenServer.start_link(__MODULE__, notification_id)
  end

  def handle_cast(:process_to_document, notification_id) do
    notification = get_notification(notification_id)
    parsed_message = notification.message |> Poison.Parser.parse!

    if length(record_list = parsed_message["Records"]) !=1 do
      raise SNSMessageMultipleBodies
    end
    record = List.last(record_list)

    if record["eventName"] != "ObjectCreated:Put" do
      raise "SNS message not create message from S3"
    end
    filename = record["s3"]["object"]["key"]

    changeset = %Document{filename: filename} |> Document.step1_changeset
    document = Repo.insert!(changeset)

    Repo.preload(notification, :document)
    |> SNSNotification.changeset
    |> Ecto.Changeset.put_assoc(:document, document)
    |> Repo.update!

    {:noreply, {SNSNotification, notification.id}}
  end

  def handle_cast(:pull_metadata, notification_id) do
    notification = get_notification(notification_id)
    document = Repo.preload(notification, :document).document
    headers = @aws_client.head_object(document.filename).headers |> Enum.into(%{})

    document
    |> Document.step2_changeset(%{
      original_name: headers["x-amz-meta-original_name"],
      s3_content_length: headers["Content-Length"],
      s3_content_type: headers["Content-Type"],
      s3_date: headers["Date"] |> Timex.parse!("%a, %d %b %Y %H:%M:%S %Z", :strftime)
    })
    |> Repo.update!

    {:noreply, {SNSNotification, notification.id}}
  end

  defp get_notification(id) do
    Repo.get(SNSNotification, id)
  end
end
