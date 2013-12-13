#this is a comment

=begin
	this is a comment
	that can have multiple lines
=end

puts "hello"
puts "Coding"
puts "Dojo"

puts "coding", "dojo"
# ^this line puts the strings in new line each
puts "coding" + "dojo"
# ^this line puts the strings on the same line


print "This is a print. Prints out text or whatever in a single line"
puts "Puts on the other hand automatically places the next text in the next line"
puts "So its like having a br at the end of the text"

BEGIN {
	puts "This is placed at the beginning"
}

END {
	puts "This is placed at the end block"
}


#following line shows how you can implement variables and use them

puts
puts "---------------------"
puts "The following lines utilizes variables"

x = 10
y = 5
z = x + y

puts z
puts
=begin
	different ways of using variables
	%s = string
	%d = decimal
	%f = float
=end
puts "Value of x is #{x} and value of y is #{y}. And their sum is %d" % z

first_name = "Rozen"
last_name = "Macapagal"

puts first_name
puts last_name

puts "My name is " + first_name + " " + last_name
puts "First name is #{first_name} and last name is #{last_name}"
puts "First name = %s. Last name = %s" % [first_name, last_name]

puts "---------------------"
puts

# escaping characters (using "\") 
# and adding new line/tab (using "\n" and "\t")

puts "My height is 5'0\""
puts "\t I have indented this line using tab"
print "I used print here instead of puts"
print "\nbut I have a new line at the beginning\n"
# the new line at the end of ^this line is for the END so it gets printed in a new line


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



# the following is the code used in variables/classes
class CodingDojo 
  @@no_of_branches = 0 
  def initialize(id, name, address) 
    @branch_id = id 
    @branch_name = name 
    @branch_address = address 
    @@no_of_branches += 1 
    puts "\nCreated branch #{@@no_of_branches}" 
  end 
  def hello 
    puts "Hello CodingDojo!" 
  end 
  def displayAll 
    puts "Branch ID: %d" % @branch_id 
    puts "Branch Name: %s" % @branch_name 
    puts "Branch Address: %s" % @branch_address 
  end 
end 
# now using above class to create objects 
branch = CodingDojo.new(253, "SF CodingDojo", "Sunnyvale CA") 
branch.displayAll 
branch2 = CodingDojo.new(155, "Boston CodingDojo", "Boston MA") 
branch2.displayAll


# using operators 

num1 = 10
num2 = 1

puts "num1 is equal to num2" if num1 == num2
puts "num1 is not equal to num2" if num1 != num2
puts "num1 + 2 = #{num1+=2}"


# using if/else

x=1
if x > 2
	puts "x is greater than 2"
elsif x <= 2 and x!=0
	puts "x is 1"
else
	puts "I can't guess the number"
end 

# using switch case
$age =  5
case $age
when 0 .. 2
    puts "baby"
when 3 .. 6
    puts "little child"
when 7 .. 12
    puts "child"
when 13 .. 18
    puts "youth"
else
    puts "adult"
end


#using while loop
i = 0
num = 3
while i < num do
   puts "Inside the loop i = #{i}"
   i +=1
end

# using for loop
for i in 6..10 
  puts "Value of local variable is #{i}" 
end