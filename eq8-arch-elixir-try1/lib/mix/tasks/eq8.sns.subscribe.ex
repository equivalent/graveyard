defmodule Mix.Tasks.Eq8.Sns.Subscribe do
  alias Eq8.SNSNotificationController.Const, as: Const
  use Mix.Task

  @shortdoc "Sends a greeting to us from Hello Phoenix"

  @moduledoc """
  This is where we would put any loeng form documentation or doctests.
  """

  def run(endpoint) do
    Mix.Tasks.App.Start.run([])

    Mix.shell.info "registering endpoint '#{endpoint}' to sns topic '#{Const.topic()}'"
    case ExAws.SNS.subscribe(Const.topic(), "https", "#{endpoint}/api/sns?token=#{Const.endpoint_token()}") |> ExAws.request do
     {:error, msg} -> Mix.shell.info inspect(msg)
     {:ok, _} -> Mix.shell.info "Ok"
    end
  end
end
