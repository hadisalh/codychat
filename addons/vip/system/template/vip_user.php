<div class="sub_list_item"  id="pvip<?php echo $boom['user_id']; ?>">
	<div class="sub_list_avatar">
		<img class="admin_user<?php echo $boom['user_id']; ?>" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="sub_list_content hpad5">
		<p class="bold <?php echo myColor($boom); ?> bellpis"><?php echo $boom['user_name']; ?></p>
		<p class="text_xsmall sub_text"><?php echo vipEndingDate($boom['vip_end']); ?></p>
	</div>
	<div onclick="getProfile(<?php echo $boom['user_id']; ?>);" class="sub_list_option">
		<i class="fa fa-user-circle-o"></i>
	</div>
	<div onclick="vipCancelPlan(<?php echo $boom['user_id']; ?>);" class="sub_list_option">
		<i class="fa fa-times"></i>
	</div>
</div>