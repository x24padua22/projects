class Fixnum
  def double
    self*2
  end
  def next
  	self+1
  end
  def prev
  	self-1
  end
  def skip
  	self+2
  end
end

puts "Initial numbers are: 2,4,8"
puts "Doubled numbers:"
puts 2.double, 4.double, 8.double
puts "Next numbers to follow the initial numbers:"
puts 2.next, 4.next, 8.next
puts "Number before the initial numbers:"
puts 2.prev, 4.prev, 8.prev
puts "Skip the numbers:"
puts 2.skip, 4.skip, 8.skip