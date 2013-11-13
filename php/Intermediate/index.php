<?php
	session_set_cookie_params(3600,"/");
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>intermediate - Make Money!</title>
	<link rel="stylesheet" href="intermediate.css">
<body>
	<div id="wrapper">
		<p>Your Gold: 
<?php		if(isset($_SESSION["earnings"]))
			{
?>
				<input type="text" name="golds_earned" value="<?= $_SESSION["earnings"] ?>" / >
<?php		}	?>
		</p>
		<div class="buildings">
			<h1>Farm</h1>
			<p>(earns 10-20 golds)</p>
			<form id="farm_form" action="process.php" method="post">
				<input type="hidden" name="action" value="farm"/>
				<input type="submit" />
			</form>
		</div>
		<div class="buildings">
			<h1>Cave</h1>
			<p>(earns 5-10 golds)</p>
			<form id="cave_form" action="process.php" method="post">
				<input type="hidden" name="action" value="cave"/>
				<input type="submit" />
			</form>
		</div>
		<div class="buildings">
			<h1>House</h1>
			<p>(earns 2-5 golds)</p>
			<form id="house_form" action="process.php" method="post">
				<input type="hidden" name="action" value="house"/>
				<input type="submit" />
			</form>
		</div>
		<div class="buildings">
			<h1>Casino!</h1>
			<p>(earns/takes 0-50 golds)</p>
			<form id="casino_form" action="process.php" method="post">
				<input type="hidden" name="action" value="casino"/>
				<input type="submit" />
			</form>
		</div>
		<p>Activities:</p>
		<form id="activity_form" action="process.php" method="post">
			<input type="hidden" name="action" value="activity"/>
			<textarea name="activities">
<?php			if(isset($_SESSION["activity_log"]))
				{
					echo $_SESSION["activity_log"];
				}
?>
			</textarea>
			<input type="submit" name="reset" value="Reset Game" />
		</form>
	</div>
</body>
</html>
