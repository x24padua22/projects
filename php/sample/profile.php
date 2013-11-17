<?php
	session_start();
	
	if($_SESSION["is_login"])
	{
		echo "You are logged in.";
	}
	else
	{
		echo "You are not logged in.";
	}
?>