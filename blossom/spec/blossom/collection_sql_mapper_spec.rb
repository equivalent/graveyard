require 'spec_helper'
RSpec.describe Blossom::CollectionSqlMapper do
  include TestHelpers
  include TestFactories

  let(:mapper) { described_class.new(config: test_config, collection: collection) }
  let(:collection) do
    c = build(:collection, :builded, year: 2017, title: "Foo")
    c.documents << document1
    c.documents << document2
    c
  end
  let(:filekey) { 'xxxxxthisisdifferentgeneratedid1xxxxx' }

  let(:document1) { build :document, sanitized_name: "foo-bar.jpg", original_name: "Foo Bar.jpg" }
  let(:document2) { build :document, sanitized_name: "car-dar.jpg", original_name: "car Dar.jpg" }

  before do
    @id_generator_counter = 0
    test_config.id_generator = ->{ @id_generator_counter += 1; filekey }
    test_config.msg_encryptor = ->(msg){ "ENC-#{msg}-ENC" }
  end

  describe 'put put and destroy' do
    it do
      expect(local_collections_count).to be 0

      mapper.put

      expect(local_collections_count).to be 1
      c = last_local_stored_collection

      expect(@id_generator_counter).to eq 1
      expect(c.filekey).to eq filekey
      expect(c.title).to eq "Foo"
      expect(c.year).to eq "2017"
      expect(c.documents).to eq([document1, document2])

      # second call
      mapper.put

      expect(@id_generator_counter).to eq 1    #should not generate the id again
      expect(local_collections_count).to be 1
      c = last_local_stored_collection
      c.title = "bar"

      expect(c.filekey).to eq filekey
      expect(c.title).to eq "bar"
      expect(c.year).to eq "2017"

      c.local_mapper.destroy
      expect(local_collections_count).to be 0
    end
  end

  describe '#put' do
    let(:collection) do
      c = build(:collection, :builded,
                year: 2017,
                month: '08',
                day: '05',
                dec_private_msg: "Skindred",
                title: "One Punch Man",
                status: "something",
                description: 'Bring Me The Horizon')
      c.documents << document1
      c
    end

    before { mapper.put }

    it do
      collection_hash = test_config.local_store[:collections].all.last

      expect(collection_hash).to match({
        :id=> be_kind_of(Integer),
        :filekey=>"xxxxxthisisdifferentgeneratedid1xxxxx",
        :title=>"One Punch Man",
        :description=>'Bring Me The Horizon',
        :enc_private_msg=>'ENC-Skindred-ENC',
        :year=>"2017",
        :month=>"08",
        :day=>"05",
        :created_at=> be_kind_of(Time),
        :status=>"something",
        :documents_serial => %Q{[{"originalName":"Foo Bar.jpg","sanitizedName":"foo-bar.jpg"}]},
      })
    end
  end

  describe '.in_preparation' do
    it 'should contain only in preparation' do
      c1 = create_local :collection, :builded, :in_processed
      c2 = create_local :collection, :builded, :in_preparation
      c3 = create_local :collection, :builded, :nodoc

      result = described_class.in_preparation(config: test_config)
      expect(result.first).to be_kind_of(Blossom::Collection)
      expect(result.map(&:id)).to eq([c2])
    end
  end
end
