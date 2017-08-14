defmodule Eq8.PageController do
  use Eq8.Web, :controller

  def index(conn, _params) do
    render conn, "index.html"
  end
end
