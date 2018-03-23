require "bundler/setup"
require 'dotenv/load'
require "blossom"
require 'irb' # for binding.irb debugging
require_relative 'support/test_helper'
require_relative 'support/test_factories'
require_relative 'support/custom_matchers'

RSpec.configure do |config|
  # Enable flags like --only-failures and --next-failure
  config.example_status_persistence_file_path = ".rspec_status"

  config.expect_with :rspec do |c|
    c.syntax = :expect
  end

  config.include TestFactories

  config.before(:suite) do
    TestHelpers.clean_temp_folders
  end

  config.before(:each) do
    test_config.migrate
  end

  config.after(:each) do
    TestHelpers.clean_temp_folders
  end
end

def test_config
  @test_config ||= Blossom::Config.new.tap do |c|
    c.local_assets_folder = TestHelpers.local_assets_folder
    c.tag_people_options = ['Hribo']
  end
end
