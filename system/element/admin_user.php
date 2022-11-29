<div class="sub_list_item" id="found<?php echo $boom['user_id']; ?>">
	<div class="sub_list_avatar">
		<img class="admin_user<?php echo $boom['user_id']; ?>" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
		<?php echo userActive($boom, 'sub_list_active'); ?>
	</div>
	<div class="sub_list_name">
		<p class="username <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
	</div>
	<div onclick="getProfile(<?php echo $boom['user_id']; ?>);" class="sub_list_option">
		<i class="fa fa-edit edit_btn"></i>
	</div>
	<?php if(canEditUser($boom, 10, 1) && !isOwner($boom)){ ?>
	<div onclick="eraseAccount(<?php echo $boom['user_id']; ?>);" class="sub_list_option">
		<i class="fa fa-times edit_btn"></i>
	</div>
	<?php } ?>
</div>