<?php
	require("connection.php");
	
	$data = array();
	
	if(!empty($_POST["from"]) && !empty($_POST["to"]))
	{
		$from = date("Y-m-d", strtotime($_POST['from']));
		$to = date("Y-m-d", strtotime($_POST['to']));
		$get_leads = "SELECT * FROM leads
					  WHERE registered_datetime BETWEEN '{$from}' AND '{$to}'
					  AND first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%'";
	}
	else
	{
		$get_leads = "SELECT * FROM leads
					  WHERE first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%'";
	}
	
	$leads = fetchAll($get_leads);
	
	$html = "
		<table border='1'>
			<thead>
				<tr>
					<td>ID</td>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Registered at</td>
					<td>Email</td>
				</tr>
			</thead>
			<tbody>";
	
	foreach($leads as $lead)
	{
		$html .="
			<tr>
				<td>{$lead['id']}</td>
				<td>{$lead['first_name']}</td>
				<td>{$lead['last_name']}</td>
				<td>{$lead['registered_datetime']}</td>
				<td>{$lead['email']}</td>
			</tr>
			";
	}
	
	$html .="
			</tbody>
		</table>";
		
	$data["html"] = $html;
	echo json_encode($data);
?>