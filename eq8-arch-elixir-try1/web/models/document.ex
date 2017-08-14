defmodule Eq8.Document do
  use Eq8.Web, :model

  schema "documents" do
    field :name, :string
    field :filename, :string
    field :original_name, :string
    field :s3_content_length, :string
    field :s3_content_type, :string
    field :s3_date, :utc_datetime
    has_one :sns_notification, Eq8.SNSNotification

    timestamps()
  end

  @doc """
  Builds a changeset based on the `struct` and `params`.
  """
  def changeset(struct, params \\ %{}) do
    struct
    |> cast(params, [:name])
    |> validate_required([:name])
  end

  def step2_changeset(struct, params \\ %{}) do
    struct
    |> cast(params, [:original_name, :s3_content_length, :s3_content_type, :s3_date])
    |> validate_required([:original_name, :s3_content_length, :s3_content_type, :s3_date])
  end

  def step1_changeset(struct, params \\ %{}) do
    struct
    |> cast(params, [:filename])
    |> validate_required([:filename])
  end
end
