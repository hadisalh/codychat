<div class="sub_list_item hist<?php echo $boom['id']; ?>">
	<div class="sub_list_cell">
		<div class="btable btauto">
			<div class="bcell bold">
				<?php echo renderHistoryText($boom); ?>
			</div>
			<div class="bcell text_xsmall bcauto sub_text aright rtl_aleft">
				<?php echo displayDate($boom['history_date']); ?>
			</div>
			<?php if(boomAllow($cody['can_manage_history'])){ ?>
			<div class="bcell pwidth30 text_xsmall centered_element" onclick="removeHistory(<?php echo $boom['target']; ?>, <?php echo $boom['id']; ?>);">
				<i class="fa fa-times"></i>
			</div>
			<?php } ?>
		</div>
		<div class="text_xsmall tpad3  history_reason">
			<span class="bold"><?php echo $lang['by']; ?> : </span> <span class="sub_text"><?php echo $boom['user_name']; ?></span>
		</div>
		<div class="text_xsmall tpad3  history_reason">
			<span class="bold"><?php echo $lang['delay']; ?> : </span> <span class="sub_text"><?php echo boomRenderMinutes($boom['delay']); ?></span>
		</div>
		<div class="text_xsmall tpad3  history_reason">
			<span class="bold"><?php echo $lang['reason']; ?> : </span> <span class="sub_text"><?php echo renderReason($boom['reason']); ?></span>
		</div>
	</div>
</div>