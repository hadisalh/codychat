<?php
require_once('../config_session.php');
if(!boomAllow($cody['can_clear_console'])){
	echo 0;
	die();
}
?>
<div class="pad25">
	<div class="vpad25">
		<p class="centered_element" ><?php echo $lang['console_clear']; ?></p>
	</div>
	<div class="centered_element">
		<button onclick="clearSystemConsole();" class="reg_button theme_btn"><?php echo $lang['yes']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>