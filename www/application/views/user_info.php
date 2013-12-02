<?php include "application/views/header.php"; ?>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a href="/test" class="navbar-brand">Test App</a>
			</div>
			<ul class="nav navbar-nav">
<?php		if($is_admin)
			{
?>
				<li><a href="/users/dashboard/admin">Dashboard</a></li>
<?php		}	
			else
			{
?>
				<li><a href="/users/dashboard">Dashboard</a></li>
<?php		}	?>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="/users/edit">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/users/logout">Log Off</a></li>
			</ul>
			</div>
		</div>
		<div id="main_contents">
			<h3><?= $user_data["first_name"] . " " . $user_data["last_name"] ?></h3>
			<ul class="list-unstyled">
				<li>Registered at: <?= $user_data["created_at"] ?></li>
				<li>User ID: #<?= $user_data["id"] ?></li>
				<li>Email Address: <?= $user_data["email"] ?></li>
				<li>Desciption: <?= $user_data["description"] ?></li>
			</ul>
<?php		if(isset($message_error))
			{
?>
				<p><?= $message_error; ?></p>
<?php		}	?>
			<div>
				<form action="../post_message/<?= $user_data['id']?>" id="messages_form" method="post">
					<label for="message">Leave a message for <?= $user_data["first_name"] ?></label>
					<textarea name="message" cols="160" rows="5"></textarea>
					<input type="submit" value="Post" class="btn btn-success" />
				</form>
			</div>
<?php		if(!empty($messages_info))
			{
				foreach($messages_info as $message_data)
				{
?>
					<div id="messages">
<?php					$this->load->helper('date');
						$posted_date = new DateTime($message_data["created_at"]);
						$current = new DateTime();
						$interval  = $posted_date->diff($current);
						
						if($interval->y == 0 && $interval->m == 0 && $interval->d == 0)
						{
							if($interval->h != 0)
							{
								$elapsed = $interval->h . " hours ago";
							}
							else
							{
								$elapsed = $interval->i . " minutes ago";
							}
						}
						else
						{
							$elapsed = $message_data["created_at"];
						}
	?>					
						<p>
							<span class="pull-left">
								<a href="/users/show/<?= $message_data['user_id'] ?>">
									<?= $message_data["first_name"] . " " . $message_data["last_name"] ?>
								</a>
							</span>
							<span class="pull-right"><?= $elapsed ?></span>
							<div class="clearfix"></div>
						</p>
						<div class="panel panel-default panel-body">
						<?= $message_data["message"]; ?>
						</div>
					</div>
<?php			}	
			}	?>
		</div>
	</div>
</body>
</html>