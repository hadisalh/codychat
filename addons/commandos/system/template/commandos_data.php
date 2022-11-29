<div class="sub_list_item">
	<div class="sub_list_icon">
		<?php echo $boom['dtype']; ?>
	</div>
	<div class="sub_list_content">
		<?php echo $boom['command']; ?>
	</div>
	<div onclick="editCommandos(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-edit"></i>
	</div>
	<div onclick="deleteCommandos(this,<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-times"></i>
	</div>
</div>