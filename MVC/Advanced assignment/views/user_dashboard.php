<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/jquery-ui.css">
	<link rel="stylesheet" href="/assets/css/test.css">
	<script src="/assets/jquery/jquery.js"></script>
	<script src="/assets/jquery/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#dialog_confirm").dialog(function(){
				autoOpen: false,
				modal:true,
				buttons: {
					Yes: function(){
						location: "/users/delete/<?= $user["id"] ?>";
					}
					Cancel: function(){
						$(this).dialog("close");
					}
				}
			});
			$("#delete_user").click(function(){
				$("#dialog_confirm").dialog("open");
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="dialog_confirm">Are you sure you want to delete this user?</div>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a href="/test" class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
<?php		if($is_admin)
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
<?php		if($is_admin)
			{
?>
				<h3 class="col-md-10">Manage Users</h3>
				<a href="/users/create_new" class="btn btn-primary">Add New</a>
				<div class="clearfix"></div>
<?php				
				if(isset($delete_success))
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
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Created At</th>
						<th>User Level</th>
<?php					if($is_admin)
						{
?>
							<th>Actions</th>
<?php					}	?>
					</tr>
				</thead>
				<tbody>
<?php					foreach($users as $user)
						{	
?>						
							<tr>
								<td>
									<?= $user["id"] ?>
								</td>
								<td>
									<a href="/users/show/<?= $user["id"] ?>">
										<?= $user["first_name"] . " " . $user["last_name"] ?>
									</a>
								</td>
								<td>
									<?= $user["email"] ?>
								</td>
								<td>
									<?= $user["created_at"] ?>
								</td>
								<td>
									<?= $user["user_level"] ?>
								</td>
<?php							if($is_admin)
								{
?>
									<td>
										<a href="/users/edit/<?= $user["id"] ?>">edit</a>
										<a href="" id="delete_user" class="pull-right">remove</a>
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