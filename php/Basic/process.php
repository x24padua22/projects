<?php
	session_start();

	if(isset($_POST["action"]) && $_POST["action"] == "register")
	{
		$email = $_POST["email"];
		
		if(empty($email))
		{
			$_SESSION["error"][$email] = "Email is required";
			header("Location: index.php");
			exit();
		}
		else
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION["error"][$email] = "The email address you entered '" . $email . "' is NOT a valid email address!";
				header("Location: index.php");
			}
			else
			{
				$_SESSION["success"][$email] = "The email address you entered '" . $email . "' is a VALID email address! Thank you!";
				header("Location: success.php");
			}
		}
	}
?>