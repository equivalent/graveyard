use Mix.Config

# We don't run a server during test. If one is required,
# you can enable the server option below.
config :eq8, Eq8.Endpoint,
  http: [port: 4001],
  server: false

# Print only warnings and errors during test
config :logger, level: :warn


# Configure your database
config :eq8, Eq8.Repo,
  adapter: Ecto.Adapters.Postgres,
  username: "eq8",
  database: "eq8_test",
  hostname: "localhost",
  pool: Ecto.Adapters.SQL.Sandbox,
  ownership_timeout: 999999


config :eq8, :sns_notification,
  topic: "arn:aws:sns:eu-west-1:800571264173:eq8devput",
  endpoint_token: "soThatNoOneSendYouMaliciousNotifications",
  bucket: "eq8-dev"

import_config "dev.secret.exs"

config :eq8, :aws_client, Eq8.AwsClient.Mock
