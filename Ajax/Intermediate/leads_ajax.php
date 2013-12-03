<?php
	require("connection.php");
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".date").datepicker();
			$("#name").keyup(function(){
				$("#select_form").submit();
			});
			$("#select_form").submit(function(){
				$.post($(this).attr("action"), $(this).serialize(), function(data){
					$("#results").html(data.html);
				},"json");
				return false;
			});
			$("#select_form").submit();
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<form id="select_form" action="get_leads.php" method="post">
			<label for="name">Name: </label>
			<input type="text" name="name" id="name" />
			<label for="from">From: </label>
			<input type="text" name="from" id="from" class="date" />
			<label for="to">To: </label>
			<input type="text" name="to" id="to" class="date" />
			<input type="submit" />
		</form>
		<div id="pagination"></div>
		<div id="results"></div>
	</div>
</body>
</html>