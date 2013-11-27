<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<p>Welcome, <?= $user_info["first_name"] ?>!</p>
	<p><?= $email ?></p>
	<form id="logout" action="login/logout" method="post">
		<input type="submit" value="Logout" />
	</form>
</body>
</html>