defmodule Eq8.AwsClient do
  defmodule Mock do
    def head_object("xxxxxxxxxxxxxxx.png") do
      %{headers: [{"x-amz-id-2","yQKurzVIApk49HcdIIHyZLp816MU+fOAFWT6k1dgjQ1lVZzRYvN7PtP0LIWvE8iFBINsPxe+7Vc="},
        {"x-amz-request-id", "822A7E0424225D23"},
        {"Date", "Thu, 25 May 2017 22:03:09 GMT"},
        {"Last-Modified", "Thu, 25 May 2017 21:42:28 GMT"},
        {"ETag", "\"6f04733d6671e8abd7013040e3368997\""},
        {"x-amz-meta-original_name", "Screenshot from 2016-11-27 17-32-03.png"},
        {"Accept-Ranges", "bytes"}, {"Content-Type", "foo"},
        {"Content-Length", "612391"}, {"Server", "AmazonS3"}], status_code: 200}
    end
  end

  defmodule Real do
    alias Eq8.SNSNotificationController.Const, as: Const

    def head_object(filename) do
      ExAws.S3.head_object(Const.bucket(), filename) |> ExAws.request!
    end
  end
end
