<?php
	class person
	{
		var $name;
		
		function __construct($persons_name)
		{
			$this->name = $persons_name;
		}
		
		/*
		function set_name($new_name)
		{
			$this->name = $new_name;
		}
		*/
		
		function get_name()
		{
			return $this->name;
		}
		
		//protected restricted access
		protected function set_name($new_name)
		{
			if(name != "Jimmy")
			{
				$this->name = $new_name;
			}
		}
	}
	
	class employee extends person
	{
		function __construct($employee_name)
		{
			$this->set_name($employee_name);
		}
		
		//protected restricted access
		protected function set_name($new_name)
		{
			if($new_name == "Stefen")
			{
				$this->name = $new_name;
			}
			else if($new_name == "Johnny")
			{
				person::set_name($new_name);	//access the parent class' version of set_name method
			}
		}
	}
?>