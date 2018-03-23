module Blossom
  class Document
    CannotBeDir = Class.new(StandardError)
    FileDoesntExist = Class.new(StandardError)
    attr_accessor :local_path, :sanitized_name, :original_name

    def self.from_serial(serial_document, config:)
      self.new(config: config).tap do |d|
        d.original_name = serial_document.fetch("originalName")
        d.sanitized_name = serial_document.fetch("sanitizedName")
      end
    end

    def initialize(config:)
      @config = config
    end

    def ==(doc)
      self.original_name == doc.original_name \
        && self.sanitized_name == doc.sanitized_name
    end

    def sanitize
      self.original_name = local_path.basename.to_s
      sanitized_name_without_ext = filename_sanitizer(local_path.basename(".*").to_s)
      sanitized_path = local_path.dirname.join(sanitized_name_without_ext).sub_ext(local_path.extname)
      local_path.rename(sanitized_path)
      self.local_path = sanitized_path
      self.sanitized_name = local_path.basename.to_s
    end

    def local_upload(archive_local_path:)
      FileUtils.mkdir_p(archive_local_path)
      FileUtils.cp(local_path, archive_local_path)
    end

    def remote_upload(archive_remote_path:, s3:, collection_key:)
      s3.client.put_object({
        acl: "private",
        bucket: s3.bucket,
        body: File.read(local_path.to_s),
        key: archive_remote_path.join(sanitized_name).to_s,
        metadata: {
          "collectionKey" => collection_key,
          "originalName" => original_name,
          "sanitizedName" => sanitized_name,
        },
        server_side_encryption: "AES256", # accepts AES256, aws:kms
        storage_class: "STANDARD", # accepts STANDARD, REDUCED_REDUNDANCY, STANDARD_IA
      })
    end

    def to_serial
      {
        "originalName" => original_name,
        "sanitizedName" => sanitized_name,
      }
    end

    def validate!
      raise(CannotBeDir) if local_path.directory?
      raise(FileDoesntExist) unless local_path.exist?
      true
    end

    def filename_sanitizer(name)
      name.strip.gsub(' ', '-').gsub(/[^\w-]/, '')
    end
  end
end
