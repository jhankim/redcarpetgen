#!/usr/bin/ruby
require 'redcarpet'
renderer = Redcarpet::Render::HTML.new(hard_wrap: true, with_toc_data: true)
markdown = Redcarpet::Markdown.new(renderer, autolink: true, tables: true, fenced_code_blocks: true, )

file = ARGV[0]
puts markdown.render(File.read(file))