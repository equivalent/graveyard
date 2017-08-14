defmodule Eq8.Repo.Migrations.RenameDocumentColumns do
  use Ecto.Migration

  def change do
    alter table(:documents) do
      remove :raw_metadata
      add :original_name, :string
      add :s3_content_length, :string
      add :s3_content_type, :string
      add :s3_date, :utc_datetime
    end
  end
end
