<?php
	session_start();

	if(isset($_POST["action"]) && $_POST["action"] == "register")
	{
		foreach($_POST as $name => $value)
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
					break;
					case "password":
						if(strlen($value) < 6)
						{
							$_SESSION["error"][$name] = $name . " must be 6 characters or more.";
						}
					break;
					case "confirm_password":
						if($_POST["password"] != $_POST["confirm_password"])
						{
							$_SESSION["error"][$name] = "Your password do not match.";
						}
					break;
					case "birthday":
						$birthday = explode("/", $value);
						if(!checkdate($birthday[0], $birthday[1], $birthday[2]))
						{
							$_SESSION["error"][$name] = $name . " is not a valid date.";
						}
					break;
				}
			}
		}
		if($_SESSION["error"] == "")
		{
			$_SESSION["success"] = "Thanks for submitting your information";
		}
	}
	
	header("Location: index.php");
?>