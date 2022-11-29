<?php 
require('../config_session.php');
if(!isset($_POST['target'])){
	echo 0;
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);

if(!canModifyMood($user)){
	echo 0;
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['mood']; ?></p>
		<input type="text" id="new_user_mood" value="<?php echo $user['user_mood']; ?>" class="full_input"/>
	</div>
	<button onclick="adminSaveMood(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
	<button class="reg_button default_btn cancel_over"><?php echo $lang['cancel']; ?></button>
</div>