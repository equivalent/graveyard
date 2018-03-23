module Blossom
  class Collection
    PREPARATION_STATUS = 'preparation'
    NODOC_STATUS = 'nodoc'
    PROCESSED_STATUS = 'processed'

    extend Forwardable
    attr_writer :year, :month, :day, :title, :description, :dec_private_msg, :enc_private_msg, :filekey, :status, :id
    attr_reader :title, :description, :id, :filekey, :status
    attr_accessor :created_at

    def initialize(config:)
      @config = config
    end

    def documents
      @documents ||= []
    end

    def build_new
      @filekey = id_generator.call
      self
    end

    def year
      valid_value(@year, 4) || '0000'
    end

    def month
      valid_value(@month, 2) || '00'
    end

    def day
      valid_value(@day, 2) || '00'
    end

    def folder
      "#{year}/#{filekey}/"
    end

    def occurrence_day
      "#{year}-#{month}-#{day}"
    end

    def enc_private_msg
      return @enc_private_msg if @enc_private_msg
      msg_encryptor.call(@dec_private_msg) if @dec_private_msg
    end

    def dec_private_message
      msg_decryptor.call(enc_private_msg) if enc_private_msg
    end

    def blossom_desc
      ERB
        .new(File.read(Blossom.templates_path.join('BLOOSOM_DESC.md.erb')))
        .result(binding)
    end

    def remote_mapper
      CollectionDynamoMapper.new(config: config, collection: self)
    end

    def local_mapper
      CollectionSqlMapper.new(config: config, collection: self)
    end

    def inspect
      %Q{#<Blossom::Collection filekey:"#{filekey}" occurrence_day:"#{occurrence_day}">}
    end

    def menu_key
      "#{filekey} #{title}"
    end

    def menu_selection(string)
      menu_key == string
    end

    def set_to_no_doc_state
      self.status = NODOC_STATUS
    end

    def set_to_preparation_state
      self.status = PREPARATION_STATUS
    end

    def set_to_processed_state
      self.status = PROCESSED_STATUS
    end

    def preparation_path
      local_assets_path.join('preparation',folder)
    end

    def processing_path
      local_assets_path.join('processing', folder)
    end

    def archive_local_path
      local_assets_path.join('ARCHIVE', folder)
    end

    def archive_remote_path
      Pathname.new(folder)
    end

    private
      attr_reader :config
      def_delegators :config, :local_assets_path, :id_generator, :msg_encryptor

      def valid_value(value, len)
        return unless value
        indented_value = "%0#{len}d" % value.to_i
        indented_value unless indented_value.length > len
      end
  end
end
