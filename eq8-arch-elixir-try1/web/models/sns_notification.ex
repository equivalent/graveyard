defmodule Eq8.SNSNotification do
  use Eq8.Web, :model

  schema "sns_notifications" do
    field :message, :string
    belongs_to :document, Eq8.Document

    timestamps()
  end

  @doc """
  Builds a changeset based on the `struct` and `params`.
  """
  def changeset(struct, params \\ %{}) do
    struct
    |> cast(params, [:message])
    |> validate_required([:message])
  end

  def s3_data(struct) do
    o = struct.message |> Poison.Parser.parse!
    %{"key"=>filename, "size"=> size } = List.last(o["Records"])["s3"]["object"]
    %{filename: filename, size: size}
  end
end
