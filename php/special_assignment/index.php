<?php
	session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Hotel Reservation</title>
	<link rel="stylesheet" href="css/hotel.css" />
</head>
<body>
	<div id="wrapper">
		<form id="admin_login_form" action="reservation_list.php" method="post">
			<input type="hidden" name="action" value="login" />
			<label for="username">Username</label>
			<input type="text" name="username" id="username" />
			<label for="password">Password</label>
			<input type="password" name="password" id="password" />
			<input type="submit" value="login" />
		</form>
		<div id="clear"></div>
		<div>
<?php		if(isset($_SESSION["error"]))
			{
				foreach($_SESSION["error"] as $name => $message)
				{
?>
					<p class="error"><?= $message ?></p>
<?php
				}
			}
			else if(isset($_SESSION["success"]))
			{
?>
				<p><?= $_SESSION["success"] ?></p>
<?php		}	?>		
			<form id="reservation_form" action="reservation.php" method="post">
				<input type="hidden" name="action" value="reserve" />
				<label for="check_in">Check In</label>
				<input type="text" name="check_in" id="check_in" placeholder="Check In (mm/dd/yyyy)" />
				<label for="check_out">Check Out</label>
				<input type="text" name="check_out" id="check_out" placeholder="Check Out (mm/dd/yyyy)" />
				<label for="number_of_rooms">Number of Rooms</label>
				<select name="number_of_rooms" id="number_of_rooms">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<label for="room_type">Room Type</label>
				<select name="room_type" id="room_type">
					<option value="1">Executive</option>
					<option value="2">Deluxe</option>
					<option value="3">Economy</option>
				</select>
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" placeholder="First Name" id="first_name"/>
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" placeholder="Last Name" id="last_name"/>
				<label for="email">Email Name</label>
				<input type="text" name="email" placeholder="Email" id="email"/>
				<label for="requests">Other Requests</label>
				<textarea name="requests" id="requests" placeholder="Food, Transportation, etc."></textarea>
				<input type="submit" value="Reserve" />
			</form>
		</div>
	</div>
</body>
</html>
<?php
	$_SESSION = array();
?>