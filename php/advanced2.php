<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Advanced2</title>
	<style type="text/css">
		td
		{
			height: 20px;
			width: 20px;
		}
		td.red
		{
			background-color: red;
		}
		td.black
		{
			background-color: black;
		}
	</style>
</head>
<body>
	<?php
		echo "<table><tbody>";
		
		for($row = 1; $row <= 8; $row++)
		{
			echo "<tr>";
			
			for($square = 1; $square <= 8; $square++)
			{
				if($square%2 == $row%2)
				{
					echo "<td class='red'></td>";
				}
				else
				{
					echo "<td class='black'></td>";
				}
			}
			
			echo "</tr>";
		}
		
		echo "</tbody></table>";
	?>
</body>
</html>