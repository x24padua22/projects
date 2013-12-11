first_number = 10
second_number = 5
operation = rand(1..4)

puts "The first number is #{first_number} and the second number is #{second_number}.\n"

case operation
when 1
	answer = first_number + second_number
	operator = "Addition"
when 2
	answer = first_number - second_number
	operator = "Subtraction"
when 3
	answer = first_number * second_number
	operator = "Multiplication"
when 4
	answer = first_number / second_number
	operator = "Division"
end

puts "The answer is " + answer.to_s
puts "The operation used is " + operator