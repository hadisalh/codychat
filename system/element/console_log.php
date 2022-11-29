<div class="sub_list_item console_data_logs" value="<?php echo $boom['id']; ?>">
	<div class="sub_list_cell_top hpad3">
		<div class="text_small console_log">
			<?php echo renderConsoleText($boom); ?>
		</div>
		<?php if($boom['reason'] != ''){ ?>
		<div class="sub_text text_xsmall vpad3 theme_color console_reason">
			<?php echo renderReason($boom['reason']); ?>
		</div>
		<?php } ?>
	</div>
	<div class="console_date sub_text centered_element">
		<?php echo displayDate($boom['cdate']); ?>
	</div>
</div>