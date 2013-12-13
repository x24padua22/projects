class Hash
	def foreach
		self.each_pair do |key, value|
			puts "#{key} is #{value}"
		end
	end
end

h = {:name => 'Dojo', :zip_code => 94043}
h.foreach