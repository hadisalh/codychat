<?php 
require('../config_session.php');
?>
<div class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input type="text" id="my_new_username" value="<?php echo $data['user_name']; ?>" class="full_input"/>
	</div>
	<button onclick="changeMyUsername();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
	<button class="cancel_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
</div>