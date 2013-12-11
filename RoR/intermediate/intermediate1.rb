monster1 = {:health => 500}
monster2 = {:health => 500}

damage = 0
for round in 1..5
	puts "ROUND #{round}:"
	damage = rand(1..100)
	monster2[:health] -= damage
	puts "Monster1 attacks Monster2 with #{damage} damage"
	puts "Monster2's health is now #{monster2[:health]}"
	damage = rand(1..100)
	monster1[:health] -= damage
	puts "Monster2 attacks Monster1 with #{damage} damage"
	puts "Monster1's health is now #{monster1[:health]}"
end

if monster1[:health] > monster2[:health]
	puts "Monster1 wins the game!"
else
	puts "Monster2 wins the game!"
end