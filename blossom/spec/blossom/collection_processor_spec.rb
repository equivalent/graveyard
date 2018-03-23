require 'spec_helper'
RSpec.describe Blossom::CollectionProcessor do
  include TestHelpers

  let(:processor) { described_class.new(config: test_config, collection: collection) }
  let(:collection) do
    build(:collection, :builded,
          year: 2017,
          month: '08',
          day: '05',
          dec_private_msg: "Skindred",
          title: "One Punch Man",
          description: 'Bring Me The Horizon')
    end
  let(:filekey) { 'xxxxxthisisgeneratedid1xxxxx' }

  before do
    test_config.id_generator = ->{ filekey }
    test_config.msg_encryptor = ->(msg){ "ENC-#{msg}-ENC" }
    TestHelpers.clean_remote_db
    TestHelpers.clean_bucket
  end

  after(:all) do
    TestHelpers.clean_remote_db
    TestHelpers.clean_bucket
  end

  def it_saves_to_local_db(status:, before_count:, has_documents:)
    expect(local_collections_count).to be before_count
    trigger
    expect(local_collections_count).to be 1
    c = last_local_stored_collection
    expect(c.id).to be_kind_of(Integer)
    expect(c.filekey).to eq "xxxxxthisisgeneratedid1xxxxx"
    expect(c.title).to eq "One Punch Man"
    expect(c.description).to eq 'Bring Me The Horizon'
    expect(c.enc_private_msg).to eq 'ENC-Skindred-ENC'
    expect(c.year).to eq "2017"
    expect(c.month).to eq "08"
    expect(c.day).to eq "05"
    expect(c.status).to eq status
    if has_documents
      expect(c.documents).to eq([
        build(:document, original_name: " test file $.txt", sanitized_name: "test-file-.txt")
      ])
    else
      expect(c.documents).to eq([])
    end
  end

  def it_saves_to_remote_db(status:, has_documents:)
    expect(last_remote_stored_collection).to be nil
    trigger
    c = last_remote_stored_collection
    expect(c.filekey).to eq "xxxxxthisisgeneratedid1xxxxx"
    expect(c.title).to eq "One Punch Man"
    expect(c.description).to eq "Bring Me The Horizon"
    expect(c.year).to eq "2017"
    expect(c.month).to eq "08"
    expect(c.day).to eq "05"
    expect(c.enc_private_msg).to eq "ENC-Skindred-ENC"
    expect(c.status).to eq status
    if has_documents
      expect(c.documents).to eq([
        build(:document, original_name: " test file $.txt", sanitized_name: "test-file-.txt")
      ])
    else
      expect(c.documents).to eq([])
    end
  end

  describe '#write_db' do
    def trigger
      processor.write_db
    end

    it 'saves to local db storage' do
      it_saves_to_local_db(status: 'nodoc', before_count: 0, has_documents: false)
    end

    it 'saves to remote db storage' do
      it_saves_to_remote_db(status: 'nodoc', has_documents: false)
    end
  end

  describe '#prepare' do
    let(:expected_collection_path) { local_assets_preparation_path.join('2017', filekey) }

    def trigger
      processor.prepare
    end

    it 'creates "preparation" collection folder' do
      expect(expected_collection_path).not_to dir_exist
      trigger
      expect(collection.filekey).to eq filekey
      expect(expected_collection_path).to dir_exist
    end

    it 'writes to BLOOSOM_DESC in "preparation" collection folder' do
      desc_file = expected_collection_path.join(Blossom::DESC_FILE_NAME)
      expect(desc_file).not_to file_exist
      trigger
      expect(desc_file).to file_exist
      expect(desc_file).to be_file_with_content
    end

    it 'saves to local db storage' do
      it_saves_to_local_db(status: 'preparation', before_count: 0, has_documents: false)
    end

    it 'saves to remote db storage' do
      it_saves_to_remote_db(status: 'preparation', has_documents: false)
    end
  end

  describe '#process' do
    let(:preparation_folder) { local_assets_preparation_path.join('2017', filekey) }
    let(:processing_folder)  { local_assets_processing_path.join('2017', filekey) }

    def trigger
      processor.process
    end

    context 'when preparation folder exist' do
      let(:real_file_name) { ' test file $.txt' }
      let(:sanitized_file_name) { 'test-file-.txt' }

      before do
        collection.set_to_preparation_state
        FileUtils.mkdir_p(preparation_folder)
        FileUtils.cp(fixtures_path.join(real_file_name), preparation_folder)
      end

      it do
        expect(preparation_folder.join(real_file_name)).to be_exist
        expect(processing_folder.join(sanitized_file_name)).not_to be_exist
        trigger
        expect(preparation_folder.join(real_file_name)).not_to be_exist
        expect(processing_folder.join(sanitized_file_name)).to be_exist
      end

      it do
        resp = items_in_bucket
        expect(resp.size).to be 0
        trigger
        resp = items_in_bucket
        expect(resp.size).to be 1
        expect(resp.first).to eq "2017/xxxxxthisisgeneratedid1xxxxx/test-file-.txt"
      end

      it 'saves to local db storage' do
        it_saves_to_local_db(status: 'processed', before_count: 0, has_documents: true)
      end

      it 'saves to remote db storage' do
        it_saves_to_remote_db(status: 'processed', has_documents: true)
      end
    end

    context 'when preparation folder dont exist' do
    end
  end
end
