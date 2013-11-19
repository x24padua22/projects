<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<?php include("class_lib.php"); ?>
</head>
<body>
<?php
	$rozen = new person("Rozen Macapagal");	
	echo "My full name is " . $rozen->get_name();
	
	$bats = new employee("Bats Layug");
	echo "<br />:) " . $bats->get_name();
?>
</body>
</html>