<?php
require('../config_session.php');
if(!isset($_POST['ban'])){
	die();
}
if(!canBan()){
	die();
}
$target = escape($_POST['ban']);
$user = userDetails($target);

if(!canBanUser($user)){
	return 0;
}
?>
<div class="modal_top">
	<div class="modal_top_empty">
		<div class="btable">
			<div class="avatar_top_mod">
				<img src="<?php echo myAvatar($user['user_tumb']); ?>"/>
			</div>
			<div class="avatar_top_name">
				<?php echo $user['user_name']; ?>
			</div>
		</div>
	</div>
	<div class="modal_top_element close_over">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="pad_box">
	<div class="setting_element">
		<p class="label"><?php echo $lang['reason']; ?> <span class="sub_text text_xsmall"><?php echo $lang['optional']; ?></span></p>
		<textarea id="ban_reason" maxlength="300" class="full_textarea small_textarea" type="text"/></textarea>
	</div>
	<div class="tpad10">
		<button onclick="banUser(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><?php echo $lang['ban']; ?></button>
		<button class="close_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>