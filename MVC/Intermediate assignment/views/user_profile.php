<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>User Profile</title>
</head>
<body>
	<div>
		<h3>Hello, <?= $user_session["first_name"]; ?>!</h3>
		<p>User Information:</p>
		<ul>
			<li>Name: <?= $user_session["first_name"] . " " . $user_session["last_name"]; ?></li>
			<li>Email: <?= $user_session["email"]; ?></li>
			<li>Password: <?= $user_session["password"]; ?></li>
		</ul>
		<p><a href="/login/logout">Logout</a></p>
	</div>
</body>
</html>