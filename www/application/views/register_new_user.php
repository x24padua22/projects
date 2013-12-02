<?php include "application/views/header.php"; ?>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="/users/dashboard/admin">Dashboard</a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="/users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/users/logout">Log Off</a></li>
			</ul>
		</div>
		<div id="main_contents">
			<h3 class="col-md-9">Add a new user</h3>
			<a href="/users/dashboard/admin" class="btn btn-primary">Return to Dashboard</a>
			<div class="clearfix"></div>
<?php		if(isset($registration_errors))
			{
				echo $registration_errors;
			}
?>
<?php		if(isset($create_success))
			{
				echo $create_success;
			}
			else if(isset($create_failed))
			{
				echo $create_failed;
			}
?>
			<form id="registration_form" action="/users/process_create_new" method="post">
				<div class="form-group">
					<label for="first_name">First Name:</label>
					<input type="text" name="first_name" class="form-control" />
				</div>
				<div class="form-group">
					<label for="last_name">Last Name:</label>
					<input type="text" name="last_name" class="form-control" />
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" class="form-control" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<div class="form-group">
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" name="confirm_password" class="form-control" />
				</div>
				<input type="submit" value="Create" class="btn btn-success" />
			</form>
		</div>
	</div>
</body>
</html>