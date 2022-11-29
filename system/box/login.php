<?php 
require('../config.php');
?>
<div id="login_form_box" class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['name_email']; ?></p>
		<input id="user_username" class="user_username full_input" type="text" maxlength="50" name="username">
		<p class="label tpad5"><?php echo $lang['password']; ?></p>
		<input id="user_password"  class="full_input" maxlength="30" type="password" name="password"><br />
	</div>
	<div class="login_control">
		<button onclick="sendLogin();" type="button" class="theme_btn full_button large_button"><i class="fa fa-sign-in"></i> <?php echo $lang['login']; ?></button>
	</div>
	<div class="forgot_pass_elem tmargin10">
		<p onclick="getRecovery();" class="forgot_password text_small bclick sub_text"><?php echo $lang['forgot']; ?></p>
	</div>
</div>
<?php if(registration()){ ?>
<div class="bold text_small not_member" onclick="getRegistration();">
	<p class=""><?php echo $lang['not_member']; ?></p>
</div>
<?php } ?>