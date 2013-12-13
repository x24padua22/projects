# .any?

puts %w{ant bear cat}.any? {|word| word.length >= 3}
puts %w{ant bear cat}.any? {|word| word.length >= 4}
puts [ nil, true, 99 ].any?

# .each->
(1..10).each_cons(3) {|a| p a}
["ant", "bear", "cat"].each {|word| print word, "--"} 

# .collect
puts
puts (1..4).collect {|i| i*i}
puts (1..4).collect { "cat" }

# .detect/.find
puts (1..10).detect { |i| i %5 == 0 and i % 7 == 0 }
puts (1..100).detect { |i| i %5 == 0 and i % 7 == 0 }

# .upto(limit)
puts 5.upto(10) { |i| print i, " " }

class Ninja
    def initialize str
        @name = str  #this is the instance variable
    end
    def name    #this is the getter method for the @name attribute
           return @name
    end
    def name=(name)  #this is the setter method!
           @name = name
    end
 end
#now we run the code
Trey = Ninja.new('Trey')
puts Trey.name => 'Trey' #uses the getter method!
Trey.name = 'Bruce Lee'  #uses the setter method!
puts Trey.name => 'Bruce Lee' #getter method again!

puts sprintf("%d", 123)
puts sprintf("%+d", 123)
puts sprintf("% d", 123)