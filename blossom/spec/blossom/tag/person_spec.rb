require 'spec_helper'

RSpec.describe Blossom::Tag::Person do
  describe '#fetch_value' do
    def result
      described_class.fetch_value({
        view_options_evaluator: view_options_evaluator,
        config: test_config,
      })
    end

    let(:view_options_evaluator) { double }

    it do
      expect(view_options_evaluator)
        .to receive(:call)
        .with(be_kind_of(Array))
        .and_return('OliScottSykes')

      expect(result).to eq 'OliScottSykes'
    end
  end
end
