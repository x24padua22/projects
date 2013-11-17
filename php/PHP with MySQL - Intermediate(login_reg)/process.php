<?php
	session_start();
	require_once("connection.php");
	
	function register($connection, $post)
	{
		foreach($post as $name => $value)
		{
			if(empty($value))
			{
				$_SESSION["error"][$name] = $name . " is required";
			}
			else
			{
				switch ($name)
				{
					case "email":
						if(!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION["error"][$name] = "'" . $value . "'" . " is not a valid email.";
						}
					break;
					case "first_name":
					case "last_name":
						if(is_numeric($value))
						{
							$_SESSION["error"][$name] = $name . " cannot contain number";
						}
						else if(strlen($value) < 6)
						{
							$_SESSION["error"][$name] = $name . " must be 6 characters or more.";
						}
					break;
					case "password":
						if(strlen($value) < 8)
						{
							$_SESSION["error"][$name] = $name . " must be 8 characters or more.";
						}
					break;
					case "confirm_password":
						if($_POST["password"] != $_POST["confirm_password"])
						{
							$_SESSION["error"][$name] = "Your password do not match.";
						}
					break;
				}
			}
		}
		if($_SESSION["error"] == "")
		{
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$hash = crypt($post["password"], $salt);
			
			$add_users_query = "INSERT INTO users (email, first_name, last_name, password, created_at) 
					VALUES ('" . $post["email"] . "', '" . $post["first_name"] . "', '" . $post["last_name"] . "', '" . $hash . "', NOW())";
			mysql_query($add_users_query);
			$user_id = mysql_insert_id($connection);
			$_SESSION["user_id"] = $user_id;
			
			header("Location: profile.php?id=".$user_id);
			exit;
		}
	}
	
	function login($connection, $post)
	{
		if(empty($post["email"]) || empty($post["password"]))
		{
			$_SESSION["error"]["message"] = "Email or password cannot be blank.";
		}
		else
		{
			$select_user = fetchRecord("SELECT id, password
							FROM users
							WHERE email = '".$post["email"]."'");
			
			if(empty($select_user))
			{
				$_SESSION["error"]["message"] = "Could not find email in database.";
			}
			else
			{
				if(crypt($post["password"], $select_user["password"]) != $select_user["password"])
				{
					$_SESSION["error"]["message"] = "Incorrect password.";
				}
				else
				{
					$_SESSION["user_id"] = $select_user["id"];
					header("Location: profile.php?id=".$select_user["id"]);
					exit;
				}
			}
		}
	}
	
	function logout()
	{
		$_SESSION = array();
		session_destroy();
	}
	
	if(isset($_POST["action"]) && $_POST["action"] == "register")
	{
		register($connection, $_POST);
	}
	else if(isset($_GET["logout"]))
	{
		logout();
	}
	else if(isset($_POST["action"]) && $_POST["action"] == "login")
	{
		login($connection, $_POST);
	}
	
	header("Location: index.php");
?>