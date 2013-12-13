class MathDojo

	attr_accessor :answer
	@answer

	def initialize
		@answer = 0
	end 
	def add(*num)
		new_array = []

		for index in 0..num.count-1
			if num[index].class == Array
				num[index].map {|el| new_array.push(el)}
			else
				@answer += num[index]
			end
		end

		for index in 0..new_array.count-1
			@answer += new_array[index]
		end

		return self
	end
	def subtract(*num)
		difference = 0
		new_array = []

		for index in 0..num.count-1
			if num[index].class == Array
				num[index].map {|el| new_array.push(el)}
			else
				@answer -= num[index]
			end
		end

		for index in 0..new_array.count-1
			@answer -= new_array[index]
		end

		return self
	end
end


puts MathDojo.new.add(1, 2, 5).answer
puts MathDojo.new.add([3, 6], 5, [1, 4], 1.2, [9, 8]).answer
puts MathDojo.new.subtract(15, 4, 3).answer
puts MathDojo.new.subtract([1, 2], [3, 4], [5, 6]).answer

puts MathDojo.new.add(2).add(2,5).subtract(3,2).answer