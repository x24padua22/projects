<?php
	require_once("connection.php");
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Country Info</title>
</head>
<body>
	<div id="wrapper">
		<form action="process.php" method="post" id="country_information">
			<input type="hidden" name="action" value="select_country" />
			<label for="country">Select Country: </label>
			<select name="country" id="country">
<?php
				if(isset($_SESSION["start"]))
				{
					foreach($_SESSION["country"] as $country["id"])
					{
?>
						<option value="<?= $country["id"] ?>">
							<?= $country["id"] ?>
						</option>
<?php				}
				}
?>
			</select>
			<input type="submit" value="Check Info" />
		</form>
<?php
		if(isset($_SESSION["picked_country"]))
		{
?>
			<div>
				<h1>Country Information</h1>
				<p>Country: <?= $_SESSION["name"] ?></p>
				<p>Continent: <?= $_SESSION["continent"] ?></p>
				<p>Region: <?= $_SESSION["region"] ?></p>
				<p>Population: <?= $_SESSION["population"] ?></p>
				<p>Life Expectancy: <?= $_SESSION["life_expectancy"] ?></p>
				<p>Government Form: <?= $_SESSION["government_form"] ?></p>
			</div>
<?php	}	?>
	</div>
</body>
</html>