<?php
	session_start();
	require_once("connection.php");

	$emails = fetchAll("SELECT email_address, created_at FROM emails");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>sucess page</title>
	<link rel="stylesheet" href="css/success.css">
</head>
<body>
	<div id="wrapper">
<?php	if(isset($_SESSION["success"]))
		{
			$message = array_shift($_SESSION["success"]);		
?>
			<p id="success"><?= $message ?></p>
			<h3>Email addresses entered: </h3>
<?php			
			foreach($emails as $emails)
			{
?>
				<p><?= $emails["email_address"] . "  " . date("m/d/Y g:i A", strtotime($emails["created_at"])) ?></p>
<?php		}
		}
?>
	</div>
</body>
</html>