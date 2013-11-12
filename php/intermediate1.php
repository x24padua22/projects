<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>intermediate1</title>
</head>
<body>
	<?php
		function draw_stars($array)
		{
			foreach($array as $item)
			{
				if((is_string($item)) == true)
				{
					$length = strlen($item);
					$first_letter = strtolower($item[0]);
					
					for($i = 0; $i < $length; $i++)
					{
						echo $first_letter;
					}
					echo "<br />";
				}
				else
				{
					for($i = 0; $i < $item; $i++)
					{
						echo "*";
					}
					echo "<br />";
				}
			}
		}
		
		$stars = array(4, 6, 1, 3, 5, 7, 25);
		echo "output for array with numerical values only: <br />";
		draw_stars($stars);
		
		$num_and_str = array(4, "Tom", 1, "Michael", 5, 7, "Jimmy Smith");
		echo "<br />output for array with numbers and strings: <br />";
		draw_stars($num_and_str);
	?>
</body>
</html>