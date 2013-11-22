<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>User Information</title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/test.css">
</head>
<body>
	<div id="wrapper">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a href="/test" class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="/users/dashboard">Dashboard</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="../users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../test">Log Off</a></li>
			</ul>
			</div>
		</div>
		<div id="main_contents">
			<h3><?= $login_data["first_name"] . " " . $login_data["last_name"] ?></h3>
			<ul class="list-unstyled">
				<li>Registered at: <?= $login_data[created_at] ?></li>
				<li>User ID: #<?= $login_data[id] ?></li>
				<li>Email Address: <?= $login_data[email] ?></li>
				<li>Desciption: <?= $login_data[description] ?></li>
			</ul>
		</div>
	</div>
</body>
</html>