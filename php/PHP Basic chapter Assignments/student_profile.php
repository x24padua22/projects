<?php
	$user = new User();
	$user->include_related('mentor',array('id', 'user_id', 'community','facebook_group_url'), TRUE, TRUE)
			 ->where('id', $user_profile_id)
			 ->get();
			 
	$user_first_name = $user->first_name;
	$user_last_name = $user->last_name;
	$facebook_user_id	= $user->facebook_user_id;
	$mentor_id = $user->mentor_id;	
	$user_level = $user->user_level;
	$user_email = $user->alternate_email;
	
	$settings_xml = NULL;	
	if($company->settings)
	{
		$settings_xml = new SimpleXMLElement($company->settings);
		$header_footer_color = $settings_xml->themes->header_footer_color;
		$url_background = $settings_xml->themes->url_background_color;
		$url_text_color = $settings_xml->themes->url_text_color;
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<title><?= $user->first_name .' '. $user->last_name ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="shortcut icon" href="<?php echo base_url('/static/favicon/favicon.ico');?>" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/static/css/style.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/buttons.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/dashboard.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/static/css/style.css.php?header_footer_color='.$header_footer_color.'&url_background='.$url_background.'&url_text_color='.$url_text_color);?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/flick/flick.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/flick/tabs.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/profile_page.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/certificate.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/activities.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/tipsy.css?t=<?= time()?>" media="all" />
	<link rel="stylesheet" type="text/css" href="/static/css/quiz_result.css?t=<?= time()?>" media="all" />
	<script type="text/javascript" src="/static/scripts/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/static/scripts/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="/static/js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="/static/js/user_profile.js"></script>
	<script type="text/javascript" src="/static/js/certificate.js"></script>
	<script type="text/javascript" src="/static/js/activity_logs.js"></script>
	<script type="text/javascript" src="/static/js/logo_change.js"></script>
	<script type="text/javascript" src="/static/js/quiz_result.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".set_picture_button").live("click",function(){
				$("#set_picture_form").slideToggle();
				$(this).hide();
			});
			
			$("#set_picture_form").submit(function(){
				var form = $(this);
				$('#profile_pic_block').fadeOut(function(){
					$('#progress_bar_block').fadeIn(function(){
						$('#profile_pic_progress_bar .progress').animate({width:'25%'},(Math.floor(Math.random()*7000)+1000),function(){
							$(this).animate({width:'75%'},(Math.floor(Math.random()*17000)+1000),function(){
								$(this).animate({width:'85%'},(Math.floor(Math.random()*7000)+1000));
							});
						});
					});
				});
				return false;
			});
			
		});
	</script>
	
	<?php	require_once('include/analytics.php');	?>	
</head>
<body>
	<div id="main_wrapper">
		<div id="wrapper">
		<?php
			include('modules/_upgrade_workspace.php');
		?>
			<div id="header">
				<?php	require("include/_user_header.php");	?>
			</div>
			<div id="content" class="standard">
				<div id="left_content" class="content left">
					<div id="user_info_block" class="left">
						<div id="user_profile_block" class="profile_content">
							<div id="profile_image_block">
								<img src="https://graph.facebook.com/<?= $user->facebook_user_id ?>/picture?type=large" alt="<?= $user->facebook_user_id ?>" class="profile_image" />
							</div>
							<h3><?=	$user->first_name .' '. $user->last_name	?></h3>
<?php					if($user_session->user_id != $user->id)
					{	?>
							<p class="user_description"><?=	$user->description ?></p>
<?php					}
						else
						{	?>
							<form action="/users/update_user_description" id="update_user_description">
								<textarea name="description" id="user_description" name="user_description" placeholder="Tell something about yourself"><?= $user->description ?></textarea>
								<div class="clear"></div>
							</form>
<?php					}	?>						
						</div>	
