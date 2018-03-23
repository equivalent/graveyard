require 'securerandom'
require 'pathname'
require 'fileutils'
require 'forwardable'
require 'erb'
require 'yaml'
require "sequel"
require "sqlite3"
require 'inputs'
require 'aws-sdk-s3'
require 'aws-sdk-dynamodb'
require 'blossom/version'
require 'blossom/collection'
require 'blossom/collection_processor'
require 'blossom/collection_dynamo_mapper'
require 'blossom/collection_sql_mapper'
require 'blossom/document'
require 'blossom/config'
require 'blossom/tag'
Dir.glob('./lib/blossom/tag/*').each { |f| require f }

Sequel.extension :migration

module Blossom
  DESC_FILE_NAME = 'BLOOSOM_DESC.md'

  def self.config
    @config ||= Blossom::Config.config_file(Pathname.new(Dir.home).join('.blossom.yml'))
  end

  def self.run
    loop do
      case Inputs.pick([
        MainMenu.new_collection,
        MainMenu.existing_collection,
        MainMenu.setup,
        'Exit'
      ])

      when MainMenu.new_collection
        cp = Operations.write_new_collection(config: config)
        if Inputs.yn("Do you want to do file upload ?")
          cp.prepare

          if Inputs.yn("Ready to upload ?")
            cp.process
          end
        end
      when MainMenu.existing_collection
        collections = Blossom::CollectionSqlMapper.in_preparation(config: config)
        if collections.any?
          selection =  Inputs.pick(collections.map(&:menu_key))
          collection = collections.detect { |c| c.menu_selection(selection) }
          cp = CollectionProcessor.new(config: config, collection: collection)

          if Inputs.yn("Ready to upload ?")
            cp.process
          end
        else
          puts "No collections in pending"
        end
      when MainMenu.setup
        config.migrate
      when 'Exit'
        break
      end
    end
  end

  def self.templates_path
    Pathname.new(File.expand_path('blossom/templates', __dir__).to_s)
  end

  module MainMenu
    extend self

    def new_collection
      'New collection'
    end

    def existing_collection
      'Finish Existing collection'
    end

    def setup
      "Setup"
    end
  end

  module Operations
    extend self

    def write_new_collection(config:)
      tags = Operations.ask_for_tags
      collection = Collection.new(config: config).tap do |c|
        c.build_new
        c.title = Inputs.name("Collection Title")
        c.description = Inputs.name!("Collection Description")
        c.year = Inputs.name("Collection Year")
        c.month = Inputs.name("Collection Month")
        c.day = Inputs.name("Collection day")
      end

      cp = CollectionProcessor.new(config: config, collection: collection)
      cp.write_db

      puts %Q{Collection #{collection.filekey} Created}

      cp
    end

    def ask_for_tags
      tags = []
      while Inputs.yn("Add another tag ?")
        tag = Tag.new(Inputs.pick(Tag.type_names))
      end
      tags
    end

  end
end
