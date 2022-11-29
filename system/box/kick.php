<?php
require('../config_session.php');
if(!isset($_POST['kick'])){
	die();
}
if(!canKick()){
	die();
}
$target = escape($_POST['kick']);
$user = userDetails($target);

if(!canKickUser($user)){
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
		<p class="label"><?php echo $lang['duration']; ?></p>
		<select id="kick_delay">
			<?php echo optionMinutes($cody['default_kick'], array(2,5,10,15,30,60,1440,2880,4320,5760,7200,8640,10080,20160,43200)); ?>
		</select>
	</div>
	<div class="setting_element">
		<p class="label"><?php echo $lang['reason']; ?> <span class="sub_text text_xsmall"><?php echo $lang['optional']; ?></span></p>
		<textarea id="kick_reason" maxlength="300" class="full_textarea small_textarea" type="text"/></textarea>
	</div>
	<div class="tpad10">
		<button onclick="kickUser(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><?php echo $lang['kick']; ?></button>
		<button class="close_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>