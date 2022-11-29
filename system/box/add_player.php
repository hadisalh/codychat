<?php
require_once('../config_session.php');
if(!boomAllow(9)){
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<div class="setting_element ">
			<p class="label"><?php echo $lang['stream_alias']; ?></p>
			<input id="add_player_alias" class="full_input"/>
		</div>
		<div class="setting_element ">
			<p class="label"><?php echo $lang['stream_url']; ?></p>
			<input id="add_player_url" class="full_input"/>
		</div>
	</div>
	<button onclick="addPlayer();" type="button" class="reg_button theme_btn"><i class="fa fa-plus-circle"></i> <?php echo $lang['add']; ?></button>
	<button type="button" class="cancel_modal reg_button default_btn"><?php echo $lang['cancel']; ?></button>
	<div class="clear"></div>
</div>