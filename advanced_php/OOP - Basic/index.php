<?php
	class Bike
	{
		var $price;
		var $max_speed;
		var $miles;
		
		function __construct($price, $max_speed)
		{
			$this->price = $price;
			$this->max_speed = $max_speed;
			$this->miles = 0;
		}
		
		function displayInfo()
		{
			echo "Price: " . $this->price . "<br />";
			echo "Max speed: " . $this->max_speed . "<br />";
			echo "Miles driven: " . $this->miles . "<br />";
		}
		
		function drive()
		{
			echo "Driving... <br />";
			$this->miles = $this->miles + 10;
		}
		
		function reverse()
		{
			if($this->miles <= 0)
				echo "Cannot reverse. <br />";
			else
			{
				echo "Reversing... <br />";
				$this->miles = $this->miles - 5;
			}
		}
	}
	
	$bike1 = new Bike(200, "25mph");
	$bike2 = new Bike(150, "20mph");
	$bike3 = new Bike(300, "33mph");
	
	echo "Bike1 <br />";
	$bike1->drive();
	$bike1->drive();
	$bike1->drive();
	$bike1->reverse();
	echo "<br />Bike1 info: <br />";
	$bike1->displayInfo();
	
	
	echo "----------<br />Bike2 <br />";
	$bike2->drive();
	$bike2->drive();
	$bike2->reverse();
	$bike2->reverse();
	echo "<br />Bike2 info: <br />";
	$bike2->displayInfo();
	
	echo "----------<br />Bike3 <br />";
	$bike3->reverse();
	$bike3->reverse();
	$bike3->reverse();
	echo "<br />Bike3 info: <br />";
	$bike3->displayInfo();
?>