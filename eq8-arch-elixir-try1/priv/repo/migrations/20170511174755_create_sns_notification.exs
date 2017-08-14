defmodule Eq8.Repo.Migrations.CreateSNSNotification do
  use Ecto.Migration

  def change do
    create table(:sns_notifications) do
      add :message, :text

      timestamps()
    end

  end
end
