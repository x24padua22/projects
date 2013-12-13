class Student
  attr_accessor :name, :dojo_location, :belt_level
  def initialize(name, dojo_location, belt_level)
    @name = name
    @dojo_location = dojo_location
    @belt_level = belt_level
  end
end

student1 = Student.new("Rozen", "Angeles City", "Red")
puts "Name of Student: " + student1.name
puts "Dojo Location: " + student1.dojo_location
puts "Belt Level: " + student1.belt_level