<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/assets/css/friends.css">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			get_friends();
			
			function get_friends(){
				$.getJSON("/friends/get_friends", function(data){
					if(data.status)
					{
						$("#friends").append(data.friends);
					}
					else
					{
						$("#message").text(data.error);
					}
				}, "json");
				
				return false;
			}
			
			$("#view_friends").submit(function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					if(data.status)
					{
						$("#friend_info").html(data.friend_info);
						$("#friends_of_friend").html(data.friends_of_friend);
					}
					else
					{
						$("#friends_of_friend").html(data.errors);
					}
				}, "json");
				
				return false;
			});
		});
	</script>
	<title>View Friends Page</title>
</head>
<body>
	<div id="wrapper">
		<div class="forms">
			<h3>Select User:</h3>
			<p id="message"></p>
			<form id="view_friends" action="/friends/process_friend_info" method="post">
				<label for="friends">List of Friends</label>
				<select name="user_id" id="friends">
				</select>
				<input type="submit" value="View Friends" class="btn btn-primary" />
			</form>
			<div id="friend_info"></div>
			<div id="friends_of_friend"></div>
		</div>
	</div>
</body>
</html>