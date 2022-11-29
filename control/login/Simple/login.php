<div class="back_dark out_page_container">
	<div class="out_page_content">
		<div class="out_page_box">
			<div class="out_page_data pad_box">
				<div class="embed_logo_wrap">
					<img class="embed_logo" src="<?php echo getLogo(); ?>"/>
				</div>
				<p class="bpad10"><?php echo $lang['left_welcome']; ?></p>
				<?php if(bridgeMode(0)){ ?>
				<button class="ok_btn large_button_rounded" onclick="getLogin();"><i class="fa fa-send"></i> <?php echo $lang['login']; ?></button>
				<?php } ?>
				<?php if(bridgeMode(1)){ ?>
				<button class="ok_btn large_button_rounded" onclick="bridgeLogin('<?php echo getChatPath(); ?>');"><i class="fa fa-user"></i> <?php echo $lang['enter_now']; ?></button>
				<?php } ?>
				<?php if(allowGuest()){ ?>
				<div class="clear"></div>
				<button class="theme_btn large_button_rounded" onclick="getGuestLogin();"><?php echo $lang['guest_login']; ?></button>
				<?php } ?>
				<?php if(boomUseSocial() && !embedMode()){ ?>
				<div class="intro_social_container">
					<div class="intro_social_content">
						<?php if(boomSocial('facebook_login')){ ?>
						<img onclick="window.location.href='login/facebook_login.php'" class="intro_social_btn bclick" src="default_images/social/facebook.svg"/>
						<?php } ?>
						<?php if(boomSocial('google_login')){ ?>
						<img onclick="window.location.href='login/google_login.php'" class="intro_social_btn bclick" src="default_images/social/google.svg"/>
						<?php } ?>
						<?php if(boomSocial('twitter_login')){ ?>
						<img onclick="window.location.href='login/twitter_login.php'" class="intro_social_btn bclick" src="default_images/social/twitter.svg"/>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				<?php if(registration()){ ?>
				<div id="not_yet_member" class="login_not_member bclick">
					<p onclick="getRegistration();" class="inblock login_register_text pad10"><?php echo $lang['not_member']; ?></p>
				</div>
				<?php } ?>
				<div id="last_embed">
					<?php echo embedActive(5); ?>
				</div>
				<div class="embed_lang bclick" onclick="getLanguage();">
					<img class="intro_lang" src="system/language/<?php echo $cur_lang; ?>/flag.png"/>
					<p><?php echo $lang['language']; ?></p>
				</div>			
			</div>
		</div>
		<?php if(bridgeMode(1)){ ?>
		<div onclick="getLogin();" class="adm_login bclick">
			<i class="fa fa-cog"></i> <?php echo $lang['login']; ?>
		</div>
		<?php } ?>
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