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
				<li><a href="/users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/users/logout">Log Off</a></li>
			</ul>
			</div>
		</div>
		<div id="main_contents">
			<h3><?= $user_data["first_name"] . " " . $user_data["last_name"] ?></h3>
			<ul class="list-unstyled">
				<li>Registered at: <?= $user_data["created_at"] ?></li>
				<li>User ID: #<?= $user_data["id"] ?></li>
				<li>Email Address: <?= $user_data["email"] ?></li>
				<li>Desciption: <?= $user_data["description"] ?></li>
			</ul>
			<div>
				<form action="../show/<?= $user_data['id']?>" id="messages_form" method="post">
					<label for="message">Leave a message for <?= $user_data["first_name"] ?></label>
					<textarea name="message" cols="150" rows="5"></textarea>
					<input type="submit" value="Post" class="btn btn-success" />
				</form>
			</div>
<?php		if(!empty($messages_info))
			{
?>
				<div>
<?php			foreach($messages_info as $key => $value)
				{
					echo array_shift($key["posted_by"]) . " " . array_shift($key["posted_at"]);
					echo $key["message"];
				}
?>
				</div>
<?php		}	?>
		</div>
	</div>
</body>
</html>