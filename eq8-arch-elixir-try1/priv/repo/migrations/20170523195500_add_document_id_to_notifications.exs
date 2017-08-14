defmodule Eq8.Repo.Migrations.AddDocumentIdToNotifications do
  use Ecto.Migration

  def change do
    alter table(:sns_notifications) do
      add :document_id, references(:documents)
    end
  end
end
