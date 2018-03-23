module Blossom
  module Tag::Price
    extend self

    def fetch_value(view_str_input_evaluator:, **other_args)
      val = view_str_input_evaluator.call("Please specify value e.g.: GBP130.30)")
      validate_prefix(val)
      validate_numericity_sufix(val)
      val
    end

    private
      def validate_prefix(input)
        curencies = ['USD', 'EUR', 'GBP']
        raise Tag::ValidationError, "Permitted currency prefix missing, try USD100.00" unless curencies.include?(input[0..2])
      end

      def validate_numericity_sufix(input)
        unless input[3..-1].match(/\d+.\d\d/)
          raise Tag::ValidationError, "No numerical value after sufix, try USD1000.00"
        end
      end
  end
end
