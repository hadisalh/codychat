<?php
require_once('../config_session.php');
?>
<div class="modal_top">
	<div class="modal_top_empty">
		<?php echo $lang['console']; ?>
	</div>
	<div class="modal_top_element close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="pad_box">
	<div class="boom_form">
	<input class="full_input" id="console_content"/>
	</div>
	<button id="send_console" onclick="sendConsole();" class="reg_button theme_btn"><i class="fa fa-check"></i> <?php echo $lang['execute']; ?></button>
	<button class="reg_button cancel_modal default_btn"><?php echo $lang['cancel']; ?></button>
</div>