<div id="boom_news<?php echo $boom['id']; ?>" data="<?php echo $boom['id']; ?>" class="news_box post_element">
	<div class="post_title">
		<div class=" post_avatar get_info" data="<?php echo $boom['user_id']; ?>">
			<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
		</div>
		<div class="bcell_mid hpad5 maxflow post_info">
			<p class="username text_small <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
			<p class="text_xsmall date"><?php echo displayDate($boom['news_date']); ?></p>
		</div>
		<div onclick="openPostOptions(this);" class="post_edit bcell_mid_center">
			<i class="fa fa-ellipsis-h"></i>
			<div class="post_menu fmenu">
				<div onclick="viewNewsLikes(<?php echo $boom['id']; ?>);" class="fmenu_item fmenut">
					<?php echo $lang['view_likes']; ?>
				</div>
				<?php if(canDeleteNews($boom) || mySelf($boom['news_poster'])){ ?>
				<div onclick="openDeletePost('news', <?php echo $boom['id']; ?>);" class="fmenu_item fmenut">
					<?php echo $lang['delete']; ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="post_content">
		<?php echo boomPostIt($boom, $boom['news_message']); ?>
		<?php echo boomPostFile($boom['news_file']); ?>
	</div>
	<div class="post_control btauto">
		<div class="bcell_mid like_container newslike<?php echo $boom['id']; ?>">
			<?php echo getLikes($boom['id'], $boom['liked'], 'news'); ?>
		</div>
		<div data="0" class="bcell_mid comment_count bcauto load_comment <?php if($boom['reply_count'] < 1){ echo 'hidden'; } ?>" onclick="loadNewsComment(this, <?php echo $boom['id']; ?>);">
			<span id="nrepcount<?php echo $boom['id']; ?>"><?php echo $boom['reply_count']; ?></span> <img class="comment_icon" src="<?php echo $data['domain']; ?>/default_images/icons/comment.svg"/>
		</div>
	</div>
	<?php if(!muted() && boomAllow($cody['can_reply_news'])){ ?>
	<div class="add_comment_zone cmb<?php echo $boom['id']; ?>">
		<div class="tpad10 reply_post">
			<form class="news_reply_form" data-id="<?php echo $boom['id']; ?>">
				<input maxlength="500" placeholder="<?php echo $lang['comment_here']; ?>" class="add_comment full_input">
			</form>
		</div>
	</div>
	<?php } ?>
	<div class="tpad10 ncmtboxwrap<?php echo $boom['id']; ?>">
		<div class="ncmtbox ncmtbox<?php echo $boom['id']; ?>">
		</div>
		<div class="nmorebox nmorebox<?php echo $boom['id']; ?>">
		</div>
		<div class="clear"></div>
	</div>
</div>