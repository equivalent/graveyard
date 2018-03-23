require 'spec_helper'

RSpec.describe Blossom::Tag::Price do
  describe '#fetch_value' do
    def result(input)
      described_class.fetch_value({
        view_str_input_evaluator: -> (msg) { input }
      })
    end

    context 'when valid value' do
      ['EUR102.39', 'USD9.10', 'GBP 92309.92', 'EUR0.10'].each do |price|
        it { expect(result(price)).to eq(price) }
      end
    end

    context 'missing prefix' do
      ['EU.39', 'EU102.39', '9.10'].each do |price|
        it { expect { result(price) } .to raise_error(Blossom::Tag::ValidationError, /prefix/) }
      end
    end

    context 'incorrect price' do
      ['EUR.39', 'EUR9.1'].each do |price|
        it { expect { result(price) } .to raise_error(Blossom::Tag::ValidationError, /sufix/) }
      end
    end
  end
end