<?php
					if($user_level != ADMIN&& $company->id == LEARNING_WORKSPACE)
					{	?>
						<div id="user_community_block" class="profile_content">
<?php						
							$mentor = $user->get_by_id($user->mentor_user_id);					
?>							
							<div id="mentors_block">
<?php						if($mentor_id != NULL && $user_level != ADMIN)
							{	?>
								<h4>Mentor</h4>
								<a class="current_mentor" href="/users/profile/<?= $mentor->id?>"><img class="mentor_profile mentor_image" title="<?=	$mentor->first_name . ' ' . $mentor->last_name	?>" src="https://graph.facebook.com/<?= $mentor->facebook_user_id ?>/picture" alt="<?= $mentor->facebook_user_id ?>"/></a>
<?php						}	?>
							</div>
							<div class="clear"></div>	

							<div id="members_block">
<?php					
						$members_count = 0; 
						/* if($instructor->result_count() == 1){	$mentor_id = $instructor->id;	} // REMOVE IF NOT GOING TO BE USED */
						
						if($mentor_id != NULL)
						{
							$members = $user->select('id as user_id, first_name, last_name, facebook_user_id')
											->where('mentor_id', $mentor_id)
											->where('company_id', $company->id)
											->order_by('id', 'desc')
											->limit('40')
											->get_iterated();
											
							$members_count = $user->where('mentor_id', $mentor_id)->count();
?>							
								<h4>Group Members (<?= $members_count ?>)</h4>					
<?php							foreach($members as $member)
							{	?>
								<a href="/users/profile/<?= $member->user_id?>"><img class="member_profile" title="<?=	$member->first_name . ' ' . $member->last_name	?>" src="https://graph.facebook.com/<?= $member->facebook_user_id ?>/picture" alt="<?= $member->facebook_user_id ?>"/></a>
<?php							}	
						}
?>
							</div>							
							<div class="clear"> </div>
							
							<div id="get_members_block" class="show_more_block right">
<?php
						if($members_count >= 40 && $mentor_id != NULL)
						{	?>							
								<form action="/users/get_members" id="get_members">
									<input type="hidden" value="<?= $mentor_id ?>" name="mentor_id" />
									<input type="hidden" value="40" name="offset" />
									<input type="submit" disabled="disabled" value="Show More"/>
								</form>
<?php					}	?>
							</div>
<?php
						if($user_session->user_level == ADMIN && $user_session->user_id != $user_profile_id)		
						{	?>
								<div class="clear"></div>
								<div id="edit_mentors_block">
									<form action="/users/assign_mentor" id="update_mentor" method="post">
										<input type="hidden" name="id" value="<?= $user_profile_id ?>" />
										<select name="mentor_id" disabled="disabled" id="assign_mentor" title="Assign a mentor">
<?php
									$mentor = new Mentor();
									$mentors = $mentor->include_related('user',array('id','mentor_id','first_name','last_name','facebook_user_id'), TRUE, TRUE)
														->where_related('user','company_id',$company->id)
														->group_by('user_mentor_id');
?>										
										<option value="">Assign a mentor</option>
<?php
									
										foreach($mentors->get() as $mentor)
										{
											echo '	<option value="'. $mentor->user_mentor_id .'" '. (($mentor->user_mentor_id == $mentor_id && $user->mentor_user_id != NULL) ? 'selected="selected"' : '') .'>'. $mentor->user_first_name .' '. $mentor->user_last_name .'</option>';
										}
									
										if($mentor_id){									
?>											<option value="0">Unassign current mentor</option>
<?php									} ?>
										</select>
									</form>
								</div>		
<?php					}	?>
							<div class="clear"> </div>
						</div>	
<?php
					}
?>					</div>
					
				<div id="user_accomplishments_block" class="left">	
