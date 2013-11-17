<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Advanced1</title>
	<style type="text/css">
		table, th, td
		{
			padding: 3px;
			border:1px solid #000;
		}
		tr:nth-child(5n+0)
		{
			color: #fff;
			background-color: #000;
		}
	</style>
</head>
<body>
	<?php
		$users = array( 
		   array('first_name' => 'Michael', 'last_name' => ' Choi '),
		   array('first_name' => 'John', 'last_name' => 'Supsupin'),
		   array('first_name' => 'Mark', 'last_name' => ' Guillen'),
		   array('first_name' => 'KB', 'last_name' => 'Tonel'),
		   array('first_name' => 'Rozen', 'last_name' => 'Macapagal'),
		   array('first_name' => 'Diana', 'last_name' => 'Manlulu'),
		   array('first_name' => 'Jadee', 'last_name' => 'Ganggangan'),
		   array('first_name' => 'Christopher', 'last_name' => 'Padua'),
		   array('first_name' => 'Oliver', 'last_name' => 'Rosales'),
		   array('first_name' => 'Ian', 'last_name' => 'Ejercito'),
		   array('first_name' => 'Noah', 'last_name' => 'Guillen'),
		   array('first_name' => 'Mikey', 'last_name' => 'Buyco'),
		   array('first_name' => 'Randall', 'last_name' => 'Frisk'),
		   array('first_name' => 'John', 'last_name' => 'Doe')
		);
		
		echo "Table using for loop <br />
			<table>
				<thead>
					<tr>
						<th>User #</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Full Name</th>
						<th>Full Name in upper case</th>
						<th>Length of name</th>
					</tr>
				</thead>
				<tbody>";
			
		for($counter = 0; $counter < count($users); $counter++)
		{
			$full_name = ($users[$counter]["first_name"] . " " . trim($users[$counter]["last_name"]));
			echo "<tr>
				<td>" . $user_num = ($counter+1) . "</td>
				<td>" . $users[$counter]["first_name"] . "</td>
				<td>" . $users[$counter]["last_name"] . "</td>
				<td>" . $full_name . "</td>
				<td>" . strtoupper($full_name) . "</td>
				<td>" . strlen($full_name) . "</td>
				</tr>";
		}
		
		echo "<tbody></table>";
		
		echo "<br />Table using foreach <br />
			<table>
				<thead>
					<tr>
						<th>User #</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Full Name</th>
						<th>Full Name in upper case</th>
						<th>Length of name</th>
					</tr>
				</thead>
				<tbody>";
		
		$user_num = 1;
		
		foreach($users as $items)
		{
			$full_name = ($items["first_name"] . " " . trim($items["last_name"]));
			echo "<tr>
				<td>" . $user_num++ . "</td>
				<td>" . $items["first_name"] . "</td>
				<td>" . $items["last_name"] . "</td>
				<td>" . $full_name . "</td>
				<td>" . strtoupper($full_name) . "</td>
				<td>" . strlen($full_name) . "</td>
				</tr>";
		}
		
		echo "<tbody></table>";
	?>
</body>
</html>