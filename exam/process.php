<?php
	session_start();
	require_once("connection.php");
	
	function get_record($student_id = NULL)
	{
		if($student_id == NULL)
		{
			$student_id = $_POST["students"];
		}
		
		$get_records = fetchAll("SELECT exams.code, subjects.subject, exam_results.grade, exam_results.note
								 FROM exam_results
								 JOIN exams ON exams.id = exam_results.exam_id
								 JOIN subjects ON subjects.id = exams.subject_id
								 WHERE student_id = '".$student_id."'");
		
		$_SESSION["student_records"] = $get_records;
		$_SESSION["student_id"] = $student_id;
		header("Location: student_exam_record.php");
		exit();
	}
	
	function add_record()
	{
		$add_record = "INSERT INTO exam_results (exam_id, student_id, grade, note) 
					   VALUES ('".$_POST["subject"]."', '".$_SESSION["student_id"]."', '".$_POST["grade"]."', '".$_POST["note"]."')";
		$record = mysql_query($add_record);
		
		if($record)
		{
			get_record($_SESSION["student_id"]);
		}
		else
		{
			$_SESSION["message"] = "Sorry, but the record is not added.";
		}
	}
	
	if(isset($_POST["action"]) && $_POST["action"] == "get_record")
	{
		get_record();
	}
	
	if(isset($_POST["action"]) && $_POST["action"] == "add_record")
	{
		add_record();
	}
?>