<?php
				$feedbacks = new Feedback();
				$feeds = $feedbacks->where('receiver_user_id', $user_profile_id)
									->include_related('user',array('id','first_name','last_name','facebook_user_id'), TRUE, TRUE)
									->include_related('activity_log',array('id','activity_type_id','params','created_at'), TRUE, TRUE)
									->order_by("id","desc")
									->limit(5)
									->get_iterated();
													
				$feedbacks_count = $feedbacks->where('receiver_user_id', $user_profile_id)->count();	
				
				if(($feedbacks_count > 0 || $user_session->user_level == ADMIN) && $user_level != ADMIN)
				{	?>
					<div id="feedback_block">
						<h3 class="block_title">Feedbacks</h3>
						<ul id="feedback_list" class="show_more_list">
<?php
								
						foreach($feedbacks as $feedback)
						{
							if(! empty($feedback->activity_log_params))
							{
								$xml_params = '<?xml version="1.0"?><params>'. $feedback->activity_log_params .'</params>'; 
								$params = new SimpleXMLElement($xml_params);
							}	
?>
							<li class="feedback_item">
								<img src="https://graph.facebook.com/<?= $facebook_user_id ?>/picture" alt="<?= $facebook_user_id ?>" class="profile_pic left user_image" title="<?= $user_first_name .' '. $user_last_name ?>" />
<?php
									switch($feedback->activity_log_activity_type_id){
										case LOGGED_IN:
											echo '<div class="activity_title left">logged in</div>';
											break;
										case COMPLETED_CHAPTER:
											echo '<div class="activity_title left">'.activity_completed_chapter().'</div>';
											break;
										case COMPLETED_TO_DO:
											echo '<div class="activity_title left">'.activity_completed_to_do($params->to).'</div>';
											break;
										case UPLOADED_FILE_IN_TO_DO:
											$file_name_or_link = ($params->fp) ? '<a href="http://s3.amazonaws.com/General_V88/'. $company_s3_directory_path .'/chapter_'. $params->chid .'/'. $params->fp .'">'. $params->fn .'</a>' : $params->fn;
											$file = ($user_session->user_level == ADMIN)?	activity_uploaded_file($file_name_or_link) : activity_uploaded_file($params->fn);
											echo '<div class="activity_title left">'.$file.'</div>';
											break;
										case POSTED_COMMENT:
											echo '<div class="activity_title left">'.activity_posted_comment($params->cm).'</div>';
											break;
									}	
									if($feedback->activity_log_activity_type_id != LOGGED_IN)
										echo '<div class="course_chapter_name left">'. activity_course_and_chapter($params->co, $params->ch) .'</div>';
?>									
								<div class="date_created right"><?= activity_time($feedback->activity_log_created_at) ?></div>
								<div class="mentor_feedback left">
									<div class="mentor_name_block">
										<img src="https://graph.facebook.com/<?= $feedback->user_facebook_user_id ?>/picture" alt="<?= $feedback->user_facebook_user_id ?>" class="mentor mentor_profile left user_image" title="<?= $feedback->user_first_name .' '.  $feedback->user_last_name ?>" />
										<span class="mentor_name"></span>
									</div>
									<div class="feedback_container left">
										<div class="feedback_content edit_content"><?= $feedback->message ?></div>
										<div class="date_created right"><?= activity_time($feedback->created_at) ?></div>
									</div>
							<?php
									if($user_session->user_level == ADMIN)
									{	?>
									<div class="feedback_setting right">
										<form action="/admin/delete_feedback" class="delete_feedback_content right" method="post">
											<input type="hidden" name="feedback_id" value="<?= $feedback->id ?>"/>
											<input type="submit" disabled="disabled" value="" title="Delete" class="delete_button" />
										</form>
								<?php	if($feedback->user_id == $user_session->user_id)
										{	?>
										<div class="edit_content_button " title="Edit"></div>
								<?php	}	?>
									</div>
									<form action="/admin/update_feedback" class="edit_feedback_content" method="post">
										<textarea name="feedback_content"><?= $feedback->message ?></textarea>
										<input type="hidden" name="feedback_id" value="<?= $feedback->id ?>"/>
										<div class="clear"></div>
										<div class="error_message">
											<p class="feedback_margin left"></p>
											<input type="submit" disabled="disabled" class="button note_button blue_button right" value="Update"/>
										</div>
									</form>
							<?php 	}	?>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</li>
<?php						
						}
								
						if($feedbacks_count > 5)
						{	?>
								
							<div id="get_feedbacks_block" class="show_more_block right">
								<form action="/users/get_feedbacks" id="get_feedbacks">
									<input type="hidden" value="5" name="offset" />
									<input type="hidden" value="<?= $user_profile_id ?>" name="receiver_user_id" />
									<input type="submit" disabled="disabled" value="Show More"/>
								</form>
							</div>
<?php
						}
						else if($feedbacks_count == 0)
						{	?>
							<li class="feedback_item list_empty">
								No feedbacks received yet.
							</li>
<?php					}	?>
						</ul>
						<div class="clear"> </div>
					</div>
<?php			}	?>
					
					<div id="messages_block" class="ui-tabs ui-widget ui-widget-content ui-corner-all ui-sortable">
						<ul class="holder ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<?php
						$notes = new Note();
						$note_types = new Note_type();
						$note_parent_items = $note_types->where("company_id", $company->id)->get_iterated();
						
						foreach($note_parent_items as $note_type)
						{
							$visibility = explode(",", $note_type->visible_to);
							if($note_type->description == MESSAGES)
							{	?>
								<li class="ui-state-default ui-corner-top">
									<a href="#tabs_<?= $note_type->id ?>">
										<div class="static_description">
											<?= $note_type->description ?>
										</div>
									</a>
								</li>
<?php
							}
							else
							{
								switch($visibility[0])
								{
									case EVERYONE:	?>
										<li class="ui-state-default ui-corner-top">
											<a href="#tabs_<?= $note_type->id ?>">
												<div class="static_description">
													<?= $note_type->description ?>
												</div>
											</a>
										</li>
								<?php
										break;
									case STUDENT_INSTRUCTORS:
										if($visibility[1] == $user_session->user_id || $user_session->user_level == ADMIN)
										{	?>
												<li class="ui-state-default ui-corner-top">
													<a href="#tabs_<?= $note_type->id ?>">
														<div class="static_description">
															<?= $note_type->description ?>
														</div>
													</a>
												</li>
								<?php
										}
										break;
									case INSTRUCTORS:
										if($user_session->user_level == ADMIN)
										{	?>
											<li class="ui-state-default ui-corner-top">
												<a href="#tabs_<?= $note_type->id ?>">
													<div class="static_description">
														<?= $note_type->description ?>
													</div>
												</a>
											</li>
								<?php
										}
										break;
									case SINGLE_INSTRUCTOR:
										if($user_session->user_level == ADMIN && $user_session->user_id == $visibility[1])
										{	?>
											<li class="ui-state-default ui-corner-top">
												<a href="#tabs_<?= $note_type->id ?>">
													<div class="static_description">
														<?= $note_type->description ?>
													</div>
												</a>
											</li>
								<?php
										}
										break;
								}
							}
						}
						
						if($user_session->user_level == ADMIN)
						{	?>
							<li class="add_new_module ui-state-hover">
								<a><span class="ui-icon ui-icon-plusthick">Add Message Block</span></a>
								<form action="/admin/add_note_tab" id="add_note_tab">
									<input type="hidden" name="add_new" value="true" />
								</form>
							</li>
<?php					}	?>
						</ul>
