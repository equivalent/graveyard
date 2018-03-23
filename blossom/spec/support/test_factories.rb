module TestFactories
  class CollectionTraits
    attr_reader :collection

    def initialize(collection:)
      @collection = collection
    end

    def builded
      collection.build_new
    end

    def nodoc
      collection.status = Blossom::Collection::NODOC_STATUS
    end

    def in_processed
      collection.status = Blossom::Collection::PROCESSED_STATUS
    end

    def in_preparation
      collection.status = Blossom::Collection::PREPARATION_STATUS
    end
  end

  def create_local(what, *traits, **args)
    build(what, *traits, **args).local_mapper.put
  end

  def build(what, *traits, **args)
    case what
    when :document
      document = Blossom::Document.new(config: test_config)
      args.each do |accessor_name, value|
        document.send("#{accessor_name}=".to_sym, value)
      end
      document
    when :collection
      collection = Blossom::Collection.new(config: test_config)
      # defaults
      collection.title = 'foo'
      # overides
      col_trait_processor = CollectionTraits.new(collection: collection)
      traits.each do |trait|
        col_trait_processor.send(trait)
      end

      args.each do |accessor_name, value|
        collection.send("#{accessor_name}=".to_sym, value)
      end

      collection
    end
  end
end
