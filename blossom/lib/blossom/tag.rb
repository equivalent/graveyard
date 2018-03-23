module Blossom
  class Tag
    ValidationError = Class.new(StandardError)

    def self.types
      return @types if @types
      @types = []
      @types << Person
      @types << Price

      @types
    end

    def self.type_names
      types.map(&:name)
    end

    attr_reader :type_name

    def initialize(type_name, config: config)
      @type_name = type_name
    end

    def interface_value_eval(view_options_evaluator:, view_str_input_evaluator:)
      self.value = type.fetch_value({
        view_options_evaluator: view_options_evaluator,
        view_str_input_evaluator: view_str_input_evaluator,
        config: config
      })
    end

    def type
      Object.const_get(type_name)
    end

  end
end
