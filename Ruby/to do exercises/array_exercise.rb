a = ["Rozen", "Zen", "Zi"]
b = [1,2,3,4,5]

puts "print the array a:"
puts a
puts "print the array b:"
puts b

puts "\n2 ways to get the second element from array a."
puts "using array[]: #{a[1]}"
puts "another is using array.at(): #{a.at(1)}"
puts "and you can also use array.fetch(): #{a.fetch(1)}"

puts "\nto join the two arrays just use array1 + array2:"
puts a + b

x=a+b
print "\nto convert into a string(something like an array)"
puts "use .to_s:"
puts x.to_s

c = ["Rozen"]
print "\nto remove certain elements in the array that you "
print "have in another array you can use array1 - array3 "
puts "so array1 will now be: "
puts a-c
=begin
	you can also do something like:
	c = ["Rozen", 5]
	y = (a+b)-c
	puts y
	and it will remove Rozen and 5 from the combined arrays
=end

puts "\nusing shuffle (gives different result every time): "
puts b.shuffle

print "\nusing join (joining the elements and you can use "
puts "a certain character to separate them--here i used '-'):"
puts a.join("-")

print "\nyou can also use several functions at once. "
puts "for this example I will use shuffle and join"
puts b.shuffle.join(", ")

puts "\nto create a new array you can use %w{}"
z = %w{Coding Dojo Rozen Zen}
puts z