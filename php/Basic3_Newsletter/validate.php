<?php
	session_start();
	require_once("connection.php");
	
	function register($connection, $post)
	{
		foreach($post as $input => $value)
		{
			if(empty($value))
			{
				$_SESSION["error"][$input] = $input . " is required";
			}
			else
			{
				switch ($input)
				{
					case "first_name":
					case "last_name":
						if(is_numeric($value))
						{
							$_SESSION["error"][$input] = $input . " cannot have numbers";
						}
					break;
					case "email":
						if(!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION["error"][$input] = $value . " is not a valid email";
						}
					break;
					case "topics":
						$interests_query[] = fetchRecord("SELECT name FROM topics 
						WHERE id = '" . $value . "' ");
					break;
				}
			}
		}
		
		if($_FILES["file"]["error"] > 0)
		{
			$_SESSION["error"]["file"] = "Error on file upload.";
		}
		else
		{
			$directory = "upload/";
			$file_name = $_FILES["file"]["name"];
			$file_path = $directory.$file_name;
			
			if(file_exists($file_path))
			{
				$_SESSION["error"]["file"] = $file_name . " already exists";
			}
			else
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"], $file_path))
				{
					$_SESSION["error"]["file"] = $file_name . " could not be saved";
				}
			}
		}
		
		if($_SESSION["error"] == "")
		{
			$_SESSION["success"] = "Thank you, " . $post["first_name"] . ". You have successfully registered!";
			$add_student_query = "INSERT INTO students (first_name, last_name, email, pic_url, created_at) 
					VALUES ('" . $post["first_name"] . "', '" . $post["last_name"] . "', '" . $post["email"] . "', '" . $file_name . "', NOW())";
			$add_student = mysql_query($add_student_query);
			
			if($add_student == TRUE)
			{
				$user_id = mysql_insert_id($connection);
				header("Location: index.php?=" . $user_id);
				exit;
			}
		}
	}
	
	if(isset($_POST["action"]) && $_POST["action"] == "register")
	{
		register($connection, $_POST);
	}
	
	header("Location: index.php");
?>