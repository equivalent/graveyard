module Blossom
  class CollectionDynamoMapper
    extend Forwardable

    def initialize(config:, collection:)
      @config = config
      @collection = collection
    end

    def self.all(config: )
      config
        .remote_store
        .scan
        .items
        .map { |item| map_to_collection(item: item, config: config) }
    end

    def self.map_to_collection(item:, config:)
      Collection
        .new(config: config)
        .tap do |c|
          c.filekey = item["FileKey"]
          c.title = item["Title"]
          c.description = item["Description"]
          c.year = item["Year"]
          c.month = item["Month"]
          c.day = item["Day"]
          c.enc_private_msg = item["Encm"]
          c.status = item["Status"]

          item["Documents"]
            .map{ |sd| Document.from_serial(sd, config: config) }
            .each { |document| c.documents << document }
        end
    end

    def destroy
      config.remote_store.delete_item({
        key: {
          "FileKey" => collection.filekey,
        }
      })
    end

    def put
        resp = remote_store.put_item({
          item: {
            "FileKey" => collection.filekey,
            "Title" => collection.title,
            "Description" => collection.description,
            "Year" => collection.year,
            "Month" => collection.month,
            "Day" => collection.day,
            "Encm"=> collection.enc_private_msg,
            "Status" => collection.status,
            "Documents" => collection.documents.map(&:to_serial)
          },
        })

        resp.to_h
    end

    private
      attr_reader :config, :collection
      def_delegators :config, :remote_store
  end
end
