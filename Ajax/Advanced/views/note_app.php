<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Notes</title>
	<link rel="stylesheet" href="/assets/css/notes.css">
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			get_notes();
			$(this).on("click", ".note", function(){
				var note_id = $(this).attr("id");
				var note = $(this).html();
				$(this).replaceWith("<form id='update_note' action='/notes/edit' method='post' >" +
										"<textarea class='edit_note' name='desctiption'>" + note + "</textarea>" +
										"<input type='hidden' name='id' value='" + note_id + "' />" +
										"<input type='submit' value='Save changes' />" +
										"<input type='button' class='cancel' value='Cancel' />" +
									"</form>");
			});
			
			$(this).on("submit", "#update_note", function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					$("#message").text(data.message);
					get_notes();
				});
				
				return false;
			});
			
			$(this).on("click", ".cancel", function(){
				get_notes();
			});
			
			$(this).on("click", ".delete", function(){
				var note_id = $(this).attr("id");
				$.getJSON("/notes/delete/"+note_id, function(data){
					$("#message").text(data.message);
					get_notes();
				});
				
				return false;
			});
			
			$("#post_note").submit(function(){
				var form = $(this);
				$.post(form.attr("action"), form.serialize(), function(data){
					if(data.status)
					{
						$("label").before(data.message);
						get_notes();
					}
					else
					{
						$("label").before(data.error);
					}
				}, "json");
				
				return false;
			});
			
			function get_notes(){
				$.getJSON("/notes/get_notes", function(data){
					if(data.status)
					{
						$("#notes").html(data.notes);
					}
					else
					{
						$("#message").text(data.error);
					}
				}, "json");
				
				return false;
			}
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="left_panel">
			<h4>Add a note:</h4>
			<form id="post_note" action="/notes/post_note" method="post">
				<label for="title">Title:</label>
				<input type="text" name="title" id="title" />
				<textarea name="description" id="note" cols="28" rows="5"></textarea>
				<input type="submit" value="Post It!"/>
			</form>
		</div>
		<div id="main_contents">
			<p id="message"></p>
			<h3>Notes:</h3>
			<div id="notes"></div>
		</div>
	</div>
</body>
</html>