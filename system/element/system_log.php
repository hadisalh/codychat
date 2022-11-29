<li class="other_logs splog <?php echo $boom['type']; ?>">
	<div class="chat_avatar">
		<img class="cavatar" src="<?php echo specialLogIcon($boom['icon']); ?>"/>
	</div>
	<div class="my_text">
		<div class="btable">
			<div class="bcell_mid bold sptitle">
				<?php echo $boom['title']; ?>
			</div>
			<?php if($boom['delete'] == 1){ ?>
			<div onclick="hideThisPost(this)"; class="spclear">
				<i class="fa fa-times"></i>
			</div>
			<?php } ?>
		</div>
		<div class="chat_message text_small sptext">
			<?php echo $boom['content']; ?>
		</div>
	</div>
</li>