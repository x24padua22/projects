<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic4</title>
</head>
<body>
	<?php
		$numbers = array(135, 2.4, 2.67, 1.23, 332, 2, 1.02);
		
		function get_max_and_min($array)
		{
			$lower_number = $array[0];
			$higher_number = $array[0];
			
			for($i = 0; $i < count($array); $i++)
			{
				$current_number = $array[$i];
				if($current_number >= $higher_number)
				{
					$higher_number = $current_number;
				}
				else if($current_number <= $lower_number)
				{
					$lower_number = $current_number;
				}
				else
				{
					$higher_number = $higher_number;
					$lower_number = $lower_number;
				}
				
			}
			$array = array('max' => $higher_number, 'min' => $lower_number);
			
			return $array;
		}
		
		$output = get_max_and_min($numbers);
		var_dump($output);
	?>
</body>
</html>