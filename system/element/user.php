<div class="ulist_item">
	<div class="ulist_avatar">
		<img onclick="getProfile(<?php echo $boom['user_id']; ?>);" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="ulist_name">
		<p class="username <?php echo myColor($boom); ?>"><?php echo $boom["user_name"]; ?></p>
	</div>
</div>