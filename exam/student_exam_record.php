<?php
	session_start();
	require_once("connection.php");
	
	$get_student = fetchRecord("SELECT * FROM students
								WHERE id ='".$_SESSION['id']."'");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<div id="wrapper">
		<a href="student_record.php">Home</a>
		<h1>Welcome, Teacher!</h1>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="get_record" />
			<label for="students">Select Student:</label>
			<select name="students" id="students">
<?php			$get_students = fetchAll("SELECT id, first_name, last_name FROM students");
				
				if($get_students)
				{
					foreach($get_students as $student)
					{
?>
						<option value="<?= $student['id'] ?>"><?= $student['first_name'] . " " . $student['last_name'] ?></option>
<?php				}
				}
?>
			</select>
			<input type="submit" value="Show Exam Record" />
		</form>
		<h3>Exam Record for <?= $get_student["first_name"] . " " . $get_student["last_name"]; ?></h3>
		<table>
			<thead>
				<tr>
					<th>Exam ID</th>
					<th>Subject</th>
					<th>Grade</th>
					<th>Status</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
		
<?php		if(isset($_SESSION["student_record"]))
			{
				foreach($_SESSION["student_record"] as $key)
				{
?>
				<tr>
					<td><?= $key["code"]; ?></td>
					<td><?= $key["subject"]; ?></td>
					<td><?= $key["grade"]; ?></td>
					<td><?= $key["status"]; ?></td>
					<td><?= $key["note"]; ?></td>
				</tr>
<?php			}
			}	?>
			</tbody>
		</table>
		<h3>Add Record</h3>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="add_record" />
			<label for="subject">Subject: </label>
			<select name="subject" id="subject">
<?php			$get_subjects = fetchAll("SELECT id, subject FROM subjects");
				if($get_subjects)
				{
					foreach($get_subjects as $subject)
					{
?>
						<option value="<?= $subject['id'] ?>"><?= $subject['subject']; ?></option>
<?php				}
				}
?>
			</select>
			<label for="grade">Grade: </label>
			<select name="grade" id="grade">
<?php			$get_grades = fetchAll("SELECT id, grade FROM grades");
				if($get_grades)
				{
					foreach($get_grades as $grade)
					{
?>
						<option value="<?= $grade['id']; ?>"><?= $grade['grade']; ?></option>
<?php				}
				}
?>
			</select>
			<label for="note">Teacher's Note</label>
			<textarea name="note" id="note" cols="20" rows="5"></textarea>
			<input type="submit" value="Add Record" />
		</form>
	</div>
</body>
</html>