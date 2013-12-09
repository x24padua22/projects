<?php

class User extends DataMapper
{
	var $has_many = array("time_record");
	var $salt = "rozen";
	public $validation = array(
		"email" => array(
			"label" => "Email",
			"rules" => array("required", "unique")
		),
		"first_name" => array(
			"label" => "First Name",
			"rules" => array("required", "min_length" => 2)
		),
		"last_name" => array(
			"label" => "Last Name",
			"rules" => array("required", "min_length" => 2)
		),
		"password" => array(
			"label" => "Password",
			"rules" => array("required", "min_length" => 6, "encrypt")
		),
		"confirm_password" => array(
			"label" => "Confirm Password",
			"rules" => array("encrypt", "matches" => "password")
		)
	);
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	function login()
    {
		$user = new User();
		$user->where("email", $this->email)->get();
		$this->salt = $user->salt;
		$this->validate()->get();
		
		if (empty($this->id))
		{
			$this->error_message('login', 'Username or password invalid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	function _encrypt($field)
    {
        if (!empty($this->{$field}))
        {
            if (empty($this->salt))
            {
                $this->salt = md5(uniqid(rand(), true));
            }

            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }
	
}

//eof