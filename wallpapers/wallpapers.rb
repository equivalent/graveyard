require 'pathname'
require 'erb'
require 'json'

module Wallpapers
  extend self

  def all
    x = []
    x = x + Dir.glob('public/**{,/*/**}/*')
    x = x.select{ |f| %w(.jpg .jpeg .png .gif).include?(File.extname(f).downcase) }
    x = x.map { |f| Pathname.new(f).sub('public/','') }
    x
  end

  def generate
    template_string = File.read('views/index.erb')
    body = ERB
      .new(template_string, safe_eval=nil, trim_mode=nil, outvar='_erbout')
      .result(binding)
    File.open('index.html', 'w') do |f|
      f.write body
      f.close
    end
  end
end

