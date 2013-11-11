<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic3</title>
	<style type="text/css">
		p{
			text-decoration: underline;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<p>Starting the program</p>
	<?php
		$head_count = 0;
		$tail_count = 0;
		for($counter = 1; $counter <= 5000; $counter++)
		{
			$option = rand(1,2);
			
			switch ($option)
			{
				case 1:			
					$coin = "head";
					$head_count++;
				break;
				
				case 2:
					$coin = "tail";
					$tail_count++;
				break;
			}
			
			echo "Attempt #" . $counter . ": Throwing a coin... It's a " . $coin . 
				"! Got " . $head_count . " head(s) so far and " . $tail_count . " tail(s) so far<br />";
		}
	?>
	<p>Ending the program - thank you!</p>
</body>
</html>