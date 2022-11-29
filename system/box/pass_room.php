<?php
require_once('../config_session.php');

if(!isset($_POST['room_rank'], $_POST['room_id'])){
	die();
}
$ar = escape($_POST['room_rank']);
$rid = escape($_POST['room_id']);
if(!is_numeric($ar) || !is_numeric($rid)){
	die();
}
?>
<div class="pad15">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['password']; ?></p>
			<input id="pass_input" class="full_input" type="password"/>
		</div>
	</div>
	<button onclick="accessRoom(<?php echo $rid; ?>, <?php echo $ar; ?>);" id="access_room" class="reg_button theme_btn"><i class="fa fa-check"></i> <?php echo $lang['ok']; ?></button>
	<button class="cancel_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
</div>