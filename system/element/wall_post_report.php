<div class="post_element" id="boom_post<?php echo $boom['post_id']; ?>">
	<div class="post_title">
		<div class="post_avatar get_info" data="<?php echo $boom['user_id']; ?>">
			<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
		</div>
		<div class="hpad5 post_info bcell_mid">
			<p class="text_small username <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
			<p class="text_xsmall date"><?php echo displayDate($boom['post_date']); ?></p>
		</div>
	</div>
	<div class="post_content">
		<?php echo boomPostIt($boom, $boom['post_content']); ?>
		<?php echo boomPostFile($boom['post_file']); ?>
	</div>
</div>