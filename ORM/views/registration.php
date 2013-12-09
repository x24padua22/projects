<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="/assets/css/time_record.css"/>
	<title>Registration Page</title>
</head>
<body>
	<div id="wrapper">
		<h3>Registration</h3>
<?php	if(isset($errors))
		{
?>
			<p><?= $errors; ?></p>
<?php	}	?>
		<form id="registration" action="/time_recorder/process_registration" method="post" class="form-horizontal">
			<div class="form-group">
				<label for="email" class="control">Email:</label>
				<input type="text" name="email" id="email" class="form-control" />
			</div>
			<div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" name="first_name" id="first_name" class="form-control" />
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" id="last_name" class="form-control" />
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class="form-control" />
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" name="confirm_password" id="confirm_password" class="form-control" />
			</div>
			<input type="submit" value="Register" class="btn btn-primary" />
		</form>
		<a href="/time_recorder/login">Login</a>
	</div>
</body>
</html>