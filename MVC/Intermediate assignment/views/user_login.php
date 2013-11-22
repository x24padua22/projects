<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>User Login</title>
	<link rel="stylesheet" href="../assets/css/user_login.css">
</head>
<body>
	<div id="wrapper">
		<div class="div_form">
			<h3>Login</h3>
			<?= $login_errors ?>
			<form id="login" action="/login/process_login" method="post">
				<label for="email_login">Email: </label>
				<input type="text" name="email_login"/>
				<label for="password_login">Password</label>
				<input type="password" name="password_login"/>
				<input type="submit" value="Login" />
			</form>
		</div>
		<div class="div_form">
			<h3>Register</h3>
			<?= $registration_errors ?>
			<form id="register" action="/login/process_registration" method="post">
				<label for="first_name">First Name: </label>
				<input type="first_name" name="first_name"/>
				<label for="last_name">Last Name: </label>
				<input type="last_name" name="last_name"/>
				<label for="email">Email: </label>
				<input type="text" name="email"/>
				<label for="password">Password</label>
				<input type="password" name="password"/>
				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password"/>
				<input type="submit" value="Login" />
			</form>
		</div>
	</div>
</body>
</html>