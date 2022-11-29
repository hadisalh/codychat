<div class="page_full">
	<div class="page_element">
		<div class="page_top_elem">
			<div class="bold page_top_title">
				<i class="fa fa-chevron-right"></i> <?php echo boomUnderClear($boom['title']); ?>
			</div>
			<?php if($boom['backcall'] != ''){ ?>
			<div class="bold aright rtl_aleft page_top_option bclick" onclick="<?php echo $boom['backcall']; ?>">
				<i class="fa fa-chevron-circle-left theme_color"></i> <?php echo $lang['back']; ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>