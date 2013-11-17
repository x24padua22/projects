<?php
	session_start();
	require_once("connection.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Profile</title>
</head>
<body>
	<div>
<?php	
		$select_user_query = fetchRecord("SELECT email, first_name, last_name 
										FROM users 
										WHERE id = '".$_GET["id"]."'");
		if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $_GET["id"])
		{
?>
			<p>
				Hello, <?= $select_user_query["first_name"] . " " . $select_user_query["last_name"] ?>! 
				<a href="process.php?Logout=1">Logout</a>
			</p>
<?php	}	?>
	</div>
</body>
</html>