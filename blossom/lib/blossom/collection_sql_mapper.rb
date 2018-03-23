module Blossom
  class CollectionSqlMapper
    extend Forwardable

    def initialize(config:, collection:)
      @config = config
      @collection = collection
    end

    def self.all(config: )
      config
        .local_store[:collections]
        .all
        .map { |item| map_to_collection(item: item, config: config) }
    end

    def self.in_preparation(config:)
      config
        .local_store[:collections]
        .where(status: Collection::PREPARATION_STATUS)
        .map { |item| map_to_collection(item: item, config: config) }
    end

    def self.map_to_collection(item:, config:)
      Collection
        .new(config: config)
        .tap do |c|
          c.id = item.fetch(:id)
          c.filekey = item.fetch(:filekey)
          c.title = item.fetch(:title)
          c.description = item.fetch(:description)
          c.year = item.fetch(:year)
          c.month = item.fetch(:month)
          c.day = item.fetch(:day)
          c.status = item.fetch(:status)
          c.enc_private_msg = item.fetch(:enc_private_msg)
          c.created_at = item.fetch(:created_at)

          JSON
            .parse(item.fetch(:documents_serial))
            .map { |serial_document| Document.from_serial(serial_document, config: config) }
            .each { |document| c.documents << document }
        end
    end

    def destroy
      config
        .local_store[:collections]
        .delete
    end

    def put
      documents_serial = collection
        .documents
        .map(&:to_serial)
        .to_json

      change = {
        filekey: collection.filekey,
        title: collection.title,
        description: collection.description,
        enc_private_msg: collection.enc_private_msg,
        year: collection.year,
        month: collection.month,
        day: collection.day,
        created_at: Time.now,
        status: collection.status,
        documents_serial: documents_serial
      }

      if collection.id
        collections_table.where(id: collection.id).update(change)
      else
        collection.id = collections_table.insert(change)
      end
    end

    private
      attr_reader :config, :collection
      def_delegators :config, :local_store

      def collections_table
        local_store[:collections]
      end
  end
end
