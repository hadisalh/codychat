<?php if($data['custom' . $boom] > 0){ ?>
<div class="vip_plan sub_list_item" onclick="vipPlan(this, <?php echo $boom; ?>);">
	<div class="bcell_mid vip_checkbox">
		<i class="fa fa-circle-thin text_med"></i>
	</div>
	<div class="bcell_mid vip_plan_title">
		<?php echo $lang['vip_plan_name' . $boom]; ?>
	</div>
	<div class="bcell_mid_right vip_price_cell rtl_aleft">
		<?php echo vipSymbol($data['custom7']); ?><span class="vip_price"><?php echo $data['custom' . $boom]; ?></span>
	</div>
</div>
<?php } ?>