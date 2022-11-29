<?php 
require('../config_session.php');
?>
<div class="pad_box">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['email']; ?></p>
			<input id="test_email" class="full_input" value="<?php echo $data['user_email']; ?>" type="text"/>
		</div>
	</div>
	<button onclick="testMail();" class="reg_button theme_btn"><i class="fa fa-send"></i> <?php echo $lang['send']; ?></button>
	<button class="cancel_modal reg_button default_btn"><?php echo $lang['cancel']; ?></button>
</div>