defmodule Eq8.Repo.Migrations.AddFilenameARawMetadataToDocuments do
  use Ecto.Migration

  def change do
    alter table(:documents) do
      add :filename, :string
      add :raw_metadata, :text
    end
  end
end
