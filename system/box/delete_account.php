<?php
require_once('../config_session.php');

if(!isset($_POST['account'])){
	die();
}
$account = escape($_POST['account']);
$user = userDetails($account);
if(empty($user)){
	echo 0;
	die();
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
	<div class="vpad15">
		<p class="centered_element" ><?php echo $lang['want_delete']; ?></p>
	</div>
	<div class="centered_element tpad10">
		<button onclick="confirmDelete(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><?php echo $lang['yes']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>