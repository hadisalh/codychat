<div class="out_page_container back_dark">
	<div class="out_page_content">
		<div class="out_page_box">
			<div class="pad_box">
				<p class="bmargin15"><i class="fa fa-ban error text_ultra"></i></p>
				<p class="text_med"><?php echo $lang['site_banned']; ?></p>
				<?php if(!empty($data['ban_msg'])){ ?>
				<div class="vpad15">
					<p class="text_small theme_color"><?php echo $lang['reason_given']; ?></p>
					<p class="text_med"><?php echo renderReason($data['ban_msg']); ?></p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
