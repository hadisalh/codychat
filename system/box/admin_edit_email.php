<?php
require_once('../config_session.php');
if(!isset($_POST['target']) || !boomAllow(9)){
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);
if(!canModifyEmail($user)){
	echo 99;
	die();
}
?>
<div class="pad_box">
	<div class="setting_element ">
		<p class="label"><?php echo $lang['email']; ?></p>
		<input id="set_user_email" value="<?php echo $user['user_email']; ?>" class="full_input"/>
	</div>
	<div class="tpad5">
		<button onclick="adminSaveEmail(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>