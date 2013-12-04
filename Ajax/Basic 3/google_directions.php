<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Google Maps API</title>
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_location").submit(function(){
				var form = $(this);
				$.get(form.attr("action"), form.serialize(), function(data){
					console.log(data);
				},"jsonp");
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<h3>Get directions from the origin to the destination you like.</h3>
		<form id="select_location" action="http://maps.googleapis.com/maps/api/directions/json" method="get">
			<label for="origin">From:</label>
			<input type="text" name="origin" id="origin" />
			<label for="destination">To:</label>
			<input type="text" name="destination" id="destination" />
			<input type="hidden" name="sensor" value="false" />
			<input type="submit" value="Get directions!" />
		</form>
		<div id="directions"></div>
	</div>
</body>
</html>