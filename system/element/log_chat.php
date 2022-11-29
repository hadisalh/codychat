<div class="chat_avatar">
	<img class="cavatar" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
</div>
<div class="my_text">
	<div class="btable">
		<div class="cname">
			<span class="username <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></span>
		</div>
		<div class="cdate">
			<?php echo displayDate($boom['post_date']); ?>
		</div>
	</div>
	<div class="chat_message">
		<?php echo systemReplace($boom['post_message']); ?>
	</div>
</div>