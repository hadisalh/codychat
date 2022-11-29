<?php 
if(registration()){ 
	$message = $lang['guest_message'] . ' ' . $lang['guest_message2'];
	$button = 1;
}
else {
	$message = $lang['guest_message'];
	$button = 0;
}
?>
<div class="top_mod">
	<div class="top_mod_empty">
	</div>
	<div class="top_mod_option close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="bpad30 hpad30">
	<div class="centered_element bpad15">
		<img class="large_icon" src="<?php echo $data['domain']; ?>/default_images/icons/regmute.svg"/>
	</div>
	<div class="centered_element">
		<p class="text_large bold"><?php echo textReplace($lang['welcome_user']); ?></p>
		<p class="text_small tpad10"><?php echo $message; ?></p>
	</div>
	<div class="tpad20 centered_element">
		<button class="close_modal default_btn reg_button"><?php echo $lang['close']; ?></button>
		<?php if($button == 1){ ?>
		<button onclick="openGuestRegister();" class="close_modal ok_btn reg_button"><?php echo $lang['register']; ?></button>
		<?php } ?>
	</div>
</div>