<?php 
require('../config_session.php');
if(!isset($_POST['target'])){
	echo 0;
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);

if(!canModifyName($user)){
	echo 0;
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input type="text" id="new_user_username" value="<?php echo $user['user_name']; ?>" class="full_input"/>
	</div>
	<button onclick="adminSaveName(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
	<button class="reg_button default_btn cancel_over"><?php echo $lang['cancel']; ?></button>
</div>