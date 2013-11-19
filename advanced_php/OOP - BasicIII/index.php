<?php
	class HTML_Helper
	{
		var $names = array();
		
		function __construct($array)
		{
			$this->names = $array;
			$this->names = $array;
			$this->names = $array;
			var_dump($this->names);
		}
		
		function print_table()
		{
			foreach($this->names as $keys => $value)
			{
				$names = "<td>" . $this->value . "</td>";
			}
		}
		
		function print_select()
		{
			
		}
	}
	
	$myArray = array();
	$myArray = new HTML_Helper("Michael", "Choi", "Sensei");
	$myArray->print_table();
	
?>