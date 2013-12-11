numbers_array = [3,5,1,2,7,9,8,13,25,32]
puts "The initial array values of the numbers_array: " + numbers_array.to_s
puts "When the values in the array are added, the sum will be:"
puts numbers_array.inject(:+)
puts "Array values that are greater than 10: "
puts numbers_array.delete_if {|number| number < 10}

names_array = ["John", "KB", "Oliver", "Cory", "Matthew", "Christopher"]
puts "\nThe initial values of the names array: " + names_array.to_s
puts "The names array when shuffled:"
puts names_array.shuffle
puts "Names that are longer than 5 characters:"
names_array.each {|name| puts name if name.length > 5}

alphabet = Array("a".."z")
puts "\nLetter in the alphabet: " + alphabet.to_s
shuffled_letters = alphabet.shuffle
puts "When the letters are shuffled: " + shuffled_letters.to_s
puts "After shuffling the letters, the last letter in the array is: " + shuffled_letters.last
puts "And the first letter in the array is: " + shuffled_letters.first
puts "The first letter in the array is a vowel" if ["a","e","i","o","u"].include?(shuffled_letters.first)

random_numbers = Array.new
10.times {random_numbers.push(rand(55..100))}
puts "\nTen random numbers: " + random_numbers.to_s
puts "Sorted random numbers: " + random_numbers.sort.to_s
puts "Minimun value in the random numbers: " + random_numbers.min.to_s
puts "Maximum value in the random numbers: " + random_numbers.max.to_s

random_string = (1..5).map {(65+rand(26)).chr}.join
puts "\nGenerated string with 5 random characters: " + random_string
random_array = Array.new
10.times {random_array.push((1..5).map {rand(65..90).chr}.join)}
puts "An array with 10 string values of 5 random characters each:"
puts random_array