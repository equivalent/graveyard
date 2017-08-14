defmodule Eq8.Factory do
  use ExMachina.Ecto, repo: Eq8.Repo
  alias Eq8.SNSNotification
  alias Eq8.Document

  def notification_factory do
    %SNSNotification{

    }
  end

  def document_factory do
    %Document{

    }
  end

  def with_document(%SNSNotification{} = notification) do
    insert_pair(:document, sns_notification: notification)
    notification
  end


  def with_filename(%Document{} = document) do
    %Document{document | filename: "Screenshot from 2016-11-27 17-32-03.png"}
  end


  #def user_factory do
    #%MyApp.User{
      #name: "Jane Smith",
      #email: sequence(:email, &"email-#{&1}@example.com"),
    #}
  #end

  #def article_factory do
    #%MyApp.Article{
      #title: "Use ExMachina!",
      ## associations are inserted when you call `insert`
      #author: build(:user),
    #}
  #end

  #def comment_factory do
    #%MyApp.Comment{
      #text: "It's great!",
      #article: build(:article),
    #}
  #end
end
