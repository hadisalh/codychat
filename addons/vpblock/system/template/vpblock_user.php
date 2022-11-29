<div class="sub_list_item" id="found<?php echo $boom['user_id']; ?>">
	<div class="sub_list_avatar">
		<img class="admin_user<?php echo $boom['user_id']; ?>" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="sub_list_name username <?php echo $boom['user_color']; ?>">
		<?php echo $boom['user_name']; ?>
	</div>
	<div class="switch_item_switch">
		<div class="switch_wrap" onclick="setUserVpblock(<?php echo $boom['user_id']; ?>);">
			<?php echo vpblockSwitch($boom, 'set_vpblock' . $boom['user_id'], $boom['user_vpblock']); ?>
		</div>
	</div>
</div>