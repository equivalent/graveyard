require 'spec_helper'
RSpec.describe Blossom::Document do
  let(:document) do
    described_class
      .new(config: test_config)
      .tap { |d| d.local_path = document_path }
  end

  describe '#validate!' do
    let(:result) { document.validate! }

    context 'when valid document' do
      let(:document_path) { TestHelpers.fixtures_path.join('powerpuff_song.txt') }

      it { expect(result).to be true }
    end

    context 'when directory' do
      let(:document_path) { TestHelpers.fixtures_path }

      it { expect { result }.to raise_exception(Blossom::Document::CannotBeDir) }
    end

    context 'when nonexisting file' do
      let(:document_path) { TestHelpers.fixtures_path.join('not-existing-file.txt') }

      it { expect { result }.to raise_exception(Blossom::Document::FileDoesntExist) }
    end
  end

  describe '#sanitize' do
    let(:document_path) do
      dest = TestHelpers.local_assets_processing_path.join('0000')
      FileUtils.mkdir_p dest
      FileUtils.cp TestHelpers.fixtures_path.join(' test file $.txt'), dest
      dest.join(' test file $.txt')
    end

    def trigger
      document.sanitize
    end

    context 'when document needs to be sanitized' do
      it do
        expect(document_path).to exist
        expect(document.local_path).to exist
        expect(document.local_path).to eq document_path
        expect(document.original_name).to be nil
        expect(document.sanitized_name).to be nil
        trigger
        expect(document_path).not_to exist
        expect(document.local_path).to exist
        expect(document.local_path).not_to eq document_path
        expect(document.original_name).to eq ' test file $.txt'
        expect(document.sanitized_name).to eq 'test-file-.txt'
      end
    end
  end
end
