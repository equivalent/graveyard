module TestHelpers
  extend self

  def clean_temp_folders
    FileUtils.mkdir_p(local_assets_path)
    Dir
      .glob(local_assets_path.join('*').to_s)
      .each { |x| FileUtils.rm_r(x) }
  end

  def local_assets_folder
    local_assets_path.to_s
  end

  def local_assets_path
    _project_root_path.join('tmp', 'test_run')
  end

  def powerpuff_song
    File.read(fixtures_path.join('powerpuff_song.txt'))
  end

  def blossom_desc_example_1
    File.read(fixtures_path.join('BLOOSOM_DESC-example1.md'))
  end

  def blossom_desc_example_2
    File.read(fixtures_path.join('BLOOSOM_DESC-example2.md'))
  end

  def local_assets_preparation_path
    local_assets_path.join('preparation')
  end

  def local_assets_processing_path
    local_assets_path.join('processing')
  end

  def clean_remote_db
    Blossom::CollectionDynamoMapper.all(config: test_config).map { |c| c.remote_mapper.destroy }
  end

  def items_in_bucket
    s3 = test_config.s3
    resp = s3.client.list_objects(bucket: s3.bucket, max_keys: 20)
    resp.contents.map(&:key)
  end

  def clean_bucket
    s3 = test_config.s3
    items_in_bucket.each do |object_key|
      s3.client.delete_object({
        bucket: s3.bucket,
        key: object_key
      })
    end
  end

  def local_collections_count
    test_config.local_store[:collections].count
  end

  def last_local_stored_collection
    #test_config.local_store[:collections].limit(1).to_a.last
    #
    Blossom::CollectionSqlMapper.all(config: test_config).last
  end

  def last_remote_stored_collection
    Blossom::CollectionDynamoMapper.all(config: test_config).last
  end

  def fixtures_path
    _project_root_path.join('spec', 'support', 'fixtures')
  end

  private
    def _project_root_path
      Pathname.new(File.expand_path('../../', __dir__).to_s)
    end
end
