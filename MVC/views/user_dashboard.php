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
				<li><a href="../users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../test">Log Off</a></li>
			</ul>
			</div>
		</div>
		<div id="main_contents">
			<h3>All Users</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Created At</th>
					</tr>
				</thead>
				<tbody>
					<tr>
<?php					foreach($user_data as $key => $value)
						{
?>
							<td><?= $value ?></td>
<?php					}	?>					
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>