---
layout: post
title:  "Elixir - update struct value"
date:   2017-05-24 20:49
categories: elixir phoenix
---

[https://elixir-lang.org/getting-started/structs.html](https://elixir-lang.org/getting-started/structs.html)

{% highlight elixir %}

user = %User{age: 27, name: "John"}
user = %User{ user | last_name: "Smith"}
{% endhighlight %}

