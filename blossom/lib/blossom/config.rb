module Blossom
  class Config
    attr_writer :id_generator, :msg_decryptor, :msg_encryptor, :local_assets_folder,
      :aws_access_key_id, :aws_secret_access_key, :aws_region,
      :dynamo_db_table, :aws_s3_bucket, :tag_people_options

    def self.config_file(pathname)
      raise("No such file #{pathname}") unless pathname.exist?
      hash = YAML.load_file(pathname)

      self.new.tap do |conf|
        hash.each do |key, value|
          begin
            conf.send(:"#{key}=", value)
          rescue NoMethodError
            raise "Option #{key} is not valid for config file #{pathname}"
          end
        end
      end
    end

    def local_store
      @local_store ||= Sequel.connect("sqlite://#{local_assets_path.join('blossomDB.sqlite').to_s}")
    end

    def s3
      @s3 ||= OpenStruct.new({
        client: Aws::S3::Client.new(access_key_id: aws_access_key_id, secret_access_key: aws_secret_access_key, region: aws_region),
        bucket: aws_s3_bucket
      })
    end

    def remote_store
      @remote_store ||= begin
        client = Aws::DynamoDB::Client.new(access_key_id: aws_access_key_id, secret_access_key: aws_secret_access_key, region: aws_region)
        Aws::DynamoDB::Table.new(dynamo_db_table, client: client)
      end
    end

    def migrate
      Sequel::Migrator.run(local_store, Pathname.new(File.dirname(__FILE__)).join( '../../migrations/'), :use_transactions=>true)
    end

    def aws_credentials
      #@aws_credentials ||= Aws::Credentials.new(access_key_id: ENV['AWS_ACCESS_KEY_ID'], secret_access_key: ENV['AWS_SECRET_ACCESS_KEY'] )
      @aws_credentials ||= Aws::Credentials.new
    end

    def id_generator
      @id_generator || ->{ SecureRandom.hex }
    end

    def msg_decryptor
      @msg_decryptor || raise('todo')
    end

    def msg_encryptor
      @msg_encryptor || raise('todo')
    end

    def local_assets_path
      Pathname.new(local_assets_folder)
    end

    def tag_people_options
      @tag_people_options ||= ENV.fetch(TAG_PERSON_OPTIONS)
    end

    private
      def local_assets_folder
        @local_assets_folder || raise('Please set local_assets_folder')
      end

      def aws_access_key_id
        @aws_access_key_id || ENV['AWS_ACCESS_KEY_ID'] || raise('Please set aws_access_key_id')
      end

      def aws_secret_access_key
        @aws_secret_access_key || ENV['AWS_SECRET_ACCESS_KEY'] || raise('Please set aws_secret_access_key')
      end

      def aws_region
        @aws_region || ENV['AWS_REGION'] || raise('Please set aws_region')
      end

      def dynamo_db_table
        @dynamo_db_table || ENV['DYNAMO_DB_TABLE'] || raise('Please set dynamo_db_table')
      end

      def aws_s3_bucket
        @aws_s3_bucket || ENV['AWS_S3_BUCKET'] || raise('Please set aws_s3_bucket')
      end
  end
end
