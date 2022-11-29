<?php
require('../config_session.php');

if(!isset($_POST['edit_room']) || !boomAllow(9)){
	die();
}
$target = escape($_POST['edit_room']);
$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = '$target'");
if($get_room->num_rows > 0){
	$room = $get_room->fetch_assoc();
}
else {
	echo 0;
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<?php if(usePlayer()){ ?>
		<div class="setting_element ">
			<p class="label"><?php echo $lang['default_player']; ?></p>
			<select id="set_room_player">
				<?php echo adminPlayer($room['room_player_id'], 1); ?>
			</select>
		</div>
		<?php } ?>
		<div class="setting_element">
			<p class="label"><?php echo $lang['room_name']; ?></p>
			<input id="set_room_name" maxlength="30" class="full_input" value="<?php echo $room['room_name']; ?>" type="text"/>
		</div>
		<div class="setting_element ">
			<p class="label"><?php echo $lang['room_type']; ?></p>
			<select id="set_room_access">
				<?php echo roomRanking($room['access']); ?>
			</select>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['password']; ?></p>
			<input id="set_room_password" maxlength="20" class="full_input" value="<?php echo $room['password']; ?>" type="text"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['room_description']; ?></p>
			<textarea id="set_room_description" class="full_textarea medium_textarea" type="text" maxlength="<?php echo $cody['max_description']; ?>"><?php echo $room['description']; ?></textarea>
		</div>
	</div>
	<button data="<?php echo $room['room_id']; ?>" type="button" id="admin_save_room" class="reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
	<button class="cancel_modal reg_button default_btn"><?php echo $lang['cancel']; ?></button>
</div>