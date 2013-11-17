<?php
	session_start();
	require_once("connection.php");
	
	function register_email($connection, $post)
	{
		$email = $post["email"];
		
		if(empty($email))
		{
			$_SESSION["error"][$email] = "Email is required";
		}
		else
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION["error"][$email] = "The email address you entered '" . $email . "' is NOT a valid email address!";
			}
			else
			{
				$_SESSION["success"][$email] = "The email address you entered '" . $email . "' is a VALID email address! Thank you!";
				$query = "INSERT INTO emails (email_address, created_at) VALUES('" . $post["email"] . "', NOW())";
				mysql_query($query);
				$user = mysql_insert_id($connection);
				
				header("Location: success.php?id=" . $user);
				exit;
			}
		}
	}

	if(isset($_POST["action"]) && $_POST["action"] == "register")
	{
		register_email($connection, $_POST);
	}
	
	header("Location: index.php");
	exit;
?>