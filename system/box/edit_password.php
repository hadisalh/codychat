<?php
require('../config_session.php');
if(!boomAllow(1)){
	die();
}
?>
<div class="pad15">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['actual_pass']; ?></p>
			<input id="set_actual_pass" class="full_input" maxlength="30" type="password"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['new_pass']; ?></p>
			<input id="set_new_pass" class="full_input"  maxlength="30" type="password"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['repeat_pass']; ?></p>
			<input id="set_repeat_pass" class="full_input" maxlength="30" type="password"/>
		</div>
	</div>
	<button type="button" id="change_password" onclick="changePassword();" class="reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
	<button type="button" class="reg_button default_btn cancel_over"><?php echo $lang['cancel']; ?></button>
</div>