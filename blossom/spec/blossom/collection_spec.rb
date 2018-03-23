require 'spec_helper'

RSpec.describe Blossom::Collection do
  let(:collection) { described_class.new(config: test_config) }

  describe '#folder' do
    let(:result) { collection.folder }

    before do
      test_config.id_generator = ->{ 'yythisisrandomheyy' }
      collection.build_new
    end

    context 'when nil year' do
      it 'use 0000 as folder prefix' do
        expect(result).to eq "0000/yythisisrandomheyy/"
      end
    end
 
    context 'when value year' do
      before do
        collection.year = 1988
      end

      it 'it apply year name to folder name' do
        expect(result).to eq "1988/yythisisrandomheyy/"
      end
    end

    context 'when invalid year value' do
      before do
        collection.year = 19986
      end

      it 'use 0000 as folder prefix' do
        expect(result).to eq "0000/yythisisrandomheyy/"
      end
    end
  end

  describe '#blossom_desc' do
    before do
      test_config.id_generator = ->{ 'xxthisisrandomhexx' }
      test_config.msg_encryptor = ->(msg){ "ENC-#{msg}-ENC" }
    end

    context 'newly build collection with valid dates, private message and description' do
      let(:result) { collection.blossom_desc }

      before do
        collection.build_new
        collection.title = "Bubbles is Hard-core !"
        collection.description = TestHelpers.powerpuff_song
        collection.year = 2017
        collection.month = '08'
        collection.day = 5
        collection.dec_private_msg = "this is ulta secret message"
      end

      it 'should generate BLOOSOM_DESC file with generated id, correct dates, encrypted private message and description' do
        expect(result).to eq TestHelpers.blossom_desc_example_1
      end
    end

    context 'newly build collection with invalid dates, no private message and no description' do
      let(:result) { collection.blossom_desc }

      before do
        collection.build_new
        collection.title = "Bubbles is Hard-core !"
        collection.month = '09'
        collection.day = 505
      end

      it 'should generate BLOOSOM_DESC file with generated id, ZEROed dates, empty private message and empty description' do
        expect(result).to eq TestHelpers.blossom_desc_example_2
      end
    end
  end

  describe '#occurrence_day' do
    let(:result) { collection.occurrence_day }

    context 'when no y m d' do
      it { expect(result).to eq "0000-00-00" }
    end

    context 'when  y m d' do
      let(:collection) { build :collection, year: 1988, month: '08', day: '05' }

      it { expect(result).to eq "1988-08-05" }
    end
  end
end
