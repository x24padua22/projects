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