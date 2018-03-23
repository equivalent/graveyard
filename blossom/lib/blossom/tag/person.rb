module Blossom
  module Tag::Person
    extend self

    def fetch_value(view_options_evaluator:, config:, **other_args)
      view_options_evaluator.call(options(config: config))
    end

    def options(config:)
      config.tag_people_options
    end
  end
end
