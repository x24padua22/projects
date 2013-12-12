class MathDojo
	def add(*num)
		puts "The sum of the array #{num} is:"
		sum = 0
		new_array = []

		for index in 0..num.count-1
			if num[index].class == Array
				num[index].map {|el| new_array.push(el)}
			else
				sum += num[index]
			end
		end

		for index in 0..new_array.count-1
			sum += new_array[index]
		end

		puts sum
		return self
	end
	def subtract(*num)
		puts "The difference of the array #{num} is:"
		difference = 0
		new_array = []

		for index in 0..num.count-1
			if num[index].class == Array
				num[index].map {|el| new_array.push(el)}
			else
				difference -= num[index]
			end
		end

		for index in 0..new_array.count-1
			difference -= new_array[index]
		end

		puts difference
		return self
	end
end


MathDojo.new.add(1, 2, 5)
MathDojo.new.add([3, 6], 5, [1, 4], 1.2, [9, 8])
MathDojo.new.subtract(15, 4, 3)
MathDojo.new.subtract([1, 2], [3, 4], [5, 6])

puts "\nThe following is supposed to be a chain method"
puts MathDojo.new.add(2).add(2,5).subtract(3,2)