<div class="sub_list_item">
	<?php echo $boom['default']; ?>
	<div class="sub_list_name">
		<?php echo $boom['stream_alias']; ?>
	</div>
	<div onclick="editPlayer(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-edit"></i>
	</div>
	<div onclick="deletePlayer(<?php echo $boom['id']; ?>, this);" class="sub_list_option">
		<i class="fa fa-times"></i>
	</div>
</div>