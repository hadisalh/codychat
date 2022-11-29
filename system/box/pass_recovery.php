<?php 
require('../config.php');
?>
<div class="pad15">
	<div class="boom_form">
		<p class="label"><?php echo $lang['email']; ?></p>
		<input id="recovery_email" class="full_input" maxlength="80" type="text">
	</div>
	<button onclick="sendRecovery();" type="button" class="large_button full_button theme_btn tmargin5" id="recovery_button"><?php echo $lang['recover']; ?></button>
</div>