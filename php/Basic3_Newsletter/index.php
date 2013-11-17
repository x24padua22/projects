<?php
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Newsletter</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<div id="wrapper">
<?php	if(isset($_SESSION["error"]))
		{
			foreach($_SESSION["error"] as $input => $message)
			{	?>
				<p><?= $message ?></p>
<?php		}
		}
		else if(isset($_SESSION["success"]))
		{	?>
			<p><?= $_SESSION["success"] ?></p>
<?php	}	?>
		<form id="reg_form" action="validate.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="register" />
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="first_name" />
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="last_name" />
			<label for="email">Email</label>
			<input type="text" name="email" id="email" />
			<input type="file" name="file" />
			<label>What Topics are you interested in hearing about?</label>
			<label><input type="checkbox" name="topics" value="1" />Ruby on Rails</label>
			<label><input type="checkbox" name="topics" value="2" />PHP</label>
			<label><input type="checkbox" name="topics" value="3" />Javascript</label>
			<label><input type="checkbox" name="topics" value="4" />iOS</label>
			<label><input type="checkbox" name="topics" value="5" />Database Design</label>
			<label><input type="checkbox" name="topics" value="6" />SQL</label>
			<input type="submit" />
		</form>
		<h3>See what other students are interested in!</h3>
		
	</div>
</body>
</html>
<?php
	$_SESSION = array();
?>