defmodule Eq8.Router do
  use Eq8.Web, :router

  pipeline :browser do
    plug :accepts, ["html"]
    plug :fetch_session
    plug :fetch_flash
    plug :protect_from_forgery
    plug :put_secure_browser_headers
  end

  pipeline :api do
    plug :accepts, ["json"]
  end

  pipeline :sns do
    plug :accepts, ["json"]
  end

  scope "/api/sns", Eq8 do
    pipe_through :sns

    post "/", SNSNotificationController, :create
  end

  scope "/", Eq8 do
    pipe_through :browser # Use the default browser stack

    get "/", PageController, :index
  end

  scope "/tomi", Eq8 do
    pipe_through :browser # Use the default browser stack

    get "/", TomiController, :index
  end


  # Other scopes may use custom stacks.
  # scope "/api", Eq8 do
  #   pipe_through :api
  # end
end
