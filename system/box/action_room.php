<?php
require('../config_session.php');

if(!isset($_POST['id'], $_POST['cp'])){
	die();
}
$id = escape($_POST['id']);
$curpage = escape($_POST['cp']);
$user = userRoomDetails($id);

if(empty($user)){
	echo 0;
	die();
}
if(mySelf($user['user_id'])){
	echo 1;
	die();
}

$room_actions = '';

if(insideChat($curpage)){
	$room_actions = trim(boomTemplate('element/room_actions', $user));
}
?>
<div class="modal_top">
	<div class="modal_top_empty">
		<div class="btable">
			<div class="avatar_top_mod">
				<img src="<?php echo myAvatar($user['user_tumb']); ?>"/>
			</div>
			<div class="avatar_top_name">
				<?php echo $user['user_name']; ?>
			</div>
		</div>
	</div>
	<div class="modal_top_element close_over">
		<i class="fa fa-times"></i>
	</div>
</div>
<div id="mmainaction" class="pad20">
	<?php 
	if(empty($room_actions)){
		echo emptyZone($lang['no_data']);
	}
	else {
		echo $room_actions;
	}
	?>
</div>
