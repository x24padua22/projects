<?php
	session_start();
	require_once("connection.php");
	
	function reserve($connection, $post)
	{
		foreach($post as $info => $value)
		{
			switch ($info)
			{
				case "check_in":
				case "check_out":
					$check_in_out = explode("/", $value);
					
					if(empty($value))
					{
						$_SESSION["error"][$info] = $info . " is required.";
					}
					else if(!checkdate($check_in_out[0], $check_in_out[1], $check_in_out[2]))
					{
						$_SESSION["error"][$info] = $info . " is not a valid date";
					}
				break;
				case "first_name":
				case "last_name":
					if(empty($value))
					{
						$_SESSION["error"][$info] = $info . " is required.";
					}
					else if(is_numeric($value))
					{
						$_SESSION["error"][$info] = $info . " cannot contain numbers.";
					}
				break;
				case "email";
					if(empty($value))
					{
						$_SESSION["error"][$info] = $info . " is required.";
					}
					else if(!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION["error"][$info] = "'" . $value . "'" . " is not a valid email.";
						}
				break;
			}
			
		}
		if($_SESSION["error"] == "")
		{
			$check_in_out_date = $check_in_out[2]."-".$check_in_out[0]."-".$check_in_out[1];
			$number_of_rooms = $post["number_of_rooms"];
			$get_room_id = fetchRecord("SELECT id FROM rooms WHERE room_type_id = '".$post["room_type"]."'");
			$_SESSION["room_id"] = $get_room_id["id"];
			
			
			$add_reservation_query = "INSERT INTO reservations (first_name, last_name, email, check_in, check_out, number_of_rooms, requests, room_id, created_at) 
					VALUES ('" . $post["first_name"] . "', '" . $post["last_name"] . "', '" . $post["email"] . "', '" . $check_in_out_date . "', 
					'" . $check_in_out_date . "', " . $number_of_rooms .", '" . $post["requests"] . "', " . $_SESSION["room_id"] . ", NOW())";
			$add_reservation = mysql_query($add_reservation_query);
			
			if($add_reservation == TRUE)
			{
				$user_id = mysql_insert_id($connection);
			}
			
			$_SESSION["success"] = "Thank you for your reservation, " . $post["first_name"] . "!";
		}
	}
	
	function login($connection, $post)
	{
		foreach($post as $admin_info => $value)
		{
			if(empty($value))
			{
				$_SESSION["error"][$admin_info] = $admin_info . " cannot be blank";
			}
			else
			{
				$get_admin_query = "SELECT * FROM admin WHERE username = '".$post["username"]."' AND password ='".$post["password"]."'";
				$users = fetch_all($query);
				
				if(count($users)>0)
				{
					header("Location: reservation_list.php");
				}
				else
				{
					$_SESSION["error"] = "Invalid";
				}
			}
		}
	}
	
	
	if(isset($_POST["action"]) && $_POST["action"] == "reserve")
	{
		reserve($connection, $_POST);
	}
	if(isset($_POST["action"]) && $_POST["action"] == "login")
	{
		login($connection, $_POST);
	}
	
	header("Location: index.php");
	exit;
?>