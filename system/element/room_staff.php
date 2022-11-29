<div class="ulist_item">
	<div class="ulist_avatar">
		<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="ulist_name">
		<p class="username <?php echo myColor($boom); ?>"><?php echo $boom["user_name"]; ?></p>
	</div>
	<div onclick="removeRoomStaff(this, <?php echo $boom['user_id']; ?>);" class="ulist_option">
		<i class="fa fa-times"></i>
	</div>
</div>