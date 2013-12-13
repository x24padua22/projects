class Array
	def filter
		puts "Filter the array, show only the value(s) that is/are greater than 15:"
		
		self.each_with_index do |number|
			puts number if number > 15
		end
	end
	def filter!
		puts "using filter!, the values that are greater than 15 are:"
		
		self.each_with_index do |number|

			if number > 15
				puts number
			else
				self.delete(number)
			end
		end
	end
end

x = [1, 10, 25]
puts "The initial value of the array: " + x.to_s
x.filter
puts "Value of the array after filter: " + x.to_s
x.filter!
puts "Value of the array after filter!: " + x.to_s


=begin
	note that when I use self.delete(number) on the else it doesn't delete 10.
	but when I replace line 14 with puts number it shows 10, which means that the else statement really does catch the value 10
	the if/else also returns different results when I change the values of the array, especially the one with index 1
=end