<?php
						$sub_notes_items = $notes->where(array("noted_to"=> $user_profile_id))
												->include_related('user',array('id','mentor_id','first_name','last_name','facebook_user_id'), TRUE, TRUE)
												->get_iterated();
						$sub_comments = array();
						
						foreach($sub_notes_items as $key=>$sub_note){
							$sub_comments[$key]["parent_note_id"] = $sub_note->parent_note_id;
							$sub_comments[$key]["content"] = "";
							$sub_comments[$key]["content"] .= '<li class="messages_item">'.
															'	<a href="/users/profile/'. $sub_note->user_id .'">'.
															'		<img class="profile_pic left" src="https://graph.facebook.com/'. $sub_note->user_facebook_user_id .'/picture" alt="'. $sub_note->user_facebook_user_id .'" />'.
															'	</a>'.
															'	<div class="user_full_name left"></div>'.
															'	<div class="note_content left">'.
															'		<div class="message_content left">'. $sub_note->message .'</div>'.
															'		<div class="date_created right">'. activity_time($sub_note->created_at) .'</div>'.
															'		<div class="clear"></div>'.
															'	</div>';
							if($sub_note->user_id == $user_session->user_id OR $user_session->user_level == ADMIN){								
								$sub_comments[$key]["content"] .= '	<div class="sub_comment_setting right">'.
															'		<form action="/users/update_note" class="remove_message_form">'.
															'			<input type="hidden" value="'. $sub_note->id .'" name="id" />'.
															'			<input type="hidden" value="true" name="remove" />'.
															'			<input type="submit" disabled="disabled" value=" " class="remove_handle" title="Delete"/>'.
															'		</form>'.		
															'		<div class="edit_note_content right" title="Edit"></div>'.
															'	</div>';
							}								
								$sub_comments[$key]["content"] .= '	<form action="/users/update_note" class="update_note_content hidden">'.
															'		<textarea name="note_content">'. $sub_note->message .'</textarea>'.
															'		<input type="hidden" value="'. $sub_note->id .'" name="id" />'.
															'		<input type="hidden" value="true" name="update" />'.
															'		<div class="clear"></div>'.
															'		<div class="error_message">'.
															'			<p class="note_margin left"></p>'.
															'			<input type="submit" disabled="disabled" class="button note_button blue_button right" value="Update"/>'.
															'		</div>'.
															'	</form>'.
															' 	<div class="clear"></div>'.
															'</li>';
						}
						
						$parent_note_items = $notes->where(array("noted_to"=> $user_profile_id))
												->include_related('user',array('id','mentor_id','first_name','last_name','facebook_user_id'), TRUE, TRUE)
												->order_by('id','desc')
												->get_iterated();
						
						foreach($note_parent_items as $note_tab)
						{
							$visibility = explode(",", $note_tab->visible_to);
							$note_items = "";
							foreach($parent_note_items as $note)
							{ 
								if($note->parent_note_id == 0 && $note->note_type_id == $note_tab->id)
								{
									$sub_note_item = "";
									foreach($sub_comments as $sub_comment)
									{
										if($sub_comment["parent_note_id"] == $note->id)
										{
											$sub_note_item .= $sub_comment["content"];
										}
									}
									
									$note_items .= 	'<li class="messages_item">'.
													'	<a href="/users/profile/'. $note->user_id .'"><img class="profile_pic left" src="https://graph.facebook.com/'. $note->user_facebook_user_id .'/picture" alt="'. $note->user_facebook_user_id .'" /></a>';
									$note_items .= 	'	<div class="note_content left">'.
													'		<div class="message_content left">'. $note->message .'</div>'.
													'		<div class="date_created right">'. activity_time($note->created_at) .'</div>'.
													'	</div>';
									if($note->user_id == $user_session->user_id)
									{
										$note_items .=	'	<div class="note_setting right">'.
														'		<form action="/users/update_note" class="remove_message_form">'.
														'			<input type="hidden" value="'. $note->id .'" name="id" />'.
														'			<input type="hidden" value="true" name="remove" />'.
														'			<input type="submit" disabled="disabled" value="" class="remove_handle" title="Delete"/>'.
														'		</form>'.					
														'		<div class="edit_note_content right" title="Edit"></div>'.
														'	</div>'.													
														'	<form action="/users/update_note" class="update_note_content hidden">'.
														'		<textarea name="note_content">'. $note->message .'</textarea>'.
														'		<input type="hidden" value="'. $note->id .'" name="id" />'.
														'		<input type="hidden" value="true" name="update" />'.
														'		<div class="clear"></div>'.
														'		<div class="error_message">'.
														'			<p class="note_margin left"></p>'.
														'			<input type="submit" disabled="disabled" class="button note_button blue_button right" value="Update"/>'.
														'		</div>'.
														'	</form>';
									}	
									
									$note_items .= 	' 	<div class="clear"></div>'.
													' 	<ul class="sub_note_list">'.
													' 	'. $sub_note_item  .
													' 	</ul>'.
													'	<form action="/users/update_note" class="add_message_block">'.
													'		<img class="profile_pic left" src="https://graph.facebook.com/'. $user_session->facebook_user_id .'/picture" title="'. $user_session->first_name .' '. $user_session->last_name .'" />'.
													'		<input type="hidden" name="noted_to" value="'.$user_profile_id.'"/>'.
													'		<input type="hidden" name="parent_note_id" value="'.$note->id.'"/>'.
													'		<input type="hidden" name="note_type_id" value="'.$note->note_type_id.'"/>'.
													'		<input type="text" name="message" placeholder="Write a note"/>'.
													'		<input type="submit" disabled="disabled" value="Post" class="button note_button blue_button right"/>'.
													'		<div class="clear"></div>'.
													'	</form>'.
													'</li>';
								}
							}
						
							switch($visibility[0])
							{
								case EVERYONE:	?>
									<div id="tabs_<?= $note_tab->id?>" class="note_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom">
									<?php
										if($user_session->user_level == ADMIN){
											include("include/_note_tab_visibility_settings.php");
										}
										include("include/_post_note_form.php");
									?>							
										<ul class="messages_list show_more_list">
											<?= $note_items ?>
										</ul>
										<div class="clear"> </div>
									</div>
							<?php
									break;
								case STUDENT_INSTRUCTORS:
									if($visibility[1] == $user_profile_id || $user_session->user_level == ADMIN)
									{	?>
										<div id="tabs_<?= $note_tab->id?>" class="note_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom">
										<?php
												if($user_session->user_level == ADMIN){
													include("include/_note_tab_visibility_settings.php");
												}
												if($user_profile_id != $user_session->user_id){
													include("include/_post_note_form.php");
												}
										?>							
											<ul class="messages_list show_more_list">
												<?= $note_items ?>
											</ul>
											<div class="clear"> </div>
										</div>
							<?php
									}
									break;
								case INSTRUCTORS:
									if($user_session->user_level == ADMIN)
									{	?>
										<div id="tabs_<?= $note_tab->id?>" class="note_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom">
										<?php
											if($user_session->user_level == ADMIN){
												include("include/_note_tab_visibility_settings.php");
											}
											if($user_profile_id != $user_session->user_id){
												include("include/_post_note_form.php");
											}
										?>							
											<ul class="messages_list show_more_list">
												<?= $note_items ?>
											</ul>
											<div class="clear"> </div>
										</div>
							<?php
									}
									break;
								case SINGLE_INSTRUCTOR:
									if($user_session->user_level == ADMIN && $user_session->user_id == $visibility[1])
									{	?>
										<div id="tabs_<?= $note_tab->id?>" class="note_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom">
										<?php
											if($user_session->user_level == ADMIN){
												include("include/_note_tab_visibility_settings.php");
											}
											if($user_profile_id != $user_session->user_id){
												include("include/_post_note_form.php");
											}
										?>							
											<ul class="messages_list show_more_list">
												<?= $note_items ?>
											</ul>
											<div class="clear"> </div>
										</div>
							<?php
									}
									break;
							}
							
						}
					?>
				<?php
						if($user_session->user_level == ADMIN)
							include("include/_note_tab_clone.php");
				?>
						</div>
					</div>
				</div>
				
				<!-- RIGHT CONTENT -->
				<div id="right_content_user_profile" class="right">
					<!--CERTIFICATIONS-->
					<div id="certifications_block">
