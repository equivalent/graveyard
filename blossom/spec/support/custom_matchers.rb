#RSpec::Matchers.define :dir_exist do |expected|

RSpec::Matchers.define :dir_exist do
  match do |actual|
    Dir.exist?(actual)
  end

  failure_message do |actual|
    "expected that #{actual.to_s} would be existing directory"
  end

  description do |actual|
    "Expect #{actual.to_s} to be a directory"
  end
end

RSpec::Matchers.define :file_exist do
  match do |actual|
    File.exist?(actual)
  end

  failure_message do |actual|
    "expected that #{actual.to_s} would be existing file"
  end

  description do |actual|
    "Expect #{actual.to_s} to be a file"
  end
end

RSpec::Matchers.define :be_file_with_content do
  match do |actual|
    begin
      File.read(actual).size > 1
    rescue Errno::ENOENT
      false
    end
  end

  failure_message do |actual|
    "expected that #{actual.to_s} would be file with content larger that single char"
  end

  description do |actual|
    "Expect #{actual.to_s} to be a file with content"
  end
end

