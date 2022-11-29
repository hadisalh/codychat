<div id="login_wrap" class="back_login">
	<div id="header2" class="background_header">
		<div id="wrap_main_header">
			<div id="main_header" class="out_head headers">
				<div class="head_logo">
					<img id="main_logo" alt="logo" src="<?php echo getLogo(); ?>"/>
				</div>
				<div class="bcell_mid login_main_menu">
				</div>
				<div onclick="getLanguage();" class="bclick bcell_mid_center" id="open_login_menu">
					<img alt="flag" class="intro_lang" src="<?php echo $data['domain']; ?>/system/language/<?php echo $cur_lang; ?>/flag.png"/>
				</div>
			</div>
		</div>
	</div>
	<div class="empty_subhead">
	</div>
	<div id="intro_top" class="btable">
		<div class="bcell_mid">
			<div id="login_all" class="pad30">
				<div class="login_text bpad15 centered_element">
					<p class="login_title_text bold text_jumbo bpad5"><?php echo $lang['left_title']; ?></p>
					<p class="login_sub_text bold text_med"><?php echo $lang['left_welcome']; ?></p>
				</div>
				<div class="centered_element login_box">
					<?php if(bridgeMode(0)){ ?>
					<button onclick="getLogin();" class="intro_login_btn large_button_rounded  ok_btn"><i class="fa fa-send"></i> <?php echo $lang['login']; ?></button>
					<?php } ?>
					<?php if(bridgeMode(1)){ ?>
					<button class="intro_login_btn large_button_rounded ok_btn" onclick="bridgeLogin('<?php echo getChatPath(); ?>');"><i class="fa fa-user"></i> <?php echo $lang['enter_now']; ?></button>
					<?php } ?>
					<?php if(allowGuest()){ ?>
					<div class="clear"></div>
					<button onclick="getGuestLogin();" class="intro_guest_btn large_button_rounded default_btn"><?php echo $lang['guest_login']; ?></button>
					<?php } ?>
				</div>
				<?php if(boomUseSocial() && !embedMode()){ ?>
				<div class="intro_social_container">
					<div class="intro_social_content">
						<?php if(boomSocial('facebook_login')){ ?>
						<img onclick="window.location.href='login/facebook_login.php'" class="intro_social_btn bclick" src="<?php echo $data['domain']; ?>/default_images/social/facebook.svg"/>
						<?php } ?>
						<?php if(boomSocial('google_login')){ ?>
						<img onclick="window.location.href='login/google_login.php'" class="intro_social_btn bclick" src="<?php echo $data['domain']; ?>/default_images/social/google.svg"/>
						<?php } ?>
						<?php if(boomSocial('twitter_login')){ ?>
						<img onclick="window.location.href='login/twitter_login.php'" class="intro_social_btn bclick" src="<?php echo $data['domain']; ?>/default_images/social/twitter.svg"/>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				<?php if(registration()){ ?>
				<div id="not_yet_member" class="login_not_member bclick">
					<p onclick="getRegistration();" class="inblock login_register_text pad10"><?php echo $lang['not_member']; ?></p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="section back_xlite" id="intro_section_user">
		<div class="section_content">
			<div class="section_inside">
				<div id="last_active">
				  <div class="left-arrow"></div>
				  <div class="right-arrow"></div>

				  <div class="last-clip">
					<div class="last_10">
						<?php echo introActive(8); ?>
					</div>
				  </div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="section" id="intro_section_bottom">
	</div>
	<div class="section intro_footer" id="main_footer">
		<div class="section_content">
			<div class="section_inside">
				<?php boomFooterMenu(); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php if(boomCookieLaw()){ ?>
<div class="cookie_wrap">
	<div class="cookie_text">
		<p><?php echo str_replace('%data%', '<span onclick="openSamePage(\'privacy.php\');" class="bclick link_like">' . $lang['privacy'] . '</span>', $lang['cookie_law']); ?></p>
	</div>
	<div class="cookie_button">
		<button onclick="hideCookieBar();" class="ok_btn reg_button"><?php echo $lang['ok']; ?></button>
	</div>
</div>
<?php } ?>
<script data-cfasync="false" src="js/function_login.js<?php echo $bbfv; ?>"></script>
<script data-cfasync="false" src="js/function_active.js<?php echo $bbfv; ?>"></script>