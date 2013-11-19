<?php
	require_once("connection.php");
	session_start();
	
	class Process
	{
		var $connection;
		var $country_names;
		
		function show_countries()
		{
			$this->connection = new Database();
			
			if(isset($_POST["action"]) AND $_POST["action"] == "select_country")
			{
				$get_countries_query = "SELECT id, name FROM countries";
				$country_names = $this->connection->fetch_all($get_countries_query);
				
				if(count($country_names) > 0)
				{
					$_SESSION["start"] = TRUE;
					foreach($country_names as $key)
					{
						$country["id"] = $key["id"];
						$country["country_name"] = $key["name"];
					}
				}
			}
		}
		
		function get_country_info()
		{
			$get_country_info_query = "SELECT name, continent, region, population, life_expectancy, government_form 
									   FROM countries
									   id=$country_id";
			$country = $this->connection->fetch_record($get_country_info_query);
			
			if($country == TRUE)
			{
				$_SESSION["picked_country"] == TRUE;
				$_SESSION["name"] = $country["name"];
				$_SESSION["continent"] = $country["continent"];
				$_SESSION["region"] = $country["region"];
				$_SESSION["population"] = $country["population"];
				$_SESSION["life_expectancy"] = $country["life_expectancy"];
				$_SESSION["government_form"] = $country["government_form"];
			}
		}
	}
	
	$country = new Process();
	$country->show_countries();
	
	//header("Location: index.php");
	//exit;
?>