<div id="chat_head" class="chat_head">
	<div onclick="toggleLeft();" class="head_option">
		<div class="btable">
			<div class="bcell_mid">
				<i class="fa fa-bars i_btm"></i>
			</div>
		</div>
		<div id="bottom_news_notify" class="head_notify bnotify"></div>
	</div>
	<?php if(!embedMode()){?>
	<div class="chat_head_logo">
		<img id="main_logo" alt="logo" src="<?php echo getLogo(); ?>"/>
	</div>
	<?php } ?>
	<div id="empty_top_mob" class="bcell_mid hpad10">
	</div>
	<div value="0" onclick="getPrivate();" id="get_private" class="privelem head_option">
		<div class="btable">
			<div class="bcell_mid">
				<i class="fa fa-envelope i_btm"></i>
			</div>
		</div>
		<div id="notify_private" class="head_notify bnotify"></div>
	</div>
	<?php if(boomAllow(1)){ ?>
	<div onclick="friendRequest();" class="head_option">
		<div class="btable">
			<div class="bcell_mid">
				<i class="fa fa-user"></i>
			</div>
		</div>
		<div id="notify_friends" class="head_notify bnotify"></div>
	</div>
	<?php } ?>
	<div onclick="getNotification();" class="head_option">
		<div class="btable">
			<div class="bcell_mid">
				<i class="fa fa-bell"></i>
			</div>
		</div>
		<div id="notify_notify" class="head_notify bnotify"></div>
	</div>
	<?php if(canManageReport()){ ?>
	<div onclick="loadReport(1);" class="head_option">
		<i class="fa fa-flag"></i>
		<div id="report_notify" class="head_notify bnotify"></div>
	</div>
	<?php } ?>
	<div class="menutrig" onclick="showMenu('mobile_main_menu');" id="main_mob_menu">
		<img class="avatar_menu glob_av menutrig" src="<?php echo myAvatar($data['user_tumb']); ?>"/>
		<div id="mobile_main_menu" class="sysmenu hideall fmenu">
			<div class="fmenu_item" onclick="editProfile();">
				<div class="fmenu_icon">
					<i class="fa fa-user-circle menuo"></i>
				</div>
				<div class="fmenu_text">
					<?php echo $lang['my_profile']; ?>
				</div>
			</div>
			<?php if(useLobby()){ ?>
			<div id="back_home" class="fmenu_item">
				<div class="fmenu_icon">
					<i class="fa fa-home menuo"></i>
				</div>
				<div class="fmenu_text">
					<?php echo $lang['lobby']; ?>
				</div>
			</div>
			<?php } ?>
			<div id="room_setting_menu" class="room_granted nogranted fmenu_item" onclick="getRoomSetting();">
				<div class="fmenu_icon">
					<i class="fa fa-cog menuo"></i>
				</div>
				<div class="fmenu_text">
					<?php echo $lang['room_side_settings']; ?>
				</div>
			</div>
			<?php if(boomAllow(8)){ ?>
			<div class="fmenu_item" onclick="openLinkPage('admin.php');">
				<div class="fmenu_icon">
					<i class="fa fa-dashboard menuo"></i>
				</div>
				<div class="fmenu_text">
					<?php echo $lang['admin_panel']; ?>
				</div>
			</div>
			<?php } ?>
			<div id="open_logout" class="fmenu_item" onclick="openLogout();">
				<div class="fmenu_icon">
					<i class="fa fa-sign-out menuo"></i>
				</div>
				<div class="fmenu_text">
					<?php echo $lang['logout']; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="global_chat" class="chatheight" >
	<div id="chat_left" class="cleft chat_panel pheight" >
		<div id="chat_left_menu" class="pheight">
			<div class="chat_left_menu_wrap">
				<div class="left_bar_ctn hidden">
					<div id="left_panel_bar" class="panel_bar">
						<div onclick="toggleLeft();" class="panel_bar_item">
							<i class="fa fa-times"></i>
						</div>
						<div class="bcell_mid">
						</div>
					</div>
				</div>
				<div id="status_menu" class="left_list">
					<div id="current_status" onclick="openStatusList();" class="left_item cur_status">
						<?php echo listStatus($data['user_status']); ?>
					</div>
				</div>
				<?php if(useWall() && boomAllow(1)){ ?>
				<div id="wall_menu" class="left_list left_item" onclick="getWall();">
					<div class="left_item_icon">
						<i class="fa fa-rss menui"></i>
					</div>
					<div class="left_item_text">
						<?php echo $lang['wall']; ?>
					</div>
				</div>
				<?php } ?>
				<div id="news_menu" class="left_list left_item" onclick="getNews();">
					<div class="left_item_icon">
						<i class="fa fa-newspaper-o menui"></i>
					</div>
					<div class="left_item_text">
						<?php echo $lang['system_news']; ?>
					</div>
					<div class="left_item_notify">
						<span id="news_notify" class="notif_left bnotify"></span>
					</div>
				</div>
				<div id="end_left_menu">
				</div>
				<div id="more_menu"class="left_list">
					<div id="open_more_menu" class="left_item" onclick="openMoreMenu();">
						<div class="left_item_icon">
							<i class="fa fa-plus menui"></i>
						</div>
						<div class="left_item_text">
							<?php echo $lang['more']; ?>
						</div>
					</div>
					<div id="more_menu_list" class="hidden">
						<div id="chat_help_menu" class="left_drop_item more_left" onclick="showHelp();">
							<div class="left_drop_text">
								<?php echo $lang['help']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container_extra">
				<!-- extra content for left panel do not exceed 250px width -->
			</div>
		</div>
	</div>
	<div id="chat_center" class="background_chat chatheight" style="position:relative;">
		<div  id="container_chat">
			<div id="wrap_chat">
				<div id="warp_show_chat">
					<div id="container_show_chat">
						<div id="inside_wrap_chat">
							<ul class="background_box" id="show_chat" value="1">
								<ul id="chat_logs_container">
								</ul>
							</ul>
						</div>
						<div value="0" id="main_emoticon" class="background_box">
							<div class="emo_head main_emo_head">
								<?php if(canEmo()){ ?>
									<div data="base_emo" class="dark_selected emo_menu emo_menu_item"><img class="emo_select" src="emoticon_icon/base_emo.png"/></div>
									<?php echo emoItem(1); ?>
								<?php } ?>
								<div class="empty_emo">
								</div>
								<div class="emo_menu" onclick="hideEmoticon();">
									<i class="fa fa-times"></i>
								</div>
							</div>
							<div id="main_emo" class="emo_content">
								<?php listSmilies(1); ?>
							</div>
						</div>
						<div id="main_input_extra" class="add_shadow background_box">
							<?php if(canUploadChat()){ ?>
							<div class="sub_options">
								<img src="default_images/icons/upload.svg"/>
								<input id="chat_file" class="up_input" onchange="uploadChat();" type="file"/>
							</div>
							<?php } ?>
							<?php if(canColor()){ ?>
							<div class="sub_options" onclick="getTextOptions();">
								<img src="default_images/icons/pencil.svg"/>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="chat_input_container">
					<div id="top_chat_container">
						<div id="container_input" class="input_wrap">
							<form id="main_input" name="chat_data" action="" method="post">
								<div class="input_table">
									<div id="ok_sub_item" class="input_item main_item base_main sub_hidden" onclick="getChatSub();">
										<i class="fa fa-plus input_icon bblock"></i>
									</div>
									<div value="0" class="input_item main_item base_main" onclick="showEmoticon();" id="emo_item">
										<i class="fa fa-smile-o bblock"></i>
									</div>
									<div id="main_input_box" class="td_input">
										<input type="text" spellcheck="false" name="content" placeholder="<?php echo $lang['type_something']; ?>" maxlength="<?php echo $data['max_main']; ?>" id="content" autocomplete="off"/>
									</div>
									<div id="inputt_right" class="main_item">
										<button type="submit"  class="default_btn csend" id="submit_button"><i class="fa fa-paper-plane"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="chat_right" class="cright chat_panel prheight">
		<div id="chat_right_content" class="prheight">
			<div id="wrap_right_data" class="prheight">
				<div id="right_panel_bar" class="panel_bar">
					<div onclick="closeRight();" class="panel_bar_item">
						<i class="fa fa-times"></i>
					</div>
					<div class="bcell_mid">
					</div>
					<div id="users_option"title="<?php echo $lang['user_list']; ?>" class="panel_selected panel_option" onclick="userReload(1);">
						<i class="fa fa-users"></i>
					</div>
					<?php if(boomAllow(1)){ ?>
					<div id="friends_option" title="<?php echo $lang['friend_list']; ?>" class="panel_option" onclick="myFriends(1);">
						<i class="fa fa-user-plus"></i>
					</div>
					<?php } ?>
					<div id="rooms_option" title="<?php echo $lang['room_list']; ?>" class="panel_option" onclick="getRoomList();">
						<i class="fa fa-home i_btm"></i>
					</div>
				</div>
				<div id="chat_right_data" class="crheight">
				</div>
			</div>
		</div>
	</div>
</div>
<div id="private_box" class="privelem prifoff">
	<div class="top_panel btable top_background" id="private_top">
		<div onclick="" id="private_av_wrap" class="bcell_mid">
			<img id="private_av" src="">
		</div>
		<div onclick="" id="private_name" class="bcell_mid bellips">
			<p class="bellips"></p>
		</div>
		<div id="priv_minimize" onclick="togglePrivate(1);" class="private_opt">
			<i class="fa fa-minus"></i>
		</div>
		<div id="private_min" onclick="showMenu('private_menu');" class="menutrig private_opt">
			<i class="fa fa-cog menutrig"></i>
			<div id="private_menu" class="sysmenu add_shadow fmenu">
				<div class="fmenu_item" onclick="ignoreThisUser();">
					<div class="fmenu_icon menuo">
						<i class="fa fa-ban"></i>
					</div>
					<div class="fmenu_text">
						<?php echo $lang['ignore']; ?>
					</div>
				</div>
				<div class="fmenu_item" onclick="getPrivateSettings();">
					<div class="fmenu_icon menuo">
						<i class="fa fa-cogs"></i>
					</div>
					<div class="fmenu_text">
						<?php echo $lang['settings']; ?>
					</div>
				</div>
				<?php if(!canManageReport() && canReport()){ ?>
				<div class="fmenu_item" onclick="reportPrivateLog();">
					<div class="fmenu_icon menuo">
						<i class="fa fa-flag"></i>
					</div>
					<div class="fmenu_text">
						<?php echo $lang['report']; ?>
					</div>
				</div>
				<?php } ?>
				<?php if(canDeletePrivate()){ ?>
				<div class="fmenu_item" onclick="confirmClearPrivate();">
					<div class="fmenu_icon menuo">
						<i class="fa fa-trash"></i>
					</div>
					<div class="fmenu_text">
						<?php echo $lang['delete']; ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="private_close" class="private_opt">
			<i class="fa fa-times"></i>
		</div>
	</div>
	<div id="private_wrap_content">
		<div id="private_content" class="background_box" value="1">
			<ul>
			</ul>
		</div>
		<div id="priv_input_extra" class="add_shadow background_box">
			<?php if(canUploadPrivate()){ ?>
			<div class="psub_options">
				<img src="default_images/icons/upload.svg"/>
				<input id="private_file" class="up_input" onchange="uploadPrivate();" type="file"/>
			</div>
			<?php } ?>
		</div>
	</div>
	<div id="private_input" class="input_wrap">
		<form id="message_form"  action="" method="post" name="private_form">
			<div class="input_table">
				<div id="ok_priv_item" class="input_item main_item sub_hidden" onclick="getPrivSub();">
					<i class="fa fa-plus input_icon bblock"></i>
				</div>
				<div value="0" id="emo_item_priv" class="input_item main_item" onclick="showPrivEmoticon();">
					<i class="fa fa-smile-o"></i>
				</div>
				<div id="private_input_box" class="td_input">
					<input spellcheck="false" id="message_content" placeholder="<?php echo $lang['type_something']; ?>" maxlength="<?php echo $data['max_private']; ?>" autocomplete="off"/>
				</div>
				<div id="message_send" class="main_item">
					<button class="default_btn csend" id="private_send"><i class="fa fa-paper-plane"></i></button>
				</div>
			</div>
		</form>
		<div id="private_emoticon" class="background_box">
			<div class="emo_head private_emo_head">
				<?php if(canEmo()){ ?>
					<div data="base_emo" class="dark_selected emo_menu emo_menu_item_priv"><img class="emo_select" src="emoticon_icon/base_emo.png"/></div>
					<?php echo emoItem(2); ?>
				<?php } ?>
				<div class="empty_emo">
				</div>
				<div class="emo_menu" id="emo_close_priv" onclick="hidePrivEmoticon();">
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div id="private_emo" class="emo_content_priv">
				<?php listSmilies(2); ?>
			</div>
		</div>
	</div>
</div>
<div id='container_stream' class="background_stream">
	<div id='stream_header'>
		<i id="close_stream" class="fa fa-times"></i>
	</div>
	<div id='wrap_stream'>
		<iframe src='' allowfullscreen scrolling='no' frameborder='0'></iframe>
	</div>
</div>
<div id="wrap_footer" data="1" >
	<div class="chat_footer" id="menu_container">
		<div id="menu_container_inside">
			<?php if(usePlayer()){ ?>
			<div id="player_options" class="player_options sysmenu add_shadow hideall hidden">
				<div class="player_list_container">
					<p class="text_xsmall bold bpad5 rtl_elem"><?php echo $lang['station_list']; ?></p>
					<div id="player_listing">
						<?php echo playerList(); ?>
					</div>
				</div>
				<div class="player_volume">
					<div id="sound_display" class="bcell_mid">
						<i class="fa fa-volume-down show_sound"></i>
					</div>
					<div id="player_volume" class="bcell_mid boom_slider">
						<div id="slider"></div>
					</div>
				</div>
			</div>
			<?php } ?>
			<div id="my_menu">
				<div class="chat_footer_empty bcell_mid">
					<?php if(usePlayer()){ ?>
					<div class="chat_player">
						<div class="player_menu player_elem menutrig" onclick="showMenu('player_options');" >
							<i class="fa fa-sliders menutrig"></i>
						</div>
						<div id="player_actual_status" class="player_elem player_button turn_on_play">
							<i id="current_play_btn" class="fa fa-play-circle"></i>
						</div>
						<div id="current_player" class="player_elem player_current">
							<p class="bellips text_xsmall theme_color"><?php echo $lang['station']; ?></p>
							<p class="bellips" id="current_station"><?php echo $radio['player_title']; ?></p>
						</div>
					</div>
					<?php } ?>
				</div>
				<div id="dpriv" onclick="togglePrivate(2);" class="chat_footer_item privhide">
					<img id="dpriv_av" src=""/>
					<div id="dpriv_notify" class="notification bnotify">
						0
					</div>
				</div>
				<div onclick="toggleRight();" class="chat_footer_item">
					<i class="fa fa-bars i_btm"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="av_menu" class="avmenu add_shadow">
	<div id="avcontent" class="avcontent">
	</div>
</div>
<div id="log_menu" class="add_shadow">
	<div id="logmenu" class="logmenu">
	</div>
</div>
<div id="monitor_data" onclick="getMonitor();">
	<p>Count: <span id="logs_counter">0</span></p>
	<p>Speed: <span id="current_speed">0</span></p>
	<p>Latency: <span id="current_latency">0</span></p>
</div>
<div id="action_menu" class="hidden">
	<?php echo boomTemplate('element/actions'); ?>
</div>
<div id="log_menu_content" class="hidden">
	<?php echo boomTemplate('element/actions_logs'); ?>
</div>
<div id="status_list" class="hidden">
	<?php echo boomTemplate('element/status_list'); ?>
</div>
<?php loadAddonsJs();?>
<script data-cfasync="false" src="js/function_main.js<?php echo $bbfv; ?>"></script>
<script data-cfasync="false" src="js/function_menu.js<?php echo $bbfv; ?>"></script>
<script data-cfasync="false" src="js/function_player.js<?php echo $bbfv; ?>"></script>