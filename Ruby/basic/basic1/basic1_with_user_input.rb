puts "Please enter the first number"
first_number = gets.chomp
puts "Enter the second number"
second_number = gets.chomp
operation = rand(1..4)

case operation
when 1
	answer = first_number.to_i + second_number.to_i
	operator = "Addition"
when 2
	answer = first_number.to_i - second_number.to_i
	operator = "Subtraction"
when 3
	answer = first_number.to_i * second_number.to_i
	operator = "Multiplication"
when 4
	answer = first_number.to_i / second_number.to_i
	operator = "Division"
end

puts "The answer is " + answer.to_s
puts "The operation used is " + operator