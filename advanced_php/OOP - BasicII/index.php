<?php
	class Car
	{
		var $price;
		var $speed;
		var $fuel;
		var $mileage;
		var $tax;
		
		function __construct($price, $speed, $fuel, $mileage)
		{
			$this->price = $price;
			$this->speed = $speed;
			$this->fuel = $fuel;
			$this->mileage = $mileage;
			
			if($price > 10000)
				$this->tax = 15;
			else
				$this->tax = 12;
				
			$this->Display_all();
		}
		
		function Display_all()
		{
			echo "Price: " . $this->price . "<br />";
			echo "Speed: " . $this->speed . "<br />";
			echo "Fuel: " . $this->fuel . "<br />";
			echo "Mileage: " . $this->mileage . "<br />";
			echo "Tax: " . $this->tax / 100 . "<br /><br />";
		}
	}
	
	$car1 = new Car(2000, "35mph", "Not Full", "105mpg");
	$car2 = new Car(13000, "80mph", "Full", "43mpg");
	$car3 = new Car(1800, "45mhp", "Kind of Full", "230mpg");
	$car4 = new Car(19999, "35mhp", "Kind of Full", "27mpg");
	$car5 = new Car(5400, "12mhp", "Empty", "30mpg");
?>