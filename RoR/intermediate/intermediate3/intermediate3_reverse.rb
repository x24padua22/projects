class String
	def reverse_original
		lenght = count(self) - 1
		reversed_string = String.new

		for index in 0..lenght
			reversed_string += self[lenght-index]
		end

		puts "The reversed string for #{self} is: "
		puts reversed_string
	end
	def reverse_original!
		lenght = count(self) - 1
		reversed_string = String.new

		for index in 0..lenght
			reversed_string += self[lenght-index]
		end

		puts "The reversed string for #{self} is: "
		puts reversed_string

		return true if reversed_string == self.reverse!
	end
end

puts "abcdefg".reverse_original
puts "abcdefg".reverse_original!

x = "Dojo"
y=x
z=x
x.reverse_original!
puts y,z,x