<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic2</title>
</head>
<body>
	<?php
		$states = array("CA", "WA", "VA", "UT", "AZ");
		
		echo "<p>DropDown Menu using For Loop</p>";
		echo "<select>";
			for($i = 0; $i < count($states); $i++)
			{
				echo "<option>" . $states[$i] . "</option>";
			}
		echo "</select>";
		
		echo "<p>DropDown Menu using Foreach</p>";
		echo "<select>";
			foreach($states as $state)
			{
				echo "<option>" . $state . "</option>";
			}
		echo "</select>";
		
		$states[] = "NJ";
		$states[] = "NY";
		$states[] = "DE";
		echo "<p>DropDown Menu with added states</p>";
		echo "<select>";
			for($i = 0; $i < count($states); $i++)
			{
				echo "<option value=' " . $i . " '>" . $states[$i] . "</option>";
			}
		echo "</select>";
	?>
</body>
</html>