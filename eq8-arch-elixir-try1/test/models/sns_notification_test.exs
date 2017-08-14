defmodule Eq8.SNSNotificationTest do
  use Eq8.ModelCase

  alias Eq8.SNSNotification

  @valid_attrs %{message: "some content"}
  @invalid_attrs %{}

  test "changeset with valid attributes" do
    changeset = SNSNotification.changeset(%SNSNotification{}, @valid_attrs)
    assert changeset.valid?
  end

  test "changeset with invalid attributes" do
    changeset = SNSNotification.changeset(%SNSNotification{}, @invalid_attrs)
    refute changeset.valid?
  end
end
