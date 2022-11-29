<?php
require_once('../config_session.php');
if(!boomAllow(9)){ 
	die(); 
}
?>
<div class="pad_box">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['username']; ?></p>
			<input id="set_create_name" class="full_input" type="text" maxlength="<?php echo $data['max_username']; ?>" />
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['password']; ?></p>
			<input id="set_create_password" class="full_input" type="text" maxlength="30" />
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['email']; ?></p>
			<input id="set_create_email" class="full_input" type="text" maxlength="80" value="<?php echo 'user_'.lastRecordedId().'@user.com'; ?>"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['gender']; ?></p>
			<select id="set_create_gender">
				<?php echo listGender($data['user_sex']); ?>
			</select>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['age']; ?></p>
			<select id="set_create_age">
				<?php echo listAge($data['min_age'], 2); ?>
			</select>
		</div>
	</div>
	<button class="theme_btn reg_button tmargin5" onclick="addNewUser();" id="add_new_user"><i class="fa fa-plus"></i> <?php echo $lang['create']; ?></button>
	<button class="reg_button cancel_modal default_btn"><?php echo $lang['cancel']; ?></button>
</div>