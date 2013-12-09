<?php

class Time_record extends DataMapper
{
	var $has_one = array("user");
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

//eof