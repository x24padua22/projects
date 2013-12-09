<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="/assets/css/time_record.css"/>
	<title>Dashboard</title>
</head>
<body>
	<div id="wrapper">
		<a href="/time_recorder" class="pull-right">Logout</a>
		<div class="clearfix"></div>
		<h3>Clock In/Out History</h3>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
<?php			foreach($users_clock_in_history as $history)
				{
?>
					<tr>
						<td><?= $history->first_name; ?></td>
						<td><?= $history->last_name; ?></td>
						<td><?= $history->time_record_log_in; ?></td>
						<td><?= $history->time_record_log_out; ?></td>
						<td><?= $history->time_record_notes; ?></td>
					</tr>
<?php			}	?>
			</tbody>
		</table>
	</div>
</body>
</html>