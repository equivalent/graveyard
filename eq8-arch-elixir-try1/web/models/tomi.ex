defmodule Eq8.Tomi do
  use Eq8.Web, :model

  def kmd do
    {:ok, kmd_datetime} = Timex.parse(kmd_time_string(), "%Y-%m-%d %H:%M:%S", :strftime)
    kmd_datetime |> Timex.to_datetime
  end

  defp kmd_time_string do
    "2017-04-19 18:12:09"
  end
end
