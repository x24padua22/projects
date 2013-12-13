# using strings
x = "CodingDojo"

puts x
print "\nThe lenght of the string is " 
puts x.length
print "\nto capitalize only the first letter of the string"
print " use capitalize: "
puts x.capitalize
print "\nto make the string all caps use upcase: "
puts x.upcase
print "\nto make the string all lower case use downcase: "
puts x.downcase
print "\nto get the secong letter of the string use x[1] "
print "since the array starts with 0. "
print "so the second letter of the string is: "
puts x[1]
print "\nto check if the string contains a prticular "
print "string/letter use include?() "
print "note that this is case sensitive and returns true or "
print "false. so to check if the string contains 'Dojo' "
print "the answer would be: "
puts x.include?("Dojo")
print "\nyou can also use include? in an if statement"
puts "\nthe string has the word 'Dojo'" if x.include? "Dojo"

# the following is a string
y = "rozen,zen,zi"

puts y
print "\nto put the string into individual values, split them:\n"
puts y.split(",")
print "\nyou can also make them look like an array: "
puts y.split(",").to_s


# to check if you have an empty string
z = ""
puts "\nto check if Z string is empty use empty?" if z.empty?


# using arrays
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

# using ranges
x_range = (1..5)

puts "the range include 3!" if x_range.include? 3
puts "The last number is: " + x_range.last.to_s
puts "The maximun number is: " + x_range.max.to_s
puts "The minimum number is: " + x_range.min.to_s

alpha_range = ("a".."z")
puts alpha_range.to_a.shuffle.to_s


# using hashes

name = {"first_name" => "Rozen", "last_name" => "Macapagal"}
puts name["first_name"], name["last_name"]

name2 = {:first_name => "Rozen", :last_name => "Macapagal"}
puts name2
puts "DELETE the :first_name"
name2.delete :first_name
puts "name is now", name2

if name2.has_key? :first_name
  puts "Name2 has a first_name key"
else
  puts "Name2 does not have a first_name key"
end


# using blocks
def test 
  puts "This is the method" 
  yield 
  puts "Back in the method" 
  yield 
end 

test {puts "You are in the block"}