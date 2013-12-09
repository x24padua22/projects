<?php
	session_start();
	require_once("connection.php");
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
			<select name="students" id="students"class="form-control">
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
?>
			</select>
			<input type="submit" value="Show Exam Record" class="btn btn-primary" />
		</form>
	</div>
</body>
</html>