a = {:first_name => "Michael", :last_name => "Choi"}
b = {:first_name => "John", :last_name => "Supsupin"}
c = {:first_name => "KB", :last_name => "Tonel"}
d = {:first_name => "Mikee", :last_name => "Buyco"}
e = {:first_name => "Diana", :last_name => "Manlulu"}
names = [a, b, c, d, e]

puts "You got #{names.count} names in the 'names' array."
puts "The name is '#{a[:first_name]} #{a[:last_name]}'"
puts "The name is '#{b[:first_name]} #{b[:last_name]}'"
puts "The name is '#{c[:first_name]} #{c[:last_name]}'"
puts "The name is '#{d[:first_name]} #{d[:last_name]}'"
puts "The name is '#{e[:first_name]} #{e[:last_name]}'"