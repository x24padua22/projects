<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/assets/css/friends.css">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#registration").submit(function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					if(data.status)
					{
						window.location.href = "/friends/view_friends";
					}
					else
					{
						$("#registration_errors").html(data.errors);
					}
				}, "json");
				
				return false;
			});
			
			$("#login").submit(function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					if(data.status)
					{
						window.location.href = "/friends/view_friends";
					}
					else
					{
						$("#login_errors").html(data.errors);
					}
				}, "json");
				
				return false;
			});
		});
	</script>
	<title>Login Page</title>
</head>
<body>
	<div id="wrapper">
		<div class="forms pull-left">
			<h3>Register</h3>
			<p id="registration_errors"></p>
			<form id="registration" action="/friends/process_registration" method="post">
				<label for="full_name">Full Name</label>
				<input type="text" name="full_name" id="full_name" />
				<label for="alias">Alias</label>
				<input type="text" name="alias" id="alias" />
				<label for="email">Email</label>
				<input type="text" name="email" id="email" />
				<label for="password">Password</label>
				<input type="password" name="password" id="password" />
				<label for="confirm_password">Confirm Password</label>
				<input type="password" name="confirm_password" id="confirm_password" />
				<input type="submit" value="Register" class="btn btn-primary" />
			</form>
		</div>
		<div class="forms pull-right">
		<h3>Login</h3>
			<p id="login_errors"></p>
			<form id="login" action="/friends/process_login" method="post">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" />
				<label for="password">Password</label>
				<input type="password" name="password" id="password" />
				<input type="submit" value="Login" class="btn btn-primary" />
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
</body>
</html>