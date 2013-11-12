<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>intermediate2</title>
	<style type="text/css">
		tr:nth-child(odd)
		{
			background-color: lightgray;
		}
		th, td{
			padding: 5px;
			border:1px solid #000;
		}
	</style>
</head>
<body>
	<?php
		echo "<table><tbody><tr>";
		
		for($top = 0; $top < 10; $top++)
		{
			if($top == 0)
			{
				echo "<th></th>";
			}
			else
			{
				echo "<th>" . $top . "</th>";
			}
		}
		
		echo "</tr>";
		
		for($vertical = 1; $vertical < 10; $vertical++)
		{
			echo "<tr><td><b>" . $vertical . "</b></td>";
			
			for($horizontal = 1; $horizontal < 10; $horizontal++)
			{
				echo "<td>" . $horizontal * $vertical . "</td>";
			}
			
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	?>
</body>
</html>