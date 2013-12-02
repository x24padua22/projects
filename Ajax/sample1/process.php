<?php
	$data = array('message' => NULL, 'status' => NULL, 'error' => NULL);
	if(isset($_POST) && !empty($_POST))
	{
		$email= $_POST['email'];
		$password= $_POST['password'];
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$data['message'] = "Valid email. ";
			$data['status']= true;
		}
		else
		{
			$data['error'] = "Invalid email. ";
			$data['status'] = false;
		}
		if(strlen($password) > 6)
		{
			$data['message'] .= "\n\nValid password. ";
			$data['status']= true;
		}
		else
		{
			$data['error'] .= "\n\nPassword is too short. ";
			$data['status'] = false;
		}
	}
	else
	{
		$data['error'] .= "No values submitted ";
		$data['status'] = false;
	}
	echo json_encode($data); 
?>