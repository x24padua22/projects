<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>CodingDojo Weather report!</title>
	<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_location").submit(function(){
				var form = $(this);
				$.get(form.attr("action")+"?callback=?", form.serialize(), function(data){
					var city = $("#city option:selected").text();
					$("#forecast").append("<h4>Weather for: " + city + "</h4>")
					$("#forecast").append("<p>Current temp C: " + data.data.current_condition[0].temp_C + " degrees</p>");
					$("#forecast").append("<p>Current temp F: " + data.data.current_condition[0].temp_F + " degrees</p>");
					$("#forecast").append("<p>Current Windspeed: " + data.data.current_condition[0].windspeedKmph + " kmph</p>");
					$("#forecast").append("<p>Weather Desciption: " + data.data.current_condition[0].weatherDesc[0].value + "</p>");
				},"json");
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<h3>The CodingDojo weather report!</h3>
		<form id="select_location" action="http://api.worldweatheronline.com/free/v1/weather.ashx" method="get">
			<select name="q">
				<option value="94303">Mountain View</option>
				<option value="98005">Seattle</option>
				<option value="77005">Houston</option>
			</select>
			<input type="hidden" name="key" value="jtpc4myth9fwxjgwz9fh5fw5" />
			<input type="hidden" name="format" value="json" />
			<input type="submit" value="Get weather!" />
		</form>
		<div id="forecast"></div>
	</div>
</body>
</html>