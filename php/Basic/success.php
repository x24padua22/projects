<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>sucess page</title>
</head>
<body>
<?php	if(isset($_SESSION["success"]))
		{
			$message = array_shift($_SESSION["success"]);		
?>
			<p><?= $message ?></p>
<?php	}	?>
</body>
</html>