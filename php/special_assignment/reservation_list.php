<?php
	session_start();
	require_once("connection.php");
	
	$reservations = fetchAll("SELECT * FROM reservations");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Reservation List</title>
	<link rel="stylesheet" href="css/reservation_list.css" />
</head>
<body>
	<h3>Reservation List</h3>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Check In Date</th>
			<th>Check Out Date</th>
			<th>Number of Rooms</th>
			<th>Requests</th>
			<th>Date Reserved</th>
			<th>Room ID</th>
		</tr>
<?php	
		foreach($reservations as $reservations)
		{
?>			<tr>
				<td><?= $reservations["first_name"] . "  " . $reservations["last_name"] ?></td>
				<td><?= $reservations["email"] ?></td>
				<td><?= $reservations["check_in"] ?></td>
				<td><?= $reservations["check_out"] ?></td>
				<td><?= $reservations["number_of_rooms"] ?></td>
				<td><?= $reservations["requests"] ?></td>
				<td><?= $reservations["created_at"] ?></td>
				<td><?= $reservations["room_id"] ?></td>
			</tr>
<?php }	?>
		
	</table>
</body>
</html>