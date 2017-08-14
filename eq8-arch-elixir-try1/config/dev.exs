use Mix.Config

# For development, we disable any cache and enable
# debugging and code reloading.
#
# The watchers configuration can be used to run external
# watchers to your application. For example, we use it
# with brunch.io to recompile .js and .css sources.
config :eq8, Eq8.Endpoint,
  http: [port: 4000],
  debug_errors: true,
  code_reloader: true,
  check_origin: false,
  watchers: [node: ["node_modules/brunch/bin/brunch", "watch", "--stdin",
                    cd: Path.expand("../", __DIR__)]]


# Watch static and templates for browser reloading.
config :eq8, Eq8.Endpoint,
  live_reload: [
    patterns: [
      ~r{priv/static/.*(js|css|png|jpeg|jpg|gif|svg)$},
      ~r{priv/gettext/.*(po)$},
      ~r{web/views/.*(ex)$},
      ~r{web/templates/.*(eex)$}
    ]
  ]

# Do not include metadata nor timestamps in development logs
config :logger, :console, format: "[$level] $message\n"

# Set a higher stacktrace during development. Avoid configuring such
# in production as building large stacktraces may be expensive.
config :phoenix, :stacktrace_depth, 20

# Configure your database
config :eq8, Eq8.Repo,
  adapter: Ecto.Adapters.Postgres,
  username: "eq8",
  database: "eq8_dev",
  hostname: "localhost",
  pool_size: 10
  # password is in dev.secrets.ex

config :ex_aws,
  debug_requests: true,
  access_key_id: "AKIAJYEXMC6Q4BCSBONA",
  region: "eu-west-1"
  # secret_access_key is in dev.secrets.ex

config :eq8, :sns_notification,
  topic: "arn:aws:sns:eu-west-1:800571264173:eq8devput",
  endpoint_token: "soThatNoOneSendYouMaliciousNotifications",
  bucket: "eq8-dev"

config :eq8, :aws_client, Eq8.AwsClient.Real

import_config "dev.secret.exs"
