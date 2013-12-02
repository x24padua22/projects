<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
	<script type="text/javascript" src="/Ajax/jquery/jquery-2.0.3.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#register").on('submit', function(){
				var form = $(this);
				$.post(form.attr('action'), form.serialize(), function(data){
					if(data.status)
					{
						alert(data.message);
					}
					else
					{
						alert(data.error);
					}
				}, "json");
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<form id="register" action="process.php" method="post">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email"/>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password"/>
			<input type="submit" />
		</form>
	</div>
</body>
</html>