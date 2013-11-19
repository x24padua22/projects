<?php
	class Dojo
	{
		var $health;
		var $x;
		var $y;
		var $name;
		var $ninjas;
		var $dragons;
		
		function __construct($new_name)
		{
			$this->name = $new_name;
			echo "<br />creating a new Dojo!";
			$this->ninjas = 0;
			$this->dragons = 0;
		}
		
		function create_ninjas()
		{
			echo "<br />creating ninjas";
		}
		
		function create_dragons()
		{
			echo "<br />creating dragons";
		}
	}
	
	class University extends Dojo
	{
		function __construct()
		{
			echo "<br />creating a new university";
			parent::__construct;
		}
		
		public function create_sensies()
		{
			echo "Create Senseis";
		}
	}
	
	$university_1 = new University();
	
	$dojo1 = new Dojo("Coding Dojo");
	//$dojo2 = new Dojo();
	//$dojo3 = new Dojo();
	
	//$dojo1->name = "Coding Dojo";
	//$dojo2->name = "Hacking Dojo";
	//$dojo3->name = "MojoDojo";
	
	//echo $dojo1->name;
	
	//$dojo1->create_ninjas();
	
	var_dump($dojo1);
	//var_dump($dojo2);
	//var_dump($dojo3);
?>