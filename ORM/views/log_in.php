<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="/assets/css/time_record.css"/>
	<title>Login Page</title>
</head>
<body>
	<div id="wrapper">
		<h3>Log In</h3>
<?php	if(isset($error))
		{
?>
			<p><?= $error; ?></p>
<?php	}	?>
		<form id="login" action="/time_recorder/process_login" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="text" name="email" id="email" class="form-control" />
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class="form-control" />
			</div>
			<input type="submit" value="Login" class="btn btn-primary" />
		</form>
		<a href="/time_recorder">Register</a>
	</div>
</body>
</html>