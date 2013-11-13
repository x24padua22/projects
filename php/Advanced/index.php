<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>advanced - registration form</title>
	<link rel="stylesheet" href="advanced.css">
</head>
<body>
<?php	if(isset($_SESSION["error"]))
		{
			foreach($_SESSION["error"] as $name => $message)
			{
?>
				<p><?= $message ?></p>
<?php
			}
		}	
?>
<?php	if(isset($_SESSION["success"]))
		{
?>
			<p><?= $_SESSION["success"] ?></p>
<?php	}	?>
	<form action="process.php" method="post">
		<input type="hidden" name="action" value="register" />
		<input type="text" name="email" placeholder="Email" />
		<input type="text" name="first_name" placeholder="First Name" />
		<input type="text" name="last_name" placeholder="Last Name" />
		<input type="password" name="password" placeholder="Password" />
		<input type="password" name="confirm_password" placeholder="Confirm Password" />
		<input type="text" name="birthday" placeholder="Birthday (dd/mm/yyyy)" />
		<input type="submit" value="Register" />
	</form>
</body>
</html>
<?php
	$_SESSION = array();
?>


