require 'spec_helper'
RSpec.describe Blossom::Tag do
  describe '#interface_value_eval' do
    def trigger
      interface_value_eval({
        view_options_evaluator: view_options_evaluator,
        view_str_input_evaluator: view_str_input_evaluator
      })
    end

    it do

    end
  end
end
