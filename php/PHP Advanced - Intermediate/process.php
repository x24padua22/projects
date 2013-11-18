<?php
	session_set_cookie_params(3600,"/");
	session_start();
	
	if(isset($_POST["action"]) && $_POST["action"] == "farm")
	{
		$golds = rand(10, 20);
		$_SESSION["activities"] = "You entered a farm and earned " . $golds . " golds.";
		
		if(isset($_SESSION["activities"]))
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date('m-d-y H:i:s') . ")     " . $_SESSION["activity_log"];
		}
		else
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date("m-d-y H:i:s") . ")     ";
		}
	}
	else if(isset($_POST["action"]) && $_POST["action"] == "cave")
	{
		$golds = rand(5, 10);
		$_SESSION["activities"] = "You entered a cave and earned " . $golds . " golds.";
		
		if(isset($_SESSION["activities"]))
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date('m-d-y H:i:s') . ")     " . $_SESSION["activity_log"];
		}
		else
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date("m-d-y H:i:s") . ")     ";
		}
	}
	else if(isset($_POST["action"]) && $_POST["action"] == "house")
	{
		$golds = rand(2, 5);
		$_SESSION["activities"] = "You entered a house and earned " . $golds . " golds.";
		
		if(isset($_SESSION["activities"]))
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date('m-d-y H:i:s') . ")     " . $_SESSION["activity_log"];
		}
		else
		{
			$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date("m-d-y H:i:s") . ")     ";
		}
	}
	else if(isset($_POST["action"]) && $_POST["action"] == "casino")
	{
		$earn_take = rand(1, 2);
		
		switch ($earn_take)
		{
			case 1:
				$golds = rand(0, 50);
				$_SESSION["activities"] = "You entered a casino and earned " . $golds . " golds.";
				if(isset($_SESSION["activities"]))
					{
						$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date('m-d-y H:i:s') . ") " . $_SESSION["activity_log"];
					}
					else
					{
						$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date("m-d-y H:i:s") . ")";
					}
			break;
			case 2:
				$golds = rand(-50, 0);
				$_SESSION["activities"] = "You entered a casino and lost " . $golds . " golds.";
				if(isset($_SESSION["activities"]))
					{
						$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date('m-d-y H:i:s') . ") " . $_SESSION["activity_log"];
					}
					else
					{
						$_SESSION["activity_log"] = $_SESSION["activities"] . " (" . date("m-d-y H:i:s") . ")";
					}
			break;
		}
	}
	
	if(isset($_SESSION["earnings"]))
	{
		$golds_earned = $_SESSION["earnings"];
		$total_gold = $golds_earned + $golds;
	}
	else
	{
		$total_gold = $golds;
	}
	
	$_SESSION["earnings"] = $total_gold;
	
	if(isset($_POST["action"]) && $_POST["action"] == "activity")
	{
		$_SESSION = array();
	}
		
	header("Location: index.php");
?>