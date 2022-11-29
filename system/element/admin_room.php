<div class="sub_list_item box_room">
	<div class="sub_list_img">
		<?php echo roomIcon($boom, 'roomlisting'); ?>
		<?php echo roomActive($boom); ?>
	</div>
	<div class="sub_list_name">
		<?php echo $boom['room_name']; ?>
	</div>
	<div onclick="editRoom(<?php echo $boom['room_id']; ?>);" class="sub_list_option">
		<i class="fa fa-edit edit_btn"></i>
	</div>
	<?php if($boom['room_id'] == 1){ ?>
		<div class="sub_list_option">
			<i class="fa fa-home"></i>
		</div>
	<?php } else { ?>
	<div onclick="deleteRoom(this, <?php echo $boom['room_id']; ?>);" class="sub_list_option">
		<i class="fa fa-times"></i>
	</div>
	<?php } ?>
</div>