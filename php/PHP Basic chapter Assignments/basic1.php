<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic1</title>
</head>
<body>
	<?php
		$score = rand(50,100);
		
		if($score >= 70 && $score <= 80)
		{
			$grade = 'C';
		}
		else if($score >= 80 && $score <= 90)
		{
			$grade = 'B';
		}
		else if($score >= 90 && $score <= 100)
		{
			$grade = 'A';
		}
		else
		{
			$grade = 'D';
		}
		echo "<h1>Your Score: " . $score . "/100 </h1>" . "<h2>Your grade is " . $grade . "</h2>";
		
		echo "Generate score for 100 times <br />";
		
		for($counter = 1; $counter <= 100; $counter++)
		{
			$score = rand(50,100);
		
			if
			($score >= 70 && $score <= 80){
				$grade = 'C';
			}
			else if($score >= 80 && $score <= 90)
			{
				$grade = 'B';
			}
			else if($score >= 90 && $score <= 100)
			{
				$grade = 'A';
			}
			else
			{
				$grade = 'D';
			}
	
			echo "<h1>" . $counter . ". Your Score: " . $score . "/100 </h1>" . "<h2>Your grade is " . $grade . "</h2>";
		}
	?>
</body>
</html>









