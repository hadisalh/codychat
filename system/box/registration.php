<?php 
require('../config.php'); 
?>
<div id="registration_form_box" class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input spellcheck="false" id="reg_username" class="full_input" type="text" maxlength="<?php echo $data['max_username']; ?>" autocomplete="off">
		<input type="text" style="display:none">
		<input type="password" style="display:none">
		<p class="label tpad5"><?php echo $lang['password']; ?></p>
		<input spellcheck="false" id="reg_password" class="full_input" maxlength="30" type="password" autocomplete="off">
		<p class="label tpad5"><?php echo $lang['email']; ?></p>
		<input spellcheck="false" id="reg_email" class="full_input" maxlength="80" type="text" autocomplete="off">
		<div class="form_split register_options tpad5">
			<div class="form_left">
				<p class="label"><?php echo $lang['gender']; ?></p>
				<select id="login_select_gender">
					<?php echo listGender(1); ?>
				</select>
			</div>
			<div class="form_right">
				<p class="label"><?php echo $lang['age']; ?></p>
				<select size="1" id="login_select_age">
					<?php
						echo listAge('', 1);
					?>
				</select>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<?php if(boomRecaptcha()){ ?>
	<div class="recapcha_div tmargin10">
		<div id="boom_recaptcha" class="register_recaptcha">
		</div>
	</div>
	<?php } ?>
	<div class="login_control">
		<button onclick="sendRegistration();" type="button" class="theme_btn full_button large_button" id="register_button"><i class="fa fa-edit"></i> <?php echo $lang['register']; ?></button>
	</div>
	<div class="rules_text_elem tpad10">
		<p class="rules_text text_xsmall sub_text"><?php echo $lang['i_agree']; ?> <span class="rules_click" onclick="showRules();"><?php echo $lang['rules']; ?></span></p>
	</div>
</div>