<?php					$certifications = new Certification();
						$certificates = $certifications
										->where('user_id', $user_profile_id)
										->include_related('certificate', array('id','name', 'description', 'course_id', 'alias'), TRUE, TRUE)
										->where_related('certificate', 'company_id', $company->id)
										->order_by('id', 'desc')
										->get_iterated();	
						
						$certificates_count = $certificates->result_count();
?>	  		  
						<h3>Certifications</h3>					
						<ul id="certifications_list">
<?php							
						$issued_certificates = array();
						if($certificates_count > 0)
						{
							foreach($certificates as $item)
							{
								array_push($issued_certificates, $item->certificate_id);
?>
							<li class="certificate_item">
								<div class="certificate_name_item">
									<div class="certificate_title" title="<?= $item->certificate_description ?>">
										<?= $item->certificate_name ?>
									</div>
								</div>
<?php							
								if(($user_session->user_level == ADMIN OR (isset($instructor_to_a_course) && ($instructor_to_a_course))) && $user_profile_id != $user_session->user_id)
								{	?>
								<form action="/admin_instructors/issue_certificate" class="unset_certificate right">
									<input type="hidden" value="<?= $item->id ?>" name="certification_id" />
									<input type="hidden" value="<?= $user_profile_id ?>" name="user_id" />
									<input type="hidden" value="true" name="remove" />
									<input type="submit" disabled="disabled" value=" " class="remove_handle" />
								</form>
<?php							}	?>
								<div class="certificate_date_created right"><?= date('F j, Y', strtotime($item->created_at)) ?></div>
								<div class="clear"></div>
							</li>
<?php						}	
						}
						else
						{	?>
							<li class="certificate_item blank_certificate">
								<div class="certificate_name_item">
									<div class="certificate_title">
										No certificates issued
									</div>
								</div>
								<div class="clear"></div>
							</li>
<?php					}	?>
						</ul>
