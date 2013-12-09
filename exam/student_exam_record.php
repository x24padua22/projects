<?php
	session_start();
	require_once("connection.php");
	
	$get_student = fetchRecord("SELECT * FROM students
								WHERE id ='".$_SESSION['student_id']."'");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/record.css">
	<title>Students Exam Record</title>
</head>
<body>
	<div id="wrapper">
		<a href="student_record.php">Home</a>
		<h1>Welcome, Teacher!</h1>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="get_record" />
			<label for="students">Select Student:</label>
			<select name="students" id="students" class="form-control">
<?php			$get_students = fetchAll("SELECT id, first_name, last_name FROM students");
				
				if($get_students)
				{
					foreach($get_students as $student)
					{
?>
						<option value="<?= $student['id'] ?>">
							<?= $student['first_name'] . " " . $student['last_name'] ?>
						</option>
<?php				}
				}
				
				if($_SESSION["student_id"] != NULL)
				{
?>
					<option value="<?= $_SESSION['student_id']; ?>" selected="selected">
						<?= $get_student["first_name"] . " " . $get_student["last_name"]; ?>
					</option>
<?php			}	?>
			</select>
			<input type="submit" value="Show Exam Record" class="btn btn-primary" />
		</form>
		<h3>Exam Record for <?= $get_student["first_name"] . " " . $get_student["last_name"]; ?></h3>
		<table class="table table-striped table-bordered">
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
		
<?php		if(isset($_SESSION["student_records"]))
			{
				foreach($_SESSION["student_records"] as $student_record)
				{
?>
				<tr>
					<td><?= $student_record["code"]; ?></td>
					<td><?= $student_record["subject"]; ?></td>
					<td><?= $student_record["grade"]; ?>%</td>
<?php  					if($student_record["grade"] >= 75)
						{
?>
							<td>Passed</td>
<?php					}
						else
						{
?>
							<td>Failed</td>
<?php					}	?>							
					<td><?= $student_record["note"]; ?></td>
				</tr>
<?php			}
			}	?>
			</tbody>
		</table>
		<h3>Add Record</h3>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="add_record" />
			<div class="form-gourp">
				<label for="subject">Subject: </label>
				<select name="subject" id="subject" class="form-control">
<?php				$get_subjects = fetchAll("SELECT id, subject FROM subjects");
					if($get_subjects)
					{
						foreach($get_subjects as $subject)
						{
?>
							<option value="<?= $subject['id'] ?>"><?= $subject['subject']; ?></option>
<?php					}
					}
?>
				</select>
			</div>
			<div class="form-gourp">
				<label for="grade">Grade: </label>
				<select name="grade" id="grade" class="form-control">
<?php				for($counter = 100; $counter >= 1; $counter--)
					{
?>
						<option value="<?= $counter; ?>"><?= $counter; ?></option>
<?php				}	?>
				</select>
			</div>
			<div class="form-group">
				<label for="note">Teacher's Note</label>
				<textarea name="note" id="note" class="form-control"></textarea>
			</div>
			<input type="submit" value="Add Record" class="btn btn-primary" />
		</form>
	</div>
</body>
</html>