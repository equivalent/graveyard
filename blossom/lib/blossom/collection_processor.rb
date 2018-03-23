module Blossom
  class CollectionProcessor
    extend Forwardable

    def_delegators :config, :local_assets_path, :local_store, :remote_store

    def initialize(config:, collection:)
      @config = config
      @collection = collection
    end

    def write_db
      collection.set_to_no_doc_state
      write_to_local_db
      write_to_remote_db
    end

    def prepare
      FileUtils.mkdir_p(collection.preparation_path)
      write_blossom_desc(collection.preparation_path)
      collection.set_to_preparation_state
      write_to_local_db
      write_to_remote_db
    end

    def process
      FileUtils.mkdir_p(collection.processing_path.dirname)
      FileUtils.mv(collection.preparation_path, collection.processing_path.dirname)

      pd = processing_documents
      pd.each(&:validate!)

      pd.each do |document|
        document.sanitize
        document.local_upload(archive_local_path: collection.archive_local_path)
        document.remote_upload({
          archive_remote_path: collection.archive_remote_path,
          collection_key: collection.filekey,
          s3: config.s3,
        })
        collection.documents << document
      end

      collection.set_to_processed_state
      write_to_local_db
      write_to_remote_db
    end

    private
      attr_reader :config, :collection

      def processing_documents
        collection.processing_path
          .children
          .map { |f| Document.new(config: config).tap { |d| d.local_path = f} }
      end

      def write_blossom_desc(folder_path)
        File.open(folder_path.join(DESC_FILE_NAME), 'w') do |f|
          f.write(collection.blossom_desc)
          f.close
        end
      end

      def write_to_local_db
        collection.local_mapper.put
      end

      def write_to_remote_db
        collection.remote_mapper.put
      end
  end
end
