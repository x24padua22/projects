<?php include "application/views/header.php"; ?>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<a class="navbar-brand">Test App</a>
			<ul class="nav navbar-nav">
				<li><a href="../test">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../test/signin">Sign In</a></li>
			</ul>
		</div>
		<div id="main_contents">
			<div class="hero-unit well">
				<h1>Welcome to the Test!</h1>
				<p>We're going to build a cool application using MVC framework! This applicaton was built with the Village88 folks!</p>
				<p><a href="../test/signin" class="btn btn-primary btn-lg" role="button">Start</a></p>
			</div>
			<div>
				<div class="col-md-4">
					<h4>Manage Users</h4>
					<p>Using this application, you'll learn how to add, remove, and edit users for the application.</p>
				</div>
				<div class="col-md-4">
					<h4>Leave messages</h4>
					<p>Users will be able to leave a message to another user using this application.</p>
				</div>
				<div class="col-md-4">
					<h4>Edit User Information</h4>
					<p>Admins will be able to edit another user's information (email address, first name, last name, etc.).</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>