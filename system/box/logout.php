<?php
require('../config_session.php');
?>
<div class="pad20 centered_element">
	<p class="text_ultra theme_color"><i class="fa fa-power-off"></i></p>
	<p class="bpad15"><?php echo $lang['want_logout']; ?></p>
	<button onclick="logOut();" class="reg_button theme_btn"><?php echo $lang['yes']; ?></button>
	<button class="reg_button cancel_modal default_btn"><?php echo $lang['no']; ?></button>
</div>