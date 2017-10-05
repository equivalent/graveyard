require 'inputs'
require 'date'

topic = Inputs.name("What is the name of the article ?")
categories = Inputs.names("What are the categories/tags ?")


sanitized_topic = topic.downcase.gsub(/\s/,'-').gsub(/[^\w_-]/, '').squeeze('-')

@time = Time.now

filename = "#{@time.to_date}-#{sanitized_topic}.markdown"


template = <<EOF
---
layout: post
title:  "#{topic}"
date:   #{@time.to_s}
categories: #{categories.join(' ')}
---


{% highlight elixir %}

{% endhighlight %}

EOF

filepath = "_posts/#{filename}"
File.write(filepath, template)

puts "vim #{filepath}"
