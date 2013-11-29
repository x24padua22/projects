<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/jquery-ui.css">
	<link rel="stylesheet" href="/assets/css/test.css">
	<script src="/assets/jquery/jquery-2.0.3.js"></script>
	<script src="/assets/jquery/jquery-ui.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="dialog_delete">
			<p>Are you sure you want to delete this user?</p>
		</div>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a href="/test" class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
<?php		if($administrator)
			{
?>
				<li><a href="/users/dashboard/admin">Dashboard</a></li>
<?php		}
			else
			{
?>
				<li><a href="/users/dashboard">Dashboard</a></li>
<?php		}	?>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="/users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/users/logout">Log Off</a></li>
			</ul>
		</div>
		<div id="main_contents">
<?php		if($administrator)
			{
?>
				<h3 class="col-md-10">Manage Users</h3>
				<a href="/users/create_new" class="btn btn-primary">Add New</a>
				<div class="clearfix"></div>
<?php				
				if(!empty($delete_success))
				{
					echo $delete_success;
				}
			}
			else
			{
?>
				<h3>All Users</h3>
<?php		}	?>

			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Created At</th>
						<th>User Level</th>
<?php					if($administrator)
						{
?>
							<th>Actions</th>
<?php					}	?>
					</tr>
				</thead>
				<tbody>
<?php					for($i = 0; $i < $row_counter; $i++)
						{
							$id[] = array_shift($user_data['id']);
							$created_at = array_shift($user_data["created_at"])
?>						
							<tr>
								<td>
									<a href="/users/show/<?= $id[$i] ?>">
										<?= array_shift($user_data["name"]) ?>
									</a>
								</td>
								<td>
									<?= array_shift($user_data["email"]) ?>
								</td>
								<td>
									<?= $created_at ?>
								</td>
								<td>
									<?= array_shift($user_data["user_level"]) ?>
								</td>
<?php							if($administrator)
								{
?>
									<td>
										<form action=""></form>
										<a href="/users/edit/<?= $id[$i] ?>">edit</a>
										<a href="/users/dashboard/<?= $id[$id] ?>" id="remove_user" class="pull-right">remove</a>
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