<?php					
						// if($user_session->user_level == ADMIN && $user_profile_id != $user_session->user_id)
						if(($user_session->user_level == ADMIN OR (isset($instructor_to_a_course) && ($instructor_to_a_course))) && $user_profile_id != $user_session->user_id)
						{	?>
							
						<form action="/admin_instructors/issue_certificate" id="manage_certificates_block">
							<input type="hidden" value="<?= $user_profile_id ?>" name="user_id" />
							<select name="certificate_id" id="certificates_available">
								<option value="0">Issue a certificate</option>
<?php
							$certifications->clear();
							
							$unused_certificates = new Certificate();
							$unissued_certificates = $unused_certificates->where('company_id', $company->id)->get()->all_to_array();
							
							foreach($unissued_certificates as $unissued_certificate)
							{
								if(! in_array($unissued_certificate['id'], $issued_certificates))
									$open_certifications[] =  (object) $unissued_certificate;
							}
							
							foreach($open_certifications as $certificate)
							{	?>
								<option value="<?= $certificate->id ?>"><?= $certificate->name ?></option>
<?php						}	?>
								<option value="null">Manage Certificates</option>
							</select>
						</form>
						<div id="manage_certificates_modal" title="Manage Certificates" class='hidden'>
							<form action="/admin_instructors/add_certificate" id="add_new_certificate">
								<input type="text" id="add_certificate_field" name="name" placeholder="Add new certificate"/>
								<input type="submit" disabled="disabled" class="button blue_button" value="Add"/>
							</form>
							<div id="certificates_list_container">
								<ul id="manage_certificates_list">									
								</ul>
							</div>
						</div>						
<?php					}	?>
					</div>
