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

$main_actions = '';
$room_actions = '';

$main_actions = trim(boomTemplate('element/main_actions', $user));
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
<div class="modal_menu">
	<ul>
		<li class="modal_menu_item modal_selected" data="mmainaction" data-z="main_actions"><?php echo $lang['main_action']; ?></li>
		<?php if(!empty($room_actions)){ ?>
		<li class="modal_menu_item" data="mmainaction" data-z="room_actions"><?php echo $lang['room_action']; ?></li>
		<?php } ?>
	</ul>
</div>
<div id="mmainaction">
	<div class="modal_zone pad20" id="main_actions">
		<?php 
		if(empty($main_actions)){
			echo emptyZone($lang['no_data']);
		}
		else {
			echo $main_actions;
		}
		?>
	</div>
	<?php if(!empty($room_actions)){ ?>
	<div class="hide_zone modal_zone pad20" id="room_actions">
		<?php echo $room_actions; ?>
	</div>
	<?php } ?>
</div>
