defmodule Eq8.TomiView do
  use Eq8.Web, :view

  def kmd_time_diff do
    Eq8.Tomi.kmd
      |> Timex.from_now
  end
end
