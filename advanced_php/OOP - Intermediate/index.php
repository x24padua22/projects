<?php
	class Animal
	{
		public $name;
		public $health;
		
		function __construct($name)
		{
			$this->name = $name;
			$this->health = 100;
		}
		
		function walk()
		{
			$this->health = $this->health - 1;
		}
		
		function run()
		{
			$this->health = $this->health - 5;
		}
		
		function displayHealth()
		{
			echo "Name: " . $this->name . "<br />";
			echo "Health: " . $this->health . "<br />";
		}
	}
	
	class Dog extends Animal
	{
		function __construct($name)
		{
			$this->name = $name;
			$this->health = 150;
		}
		
		function pet()
		{
			$this->health = $this->health + 5;
		}
	}
	
	class Dragon extends Animal
	{
		function __construct($name)
		{
			$this->name = $name;
			$this->health = 170;
		}
		
		function fly()
		{
			$this->health = $this->health - 10;
		}
		
		function displayHealth()
		{
			echo "<br />This is a dragon! <br />";
			parent::displayHealth();
		}
	}
	
	$dog = new Dog("dog");
	$dog->walk();
	$dog->walk();
	$dog->walk();
	$dog->run();
	$dog->run();
	$dog->pet();
	$dog->displayHealth();
	
	$dragon = new Dragon("dragon");
	$dragon->walk();
	$dragon->walk();
	$dragon->walk();
	$dragon->run();
	$dragon->run();
	$dragon->fly();
	$dragon->fly();
	$dragon->displayHealth();
	
	//the following is just to show that the fly() and pet() methods do not work with class Animal.
	$animal = new Animal("animal");
	$animal->fly();
	$animal->pet();
?>