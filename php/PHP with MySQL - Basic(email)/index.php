<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>basic - email validation</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<div id="wrapper">
<?php		if(isset($_SESSION["error"]))
			{
				$message = array_shift($_SESSION["error"]);
?>
				<p id="error"><?= $message ?></p>
<?php		}	?>
		<p>Please enter your email address: </p>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="register" />
			<input type="text" name="email" placeholder="Please Enter Email" />
			<input type="submit" />
		</form>
	</div>
</body>
</html>
<?php
	session_unset();
?>