<?php
$time_left = getActionTimer($boom['type'], $boom);
?>
<div class="sub_list_item" id="foundaction<?php echo $boom['user_id']; ?>">
	<div class="sub_list_avatar">
		<img class="admin_user<?php echo $boom['user_id']; ?>" src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
		<?php echo userActive($boom, 'sub_list_active'); ?>
	</div>
	<div class="sub_list_name">
		<p class="username  <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
		<?php if($time_left != ''){ ?>
		<p class="sub_text text_xsmall"><?php echo $time_left; ?></p>
		<?php } ?>
	</div>
	<div onclick="removeSystemAction(this, <?php echo $boom['user_id']; ?>, '<?php echo $boom['type']; ?>');" class="sub_list_option">
		<i class="fa fa-times edit_btn"></i>
	</div>
</div>