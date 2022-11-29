<div class="ulist_item">
	<div class="ulist_avatar">
		<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="ulist_name">
		<p class="username <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
	</div>
	<div class="ulist_option" onclick="removeFriend(this, <?php echo $boom['user_id']; ?>);">
		<i class="fa fa-times"></i>
	</div>
</div>