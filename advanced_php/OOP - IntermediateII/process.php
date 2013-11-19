<?php
	require_once("connection.php");
	session_start();
	
	class Process
	{
		var $connection;
		var $country_names;
		
		function __construct()
		{
			$this->connection = new Database();
			
			$get_countries_query = "SELECT code,name FROM country";
			$country_names = $this->connection->fetch_all($get_countries_query);
			$_SESSION["start"] = TRUE;
			
			foreach($country_names as $country)
			{
				$name[] = $country["name"];
				$code[] = $country["code"];
			}
			
			$_SESSION["country_name"] = $name;
			$_SESSION["country_code"] = $code;
		}
		
		function get_country_info()
		{
			$this->connection = new Database();
			
			if(isset($_POST["action"]) AND $_POST["action"] == "select_country" AND !empty($_POST["country"]))
			{
				$get_country_info_query = "SELECT Name, Continent, Region, Population, LifeExpectancy, GovernmentForm 
										   FROM country
										   WHERE Code='" . $_POST["country"] . "'";
				$country_info = $this->connection->fetch_record($get_country_info_query);
				
				if($country_info == TRUE)
				{
					$_SESSION["pick"] = TRUE;
					$_SESSION["name"] = $country_info["Name"];
					$_SESSION["continent"] = $country_info["Continent"];
					$_SESSION["region"] = $country_info["Region"];
					$_SESSION["population"] = $country_info["Population"];
					$_SESSION["life_expectancy"] = $country_info["LifeExpectancy"];
					$_SESSION["government_form"] = $country_info["GovernmentForm"];
				}
			}
		}
	}
	
	$country = new Process();
	$country->get_country_info();
	
	header("Location: index.php");
	exit;
?>