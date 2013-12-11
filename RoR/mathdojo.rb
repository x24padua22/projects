class MathDojo
	def add(*num)
		puts "The sum of the array #{num.to_s} is:"
		sum = 0

		for index in 0..num.count-1
			sum += num[index]
		end
		
		puts sum
		return self
	end
	def subtract(*num)
		puts "This difference of the array #{num} is:"
		difference = 0
		
		for index in 0..num.count-1
			difference -= num[index]
		end

		puts difference
		return self
	end
end


x = MathDojo.new
x.add(1, 2, 5)

y = MathDojo.new
y.subtract(15, 4, 3)

z = MathDojo.new
puts z.add(2).add(2,5).subtract(3,2)