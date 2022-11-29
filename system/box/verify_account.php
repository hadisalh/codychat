<?php
require('../config_session.php');
?>
<div class="pad20">
	<div id="verify_one" class="verify_zone">
		<p class="bold text_med bmargin10"><?php echo $lang['verify_account']; ?></p>
		<p class="text_small"><?php echo $lang['verify_start']; ?></p>
		<div class="vpad20">
			<p class="text_small"><?php echo $lang['email']; ?></p>
			<p class="theme_color"><?php echo $data['user_email']; ?></p>
		</div>
		<button onclick="verifyAccount(1);" class="reg_button ok_btn"><i class="fa fa-send"></i> <?php echo $lang['verify_send']; ?></button>
		<button class="reg_button default_btn" onclick="toggleVerify();"><i class="fa fa-key"></i> <?php echo $lang['verify_got']; ?></button>
	</div>
	<div id="verify_two" class="verify_zone hidden">
		<div id="not_verify">
			<p><?php echo $lang['verify_end']; ?>
			</p>
			<div class="vpad15">
				<input type="text" id="boom_code" placeholder="<?php echo $lang['code']; ?>" class="full_input"/>
			</div>
			<button onclick="validCode(2);" class="reg_button ok_btn"><i class="fa fa-check"></i> <?php echo $lang['user_verify']; ?></button>
			<button onclick="verifyAccount(2);" class="resend_hide reg_button default_btn"><i class="fa fa-send"></i> <?php echo $lang['resend']; ?></button>
		</div>
		<div id="now_verify" class="hidden">
			<div class="centered_element">
				<div class="boom_form">
					<i class="fa fa-check text_ultra bmargin10 success"></i>
					<p><?php echo $lang['verified_now']; ?></p>
				</div>
				<div class="tpad10">
					<button class="reg_button ok_btn cancel_over"><?php echo $lang['close']; ?></button>
				</div>
			</div>
		</div>
	</div>
</div>