<?				if($user_session->user_level == ADMIN)
				{	?>
					<div id="course_progress_block">
						<h3 class="course_progress_title">Courses</h3>
<?	 				$course = new Course();
					$courses = $course->include_related('student')
									->where(array('students.user_id' => $user_profile_id, 
													'is_archived !=' => TRUE, 
													'company_id' => $company->id)
									)->order_by('courses.name')
									->get();

					$courses_order = explode(',', $company->course_order);
					$courses_array = array();
					$unordered_courses_array = array();				
					
					foreach($courses->all_to_array() as $course)
					{
						foreach($courses_order as $key => $course_order)
						{
							if($course['id'] == $course_order)
								$courses_array[$key] = (object) $course;
						}
						
						if(! in_array($course['id'], $courses_order))
							$unordered_courses_array[] = (object) $course;
					}

					ksort($courses_array);
					$courses = array_merge($unordered_courses_array, $courses_array);
						
					foreach($courses as $course)
					{	
						$chapter = new Chapter();
						$chapters = $chapter->where('course_id', $course->id)->get();
						$chapters_order = explode(',', $course->chapter_order);
						$chapters_array = array();
						$unordered_chapters_array = array();
						$user_to_do_item = array(
							'total' => 0,
							'completed' => 0,
							'titles' => array(),
							'chapters' => array(),
							'modules' => array()
						);
						$uploaded_files = array(
							'total' => 0,
							'titles' => array()
						);	?>																	
						<div id="course_<?= $course->id ?>" class="course_progress">
							<p class="course_title left" title="<?= $course->name ?>"><?= $course->name ?></p>
							<div class="clear"></div>
							<ul class="chapter_progress_bar">
<?php						foreach($chapters->all_to_array() as $chapter)
							{
								foreach($chapters_order as $key => $chapter_order)
								{
									if($chapter['id'] == $chapter_order)
										$chapters_array[$key] = (object) $chapter;
								}

								if(! in_array($chapter['id'], $chapters_order))
									$unordered_chapters_array[] = (object) $chapter;

								ksort($chapters_array);
								$chapters = array_merge($unordered_chapters_array, $chapters_array);
							}																	

							foreach($chapters as $chapter)
							{
								$user_chapter_summary = new User_chapter_summary();
								$user_chapter_summary->where(array(
													'chapter_id' => $chapter->id, 
													'user_id' => $user_profile_id))
													->get();

								if($user_chapter_summary->result_count() > 0)
									echo '<li class="chapter_complete" title="'. $chapter->name ."\n(Completed on ". date('F j, Y', strtotime($user_chapter_summary->completed_at)) .')"></li>';
								else
									echo '<li class="chapter_incomplete" title="'. $chapter->name .'"></li>';
							}	?>						
							</ul>
<?							foreach($chapters as $chapter)
							{
								$module = new Module();
								$modules = $module->where(array(
												'chapter_id' => $chapter->id, 
												'module_type_id' => TO_DO_MODULE))
												->get();
								$user_to_do_item['chapters'][] = (object) $chapter;

								foreach($modules as $module)
								{
									$to_do_items = $this->db->query("SELECT module_id, t1.id AS module_to_do_item_id, t1.description, t2.id AS user_to_do_item_id, t2.user_id, t2.is_completed, t2.activity_log_id, t2.completed_at
																	FROM module_to_do_items AS t1
																	LEFT JOIN user_to_do_items  AS t2 ON t1.id = t2.module_to_do_item_id
																	AND t2.user_id = ". $user_profile_id ."
																	WHERE t1.module_id = ". $module->id)
															->result_array();
									$user_to_do_item['modules'][] = (object) $module;
												
									// Get all to do items and order it according to the recorded order
									$to_do_items_order = explode(',', $module->to_do_items_order);
									$to_do_items_array = array();
									$unordered_to_do_items_array = array();

									foreach($to_do_items as $to_do_item)
									{
										foreach($to_do_items_order as $key => $to_do_item_order)
										{
											if($to_do_item['module_to_do_item_id'] == $to_do_item_order)
												$to_do_items_array[$key] = (object) $to_do_item;
										}
										
										if(! in_array($to_do_item['module_to_do_item_id'], $to_do_items_order))
											$unordered_to_do_items_array[] = (object) $to_do_item;
									}

									// Sort array by key
									ksort($to_do_items_array);
									$to_do_items = array_merge($unordered_to_do_items_array, $to_do_items_array);

									foreach($to_do_items as $to_do_item)
									{
										$user_to_do_item['total']++;
										$user_to_do_item['titles'][] = $to_do_item;

										if($to_do_item->is_completed == TRUE)
											$user_to_do_item['completed']++;
									}

									$user_file = new User_file();
									$user_files = $user_file->where(array(
															'module_id' => $module->id, 
															'user_id' => $user_profile_id))
															->get();

									foreach($user_files as $user_file)
									{
										$uploaded_files['titles'][] = $user_file;
										$uploaded_files['total']++;
									}
								}
							}	?>
							<div class="to_do_items right">
								<div class="to_do_items_button left" title="To do items">
									<span class="to_do_icon left"></span>
									<p class="left"><?= $user_to_do_item['completed'] ?>/<?= $user_to_do_item['total'] ?></p>
								</div>
								<div class="uploaded_files_button left" title="Uploaded files">
									<span class="file_icon left"></span>
									<p class="left"><?= $uploaded_files['total'] ?></p>
								</div>
							</div>
							<div class="clear"></div>					
							<div class="course_progress_content">
								<ul class="to_do_list">
<?								if($user_to_do_item['total'] == 0)
									echo '<li class="error_message">To-do items for this chapter are currently empty.</li>';
								else
								{
									foreach($user_to_do_item['chapters'] as $chapter)
									{
										foreach($user_to_do_item['modules'] as $module)
										{
											if($module->chapter_id == $chapter->id)
											{
												echo '<li title="'. $chapter->name .' ('. $module->title .')" class="module_title">'. $chapter->name .' ('. $module->title .'):</li>';

												foreach($user_to_do_item['titles'] as $to_do_item)
												{
													if($to_do_item->module_id == $module->id)
													{
														if($to_do_item->is_completed == TRUE)
															echo '<li title="'. $to_do_item->description .' (Completed on '. date('F j, Y', strtotime($to_do_item->completed_at)).')"><span class="checked left"></span>'. $to_do_item->description .'<li>';
														elseif($to_do_item->is_completed == FALSE)
															echo '<li title="'. $to_do_item->description .'"><span class="left"></span>'. $to_do_item->description .'</li>';
													}
												}
											}
										}
									}
								}	?>
									<li class="close right"><a href="#course_<?= $course->id ?>">Close window</a></li>
									<div class="clear"></div>						
								</ul>
								<ul class="uploaded_files">
<?									if($uploaded_files['total'] == 0)
										echo '<li class="error_message">There are no uploaded files for this course.</li>';
									else
									{
										echo '<li><h3>Uploaded files:</h3></li>';
										
										foreach($user_to_do_item['chapters'] as $chapter)
										{
											foreach($user_to_do_item['modules'] as $module)
											{
												if($module->chapter_id == $chapter->id)
												{
													foreach($uploaded_files['titles'] as $uploaded_file)
													{
														if($uploaded_file->module_id == $module->id)
															echo '<li><a onclick="return confirm(\'Are you sure you want to download this file?\');" href="http://s3.amazonaws.com/'. S3_BUCKET_NAME .'/'. COMPANY_S3_DIRECTORY_PATH .'_'. $company->id .'/chapter_'. $chapter->id .'/to-dos/module'. $module->id .'_'. $uploaded_file->id .'_test.txt">'. str_replace(S3_TO_DO_FILE_PATH.'/module'.$uploaded_file->module_id.'_'.$uploaded_file->id.'_', '', $uploaded_file->file_path) .'</a></li>';
													}
												}
											}
										}
									}	?>
									<li class="close right"><a href="#course_<?= $course->id ?>">Close window</a></li>
									<div class="clear"></div>	
								</ul>
							</div>
						</div>
<?php				}	?>
					</div>
<?				}	?>			
<?php			if($user_level != ADMIN)
				{	?>
					<div id="activities_courses_block">
						<h3 class="left">Activities</h3>
						<div class="user_activities_filter right">
							<div class="user_activities_reload_button" title="Reload activity log"></div>
							<div class="user_activities_filter_button" title="Click to show/hide">
								<span>Filter</span>
							</div>

							<div class="user_activities_filter_block">
								<div class="filter_error_message"></div>
								<div id="tabs_filter_container" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
									<ul id="nav" class="nav_filter ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
										<li class="tabs_filter"><a href="#activity_tab">Activity</a></li>
										<li class="tabs_filter"><a href="#course_tab">Course</a></li>
									</ul>
									<div class="clear"></div>	
								
									<div id="activity_tab" class="tabs_filter_list">
										<form action="" method="post" class="user_profile_id_form">
											<input type="hidden" name="user_id" value="<?= $user_profile_id?>" />
										</form>	
										<form action="" method="post" class="filter_form filter_activities">
											<div class="tabs_filter_content">
												<ul>
										<?php	if($user_session->user_level == ADMIN)
												{	?>
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= LOGGED_IN ?>" /> <p>Logged In</p></label></li>
										<?php	} 	?>
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= COMPLETED_CHAPTER ?>" /> <p>Chapter Completion</p></label></li>										
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= COMPLETED_TO_DO ?>" /> <p>Task Completion</p></label></li>										
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= UPLOADED_FILE_IN_TO_DO ?>" /> <p>Assignment Submission</p></label></li>									
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= COMPLETED_QUIZ ?>" /> <p>Quiz Completion</p></label></li>
													<li><label><input type="checkbox" class="activity_filter_checkbox" name="activity_type[]" value="<?= POSTED_COMMENT ?>" /> <p>Comment Posts</p></label></li>
												</ul>
											</div>
										<form>	
									</div>
											
									<div id="course_tab" class="tabs_filter_list">
										<form action="" method="post" class="filter_form">							
											<div class="tabs_filter_content">
												<ul>
									<?php		$course = new Course;
												$courses = $course->where('company_id',$company->id)->get();
						
												foreach($courses as $course)
												{	?>
													<li><label><input type="checkbox" class="course_filter_activity_filter_checkbox" name="course_list[]" value="<?= $course->id ?>" /><p><?= $course->name ?></p>	<div class="clear"></div></label></li>
									<?php 		}	?>
												</ul>	
											</div>
										</form>
									</div>
								<form action="/students/filter_user_activities" method="post" id="filter_user_activities_form">
									<input type="submit" value=" Update " />
									<div class="clear"></div>
								</form>	
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<div id="activities_tab">
							<div id="user_activities_block">
							</div>
						</div>
					</div>
<?php			}	?>
				</div>
				<div class="clear"></div>
			</div>
			</div>
			<?php	require('include/_footer.php');	?>
		</div>
		<!-- For Displaying Quiz Results -->
		<div id="quiz_result_dialog"></div>
	</div>
</body>
</html>