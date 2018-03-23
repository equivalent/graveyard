# coding: utf-8
lib = File.expand_path("../lib", __FILE__)
$LOAD_PATH.unshift(lib) unless $LOAD_PATH.include?(lib)
require "blossom/version"

Gem::Specification.new do |spec|
  spec.name          = "blossom"
  spec.version       = Blossom::VERSION
  spec.authors       = ["Tomas Valent"]
  spec.email         = ["equivalent@eq8.eu"]

  spec.summary       = %q{CLI app for archiving documents}
  spec.description   = %q{CLI app for archiving documents to S3 and Dynamo DB + local storage}
  spec.homepage      = "https://github.com/equivalent/blossom"

  spec.files         = `git ls-files -z`.split("\x0").reject do |f|
    f.match(%r{^(test|spec|features)/})
  end
  spec.bindir        = "exe"
  spec.executables   = spec.files.grep(%r{^exe/}) { |f| File.basename(f) }
  spec.require_paths = ["lib"]

  spec.add_dependency "inputs", "~> 0.1.1"
  spec.add_dependency "sequel"
  spec.add_dependency "sqlite3"
  spec.add_dependency "aws-sdk-s3", '~> 1.0'
  spec.add_dependency "aws-sdk-dynamodb", '~> 1.0'
  spec.add_development_dependency "bundler", "~> 1.15"
  spec.add_development_dependency "rake", "~> 10.0"
  spec.add_development_dependency "rspec", "~> 3.0"
  spec.add_development_dependency "dotenv", "~> 2.2"
end
