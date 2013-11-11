<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic4</title>
</head>
<body>
	<?php
		$numbers = array(135, 2.4, 2.67, 1.23, 332, 2, 1.02);
		
		$lower_number = $numbers[0];
		$higher_number = $numbers[0];
		
		for($i = 0; $i < count($numbers); $i++)
		{
			$current_number = $numbers[$i];
			if($current_number <= $lower_number)
			{
				$lower_number = $current_number;
			}
			else if($current_number >= $higher_number)
			{
				$higher_number = $current_number;
			}
			else
			{
				
			}
		}
		
		echo "min: " . $lower_number . "<br />max: " . $higher_number;
	?>
</body>
</html>