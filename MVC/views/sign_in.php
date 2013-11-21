<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Signin Page</title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/test.css">
</head>
<body>
	<div id="wrapper">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="/test">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../test/signin">Sign In</a></li>
			</ul>
		</div>
		<div id="main_contents">
			<h3>Signin</h3>
			<form id="signin_form" action="/test/process_signin" method="post">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<input type="submit" value="Signin" class="btn btn-success" />
			</form>
			<a href="../test/register">Don't have an account? Register</a>
		</div>
	</div>
</body>
</html>