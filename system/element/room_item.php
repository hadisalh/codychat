<?php
$ask = 0;
$current = '';
$owner = '';
if($boom['password'] != ''){
	$ask = 1;
}
if($boom['room_id'] == $data['user_roomid']){
	$current = 'noview';
}
if($data['user_id'] == $boom['room_creator']){
	$owner = 'owner ';
}
?>
<div class="in_room_element btauto <?php echo $current; ?> list_element" onclick="switchRoom(<?php echo $boom['room_id']; ?>, <?php echo $ask; ?>,<?php echo $boom['access']; ?>);">
	<div class="in_room_icon">
		<?php echo roomIcon($boom, 'in_room_img'); ?>
		<?php echo roomLock($boom, 'in_room_lock'); ?>
	</div>
	<div class="in_room_name">
		<?php echo $boom['room_name']; ?>
	</div>
	<div class="in_room_count">
		<p class="text_reg"><?php echo $boom['room_count']; ?> <i class="fa fa-user theme_color"></i></p>
	</div>
</div>