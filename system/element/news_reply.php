<div data="<?php echo $boom['reply_id']; ?>" id="nreply<?php echo $boom['reply_id']; ?>" class="reply_item">
	<div class="reply_avatar get_info" data="<?php echo $boom['user_id']; ?>">
		<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="reply_content">
		<div class="btable">
			<div class="bcell_top maxflow">
				<span class="<?php echo myColor($boom); ?> text_small username"><?php echo $boom['user_name']; ?></span> <span class="text_xsmall no_break date"><?php echo displayDate($boom['reply_date']); ?></span>
			</div>
			<?php if(canDeleteNewsReply($boom)){ ?>
			<div onclick="openDeletePost('news_reply', <?php echo $boom['reply_id']; ?>);" class="reply_delete bcell_top">
				<i class="fa fa-times"></i>
			</div>
			<?php } ?>
		</div>
		<div class="text_small vpad3">
		<?php echo boomPostIt($boom, $boom['reply_content']); ?>
		</div>
	</div>
</div>