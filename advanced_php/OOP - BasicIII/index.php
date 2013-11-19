<?php
	class HTML_Helper
	{
		var $names = array();
		
		
		function print_table($names)
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