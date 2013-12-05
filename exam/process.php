<?php
	session_start();
	require_once("connection.php");
	
	function get_record($student_id = NULL)
	{
		if($student_id == NULL)
		{
			$student_id = $_POST["students"];
		}
		$get_record = fetchAll("SELECT exam_results.student_id, exams.code, subjects.subject, grades.grade, status.status, exam_results.note
								   FROM exam_results
								   JOIN exams ON exams.id = exam_results.exam_id
								   JOIN subjects ON subjects.id = exams.subject_id
								   JOIN grades ON grades.id = exam_results.grade_id
								   JOIN status ON status.id = grades.status_id
								   WHERE student_id = '".$student_id."'");
		
		$_SESSION["student_record"] = $get_record;
		$_SESSION["id"] = $get_record[0]["student_id"];
		header("Location: student_exam_record.php");
		exit();
	}
	
	if(isset($_POST["action"]) && $_POST["action"] == "add_record")
	{
		$add_record = "INSERT INTO exam_results (exam_id,student_id,grade_id,note) 
					   VALUES ('".$_POST["subject"]."', '".$_SESSION["id"]."', '".$_POST["grade"]."', '".$_POST["note"]."')";
		$record = mysql_query($add_record);
		
		if($record)
		{
			get_record($_SESSION["id"]);
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
?>