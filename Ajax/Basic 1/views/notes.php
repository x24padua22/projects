<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Notes</title>
	<link rel="stylesheet" href="/assets/css/post_it.css">
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#post_it").submit(function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					if(data.status)
					{
						$("label").before(data.message);
						$("#default").before(data.new_note);
					}
					else
					{
						$("label").before(data.error);
					}
				}, "json");
				
				return false;
			});
			var form = $(this);
			$.getJSON("/post/notes", function(data){
				if(data.status)
				{
					$("h3").after(data.notes);
				}
				else
				{
					alert(data.error);
				}
			}, "json");
			return false;
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<div>
			<h3>My Posts:</h3>
			<div id="default" class="note">New post goes here...</div>
		</div>
		<form id="post_it" action="/post/post_note" method="post">
			<label for="note">Add a note:</label>
			<textarea name="description" id="note" cols="20" rows="5"></textarea>
			<input type="submit" value="Post It!"/>
		</form>
	</div>
</body>
</html>