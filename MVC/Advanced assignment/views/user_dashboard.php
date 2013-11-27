<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Admin Dashboard</title>
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
				<li><a href="/test/logout">Log Off</a></li>
			</ul>
		</div>
		<div id="main_contents">
<?php		if(isset($administrator))
			{
?>
				<h3 class="col-md-10">Manage Users</h3>
				<a href="" class="btn btn-primary">Add New</a>
<?php		}
			else if(isset($non_admin))
			{
?>
				<h3>All Users</h3>
<?php		}	?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Created At</th>
						<th>User Level</th>
<?php					if(isset($administrator))
						{
?>
							<th>Actions</th>
<?php					}	?>
					</tr>
				</thead>
				<tbody>
<?php					for($i = 0; $i < count($user_data); $i++)
						{
?>						
							<tr>
								<td>
									<?= array_shift($user_data["id"]) ?>
								</td>
								<td>
									<a href="/users/show/<?= array_shift($user_data['id']) ?>">
										<?= array_shift($user_data["name"]) ?>
									</a>
								</td>
								<td>
									<?= array_shift($user_data["email"]) ?>
								</td>
								<td>
									<?= array_shift($user_data["created_at"]) ?>
								</td>
								<td>
									<?= array_shift($user_data["user_level"]) ?>
								</td>
<?php							if(isset($administrator))
								{
?>
									<td>
										<a href="/users/edit/<?= array_shift($user_data['id']) ?>">edit</a>
										<a href="/users/delete" class="pull-right">remove</a>
										<div class="clearfix"></div>
									</td>
<?php							}	?>
							</tr>
<?php					}	?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>