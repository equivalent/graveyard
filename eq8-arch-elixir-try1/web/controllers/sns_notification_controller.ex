defmodule Eq8.SNSNotificationController do
  defmodule Const do
    def topic, do: Application.get_env(:eq8, :sns_notification)[:topic]
    def endpoint_token, do: Application.get_env(:eq8, :sns_notification)[:endpoint_token]
    def bucket, do: Application.get_env(:eq8, :sns_notification)[:bucket]
  end

  use Eq8.Web, :controller
  import Comeonin.Bcrypt, only: [dummy_checkpw: 0]
  alias Eq8.SNSNotification
  alias Eq8.Repo

  def create(conn, params) do
    if params["token"] == Const.endpoint_token() do
      handle_sns(sns_type(conn), conn, sns_json(conn))
    else
      dummy_checkpw()
      conn |> send_resp(401, "Not Authorized")
    end
  end

  #AWS SNS sends different types of messages to your endpoint.
  #This method helps to determin what type of message it is.
  #By official AWS SNS specs application should look for "x-amz-sns-message-type"
  #header first
  defp sns_type(conn) do
    type_header_tuple = conn.req_headers |> List.keyfind("x-amz-sns-message-type", 0)
    {"x-amz-sns-message-type", type } = type_header_tuple
    type
  end

  #When AWS SNS sends subscription confirmation type message to your application endpoint
  defp handle_sns("SubscriptionConfirmation", conn, sns_json) do
    confirm_subscription(sns_json["Token"])
    conn |> send_resp(200, "Subscribed")
  end

  # When AWS SNS sends "Notification" type message to your application endpoint
  defp handle_sns("Notification", conn, sns_json) do
    changeset = %SNSNotification{message: sns_json["Message"]} |> SNSNotification.changeset
    case Repo.insert(changeset) do
      {:ok, _} ->
        conn |> send_resp(201, "Notification Accepted")
      {:error, _changeset} ->
        conn |> send_resp(400, "Notification Not Accepted")
    end
  end

  # In case you ever receive different message typo.
  defp handle_sns(_, conn, _) do
    conn |> send_resp(400, "Unknown Action")
  end

  #After registering endpoint wint SNS, AWS will send SubscriptionConfirmation
  #type message with secret token. Your app have to respond with that token
  #in order do be suscribed to SNS.
  defp confirm_subscription(sns_token) do
    ExAws.SNS.confirm_subscription(Const.topic(), sns_token) |> ExAws.request
  end

  #JSON parse body of the request message.
  defp sns_json(conn) do
    {:ok, sns_body, _conn_details} = Plug.Conn.read_body(conn)
    Poison.Parser.parse!(sns_body)
  end
end
