<?php
require_once('../config_session.php');
if(!guestCanRegister()){
	echo 0;
	die();
}
?>
<div class="pad_box" id="guest_register">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['username']; ?></p>
			<input type="text" <?php if(validName($data['user_name'])){ echo ' value="' . $data['user_name'] . '" '; } ?> id="new_guest_name" placeholder="<?php echo $lang['username']; ?>" class="full_input"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['password']; ?></p>
			<input type="text" id="new_guest_password" class="full_input"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['email']; ?></p>
			<input type="text" id="new_guest_email" class="full_input"/>
		</div>
	</div>
	<button onclick="registerGuest();" class="reg_button theme_btn"><i class="fa fa-edit"></i> <?php echo $lang['register']; ?></button>
	<button class="reg_button default_btn cancel_over"><?php echo $lang['cancel']; ?></button>
</div>