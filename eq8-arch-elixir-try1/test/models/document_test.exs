defmodule Eq8.DocumentTest do
  use Eq8.ModelCase

  alias Eq8.Document

  @valid_attrs %{name: "some content"}
  @invalid_attrs %{}

  test "changeset with valid attributes" do
    changeset = Document.changeset(%Document{}, @valid_attrs)
    assert changeset.valid?
  end

  test "changeset with invalid attributes" do
    changeset = Document.changeset(%Document{}, @invalid_attrs)
    refute changeset.valid?
  end
end
