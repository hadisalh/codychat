<?php
require('../config.php');
if(!allowGuest()){
	die();
}
?>
<div id="guest_form_box" class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input id="guest_username" class="user_username full_input" type="text" maxlength="<?php echo $data['max_username']; ?>" name="username" autocomplete="off">
		<?php if(guestForm()){ ?>
		<div class="form_split register_options tpad5">
			<div class="form_left">
				<p class="label"><?php echo $lang['gender']; ?></p>
				<select id="guest_gender">
					<?php echo listGender(1); ?>
				</select>
			</div>
			<div class="form_right">
				<p class="label"><?php echo $lang['age']; ?></p>
				<select size="1" id="guest_age">
					<?php
						echo listAge('', 1);
					?>
				</select>
			</div>
		</div>
		<div class="clear"></div>
		<?php } ?>
		<?php if(!guestForm()){ ?>
			<input id="guest_gender" class="hidden" value="1">
			<input id="guest_age" class="hidden" value="1">
		<?php } ?>
	</div>
	<?php if(boomRecaptcha()){ ?>
	<div class="recapcha_div tmargin5">
		<div id="boom_recaptcha" class="guest_recaptcha">
		</div>
	</div>
	<?php } ?>
	<div class="login_control">
		<button onclick="sendGuestLogin();" type="button" class="theme_btn full_button large_button"><i class="fa fa-sign-in"></i> <?php echo $lang['login']; ?></button>
	</div>
</div>