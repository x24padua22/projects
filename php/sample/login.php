<?php
	session_start();
	
	if($_POST["email"] != "" && $_POST["password"] != "")
	{
		$_SESSION["is_login"] = TRUE;
	}
	else
	{
		$_SESSION["is_login"] = FALSE;
	}
	//echo "this is the date from post method <br />";
	//var_dump($_POST);
	//echo "this is the date from get method <br />";
	//var_dump($_GET);
?>