defmodule ProcessSNSNotificationTest do
  use ExUnit.Case
  alias Eq8.ProcessSNSNotification
  alias Eq8.Repo
  alias Eq8.SNSNotification
  import Eq8.Factory

  setup do
    :ok = Ecto.Adapters.SQL.Sandbox.checkout(Repo)
    Ecto.Adapters.SQL.Sandbox.mode(Repo, { :shared, self() })
  end

  defmodule SNSNotificationFactory do
    def s3_notification_1_file_name, do: "Screenshot+from+2016-11-27+17-30-20.png"

    def s3_put_notification_1() do
      s3_put_notification_1(filename: s3_notification_1_file_name(), event_name: "ObjectCreated:Put")
    end

    def s3_put_notification_err_multi_body() do
      s3_put_notification_err_multi_body(filename: s3_notification_1_file_name(), event_name: "ObjectCreated:Put")
    end

    def s3_put_notification_1(filename: filename, event_name: event_name) do
      message = ~s({"Records":[{"eventVersion":"2.0","eventSource":"aws:s3","awsRegion":"eu-west-1","eventTime":"2017-05-12T01:08:31.379Z","eventName":"#{event_name}","userIdentity":{"principalId":"A2NAC1OA777KWC"},"requestParameters":{"sourceIPAddress":"46.246.29.155"},"responseElements":{"x-amz-request-id":"20585AE259062BF7","x-amz-id-2":"2ZfH34Id6qaBxdTx+/npgPfE9XUvnJwzmYAT8ECQUkNSxbiU+owpn/IpFqhZRrSXHbOJq1788xU="},"s3":{"s3SchemaVersion":"1.0","configurationId":"eq8notify","bucket":{"name":"eq8-dev","ownerIdentity":{"principalId":"A2NAC1OA777KWC"},"arn":"arn:aws:s3:::eq8-dev"},"object":{"key":"#{filename}","size":123940,"eTag":"394cbdcdec9686db4894b41ed9417c46","sequencer":"0059150B0F53071170"}}}]})
      %SNSNotification{message: message} |> SNSNotification.changeset() |> Repo.insert!
    end

    def s3_put_notification_err_multi_body(filename: filename, event_name: event_name) do
      message = ~s({"Records":[{"eventVersion":"2.0","eventSource":"aws:s3","awsRegion":"eu-west-1","eventTime":"2017-05-12T01:08:31.379Z","eventName":"#{event_name}","userIdentity":{"principalId":"A2NAC1OA777KWC"},"requestParameters":{"sourceIPAddress":"46.246.29.155"},"responseElements":{"x-amz-request-id":"20585AE259062BF7","x-amz-id-2":"2ZfH34Id6qaBxdTx+/npgPfE9XUvnJwzmYAT8ECQUkNSxbiU+owpn/IpFqhZRrSXHbOJq1788xU="},"s3":{"s3SchemaVersion":"1.0","configurationId":"eq8notify","bucket":{"name":"eq8-dev","ownerIdentity":{"principalId":"A2NAC1OA777KWC"},"arn":"arn:aws:s3:::eq8-dev"},"object":{"key":"#{filename}","size":123940,"eTag":"394cbdcdec9686db4894b41ed9417c46","sequencer":"0059150B0F53071170"}}},{}]})
      add_message_to_sns_notificion(message)
    end

    defp add_message_to_sns_notificion(message) do
      %SNSNotification{message: message} |> SNSNotification.changeset() |> Repo.insert!
    end
  end

  def start_link(notification) do
    {:ok, pid} = ProcessSNSNotification.start_link(notification.id)
    pid
  end

  def pull_metadata(pid) do
    GenServer.cast(pid, :pull_metadata)
  end


  def process_to_document(pid) do
    ProcessSNSNotification.process_to_document(pid)
  end

  describe "when SNSNotification has valid s3 put message" do
    setup do
      {:ok, notification: SNSNotificationFactory.s3_put_notification_1()}
    end

    test "process_to_document should create document with parsed filename", context do
      notification = context[:notification]

      pid = start_link(notification)

      process_to_document(pid)

      :sys.get_state(pid)

      notification = Repo.get(SNSNotification, notification.id)

      notification = Repo.preload(notification, :document)

      a = SNSNotificationFactory.s3_notification_1_file_name()
      b = notification.document.filename
      assert ^a = b
    end
  end


  describe "process_to_document" do
    setup do
      {:ok, notification: SNSNotificationFactory.s3_put_notification_1()}
    end

    test "should save metadata info" do
      document = insert(:document, filename: "xxxxxxxxxxxxxxx.png")
      notification = insert(:notification, document: document)

      pid = start_link(notification)
      pull_metadata(pid)
      :sys.get_state(pid)

      notification = Repo.get(SNSNotification, notification.id)
      notification = Repo.preload(notification, :document)

      on = notification.document.original_name
      cl = notification.document.s3_content_length
      ct = notification.document.s3_content_type
      sd = notification.document.s3_date |> Timex.format!("%a, %d %b %Y %H:%M:%S %Z", :strftime)

      assert ^on = "Screenshot from 2016-11-27 17-32-03.png"
      assert ^cl = "612391"
      assert ^ct = "foo"
      assert ^sd = "Thu, 25 May 2017 22:03:09 Etc/UTC"
    end
  end
end
