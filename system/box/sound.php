<?php
require('../config_session.php');
?>
<div class="pad20">
	<div class="switch_item list_element">
		<div class="switch_item_text">
			<?php echo $lang['chat_sound']; ?>
		</div>
		<div class="switch_item_switch">
			<div class="switch_wrap">
				<?php echo createSwitch('set_chat_sound', soundStatus(1), 'saveUserSound'); ?>
			</div>
		</div>
	</div>
	<div class="switch_item list_element">
		<div class="switch_item_text">
			<?php echo $lang['private_sound']; ?>
		</div>
		<div class="switch_item_switch">
			<div class="switch_wrap">
				<?php echo createSwitch('set_private_sound', soundStatus(2), 'saveUserSound'); ?>
			</div>
		</div>
	</div>
	<div class="switch_item list_element">
		<div class="switch_item_text">
			<?php echo $lang['notification_sound']; ?>
		</div>
		<div class="switch_item_switch">
			<div class="switch_wrap">
				<?php echo createSwitch('set_notification_sound', soundStatus(3), 'saveUserSound'); ?>
			</div>
		</div>
	</div>
	<div class="switch_item list_element">
		<div class="switch_item_text">
			<?php echo $lang['username_sound']; ?>
		</div>
		<div class="switch_item_switch">
			<div class="switch_wrap">
				<?php echo createSwitch('set_username_sound', soundStatus(4), 'saveUserSound'); ?>
			</div>
		</div>
	</div>
</div>