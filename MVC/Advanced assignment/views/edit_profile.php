<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
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
				<li><a href="/users/edit/<?= $user_data['id']?>">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/test">Log Off</a></li>
			</ul>
			</div>
		</div>
		<div id="main_contents">
			<h3>Edit Profile</h3>
			<h4>Edit Information</h4>
			<form id="edit_profile_form" action="/users/process_edit_profile/<?= $user_data['id'] ?>" method="post" class="pull-left">
				<div class="form-group">
					<label for="first_name">First Name:</label>
					<input type="text" name="first_name" class="form-control" value="<?= $user_data["first_name"] ?>">
					</input>
				</div>
				<div class="form-group">
					<label for="last_name">Last Name:</label>
					<input type="text" name="last_name" class="form-control" value="<?= $user_data["last_name"] ?>">
					</input>
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" class="form-control" value="<?= $user_data["email"] ?>">
					</input>
				</div>
				<input type="submit" value="Save" class="btn btn-success" />
			</form>
			<h4>Change Password</h4>
			<form id="change_password_form" action="/users/process_change_password/<?= $user_data['id'] ?>" method="post" class="pull-right">
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" class="form-control" />
				</div>
				<div class="form-group">
					<label for="confirm_password">Password Confirmation:</label>
					<input type="password" name="confirm_password" class="form-control" />
				</div>
				<input type="submit" value="Update Password" class="btn btn-success" />
			</form>
			<div class="clearfix"></div>
			<h4>Edit Description</h4>
			<form id="edit_description_form" action="/users/process_edit_description/<?= $user_data['id'] ?>" method="post">
				<textarea name="description" cols="150" rows="5"><?= $user_data["description"] ?></textarea>
				<input type="submit" value="Save" class="btn btn-success" />
			</form>
		</div>
	</div>
</body>
</html>