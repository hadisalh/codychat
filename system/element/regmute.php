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
		<p class="text_small tpad10"><?php echo $lang['reg_message']; ?></p>
	</div>
	<div class="tpad20 centered_element">
		<button id="dismiss_regmute" class="close_modal ok_btn reg_button"><?php echo $lang['ok']; ?></button>
	</div>
</div>