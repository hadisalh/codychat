<?php
require_once('../config_session.php');
if(!isset($_POST['target']) || !boomAllow(8)){
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);
if(!canModifyAbout($user)){
	echo 0;
	die();
}
?>
<div class="pad_box">
	<div class="setting_element">
		<p class="label"><?php echo $lang['about_me']; ?></p>
		<textarea id="admin_user_about" class="large_textarea about_area full_textarea" spellcheck="false" maxlength="800" ><?php echo $user['user_about']; ?></textarea>
	</div>
	<div class="tpad5">
		<button onclick="adminSaveAbout(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>