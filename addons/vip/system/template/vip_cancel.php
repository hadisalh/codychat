<?php
$load_addons = 'vip';
require_once('../../../../system/config_addons.php');

if(!isset($_POST['vip_cancel'])){
	die();
}
$id = escape($_POST['vip_cancel']);
$user = userDetails($id);
if(empty($user)){
	echo 2;
	die();
}
?>
<style>
	.avatar_vip { width:80px; height:80px; border-radius:50%; }
</style>
<div class="hpad15">
	<div class="centered_element">
			<img class="avatar_vip" src="<?php echo myAvatar($user['user_tumb']); ?>"/>
	</div>
	<div class="centered_element">
		<p class="bold text_med <?php echo myColor($user); ?>"><?php echo $user['user_name']; ?></p>
		<p class="bold text_small"><?php echo $lang['end_date']; ?></p>
		<p class="sub_text text_xsmall"><?php echo vipDate($user['vip_end']); ?></p>
	</div>
	<div class="centered_element vpad10">
		<p class="sub_text"><?php echo $lang['vip_confirm']; ?></p>
	</div>
	<div class="centered_element pad15">
		<button class="cancel_modal reg_button default_btn"><i class="fa fa-times"></i> <?php echo $lang['close']; ?></button>
		<button onclick="vipConfirmCancel(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-ban"></i> <?php echo $lang['vip_cancel']; ?></button>
	</div>
</div>