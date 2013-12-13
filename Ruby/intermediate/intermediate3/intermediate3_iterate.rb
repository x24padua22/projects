class Array
	def iterate
		puts "Values of the array when you run iterate:"
		
		self.each_with_index do |number|
			puts number * 5
		end
	end
	def iterate!
		puts "Values of the array when you run iterate!:"
		
		self.each_with_index do |number, index|
			puts self[index] = number * 5
		end
	end
end

x = [1, 3, 5]
puts "Initial value of array: " + x.to_s
x.iterate
puts "Value of array after iterate: " + x.to_s
x.iterate!
puts "Values of the array ofter iterate!: " + x.to_s