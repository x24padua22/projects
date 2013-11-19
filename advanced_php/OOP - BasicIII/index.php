<?php
	class HTML_Helper
	{
		var $name;
		var $state;
		
		function __construct($array)
		{
			$this->name = $array;
		}
		
		function print_table()
		{
			echo "<table border=1>";
			if(!isset($_SESSION["table"]))
			{
				echo "<thead><tr>";
				
				foreach($this->name as $key => $value)
				{
					echo "<th> " . $key . " </th>";
				}
				
				echo "</tr></thead>";
				$_SESSION["table"] = TRUE;
			}
			
			echo "<tbody><tr>";
			
			foreach($this->name as $key => $value)
			{
				echo "<td width=100> " . $value . " </td>";
			}
			
			echo "</tr><tbody></table>";
		}
		
		function print_select($state, $array)
		{
			echo "<select name='". $this->state . "'>";
			
			foreach($this->name as $key => $value)
			{
				echo "<option value='" . $value . "'>" . $value . "</option>";
			}
			
			echo "</select>";
		}
	}
	
	$user1 = new HTML_Helper(array("First Name" => "Michael","Last Name" => "Choi","Nickname" => "Sensei"));
	$user2 = new HTML_Helper(array("First Name" => "Rozen","Last Name" => "Macapagal","Nickname" => "Zen"));
	$user3 = new HTML_Helper(array("First Name" => "John","Last Name" => "Supsupin","Nickname" => "John"));
	
	echo "Print Table <br />";
	$user1->print_table();
	$user2->print_table();
	$user3->print_table();
	
	echo "<br />Print Select <br />";
	$sample_array = new HTML_Helper(array("CA", "WA", "UT", "TX", "AZ", "NY"));
	$sample_array->print_select("state", $sample_array);
	
?>