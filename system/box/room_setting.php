<?php
require_once('../config_session.php');

if(!canEditRoom()){
	die();
}
$room = roomDetails();
$room_owner = getRoomStaff($data['user_roomid'], 6);
$room_admin = getRoomStaff($data['user_roomid'], 5);
$room_mod   = getRoomStaff($data['user_roomid'], 4);

?>
<div class="modal_top">
	<div class="modal_top_empty bold">
	</div>
	<div class="modal_top_element close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="modal_menu">
	<ul>
		<li class="modal_menu_item modal_selected" data="mroom_setting" data-z="room_setting"><?php echo $lang['options']; ?></li>
		<li class="modal_menu_item" data="mroom_setting" data-z="room_staff"><?php echo $lang['staff']; ?></li>
		<li class="modal_menu_item" data="mroom_setting" data-z="room_muted"><?php echo $lang['muted']; ?></li>
		<?php if(!isMainRoom()){ ?>
		<li class="modal_menu_item" data="mroom_setting" data-z="room_blocked"><?php echo $lang['blocked']; ?></li>
		<?php } ?>
	</ul>
</div>
<div id="mroom_setting">
	<div class="modal_zone pad_box" id="room_setting">
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
			<div class="setting_element">
				<p class="label"><?php echo $lang['password']; ?></p>
				<input id="set_room_password" maxlength="20" class="full_input" value="<?php echo $room['password']; ?>" type="text"/>
			</div>
			<div class="setting_element">
				<p class="label"><?php echo $lang['room_description']; ?></p>
				<textarea id="set_room_description" class="full_textarea medium_textarea" type="text" maxlength="<?php echo $cody['max_description']; ?>"><?php echo $room['description']; ?></textarea>
			</div>
		</div>
		<button type="button" id="save_room" class="reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
	</div>
	<div class="modal_zone hide_zone" id="room_staff">
		<?php if(empty($room_owner . $room_admin . $room_mod)){ ?>
			<div class="ulist_container">
			<?php echo emptyZone($lang['no_data']); ?>
			</div>
		<?php } ?>
		<?php if(!empty($room_owner . $room_admin . $room_mod)){ ?>
		<div class="ulist_container">
			<?php if(!empty($room_owner)){ ?>
			<p class="label_line"><?php echo $lang['r_owner']; ?></p>
			<div class="vpad15">
				<?php echo $room_owner; ?>
			</div>
			<?php } ?>
			<?php if(!empty($room_admin)){ ?>
			<p class="label_line"><?php echo $lang['r_admin']; ?></p>
			<div class="vpad15">
				<?php echo $room_admin; ?>
			</div>
			<?php } ?>
			<?php if(!empty($room_mod)){ ?>
			<p class="label_line"><?php echo $lang['r_mod']; ?></p>
			<div class="vpad15">
				<?php echo $room_mod; ?>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<div class="modal_zone hide_zone" id="room_muted">
		<div class="ulist_container">
			<?php echo getRoomMuted($data['user_roomid']); ?>
		</div>
	</div>
	<?php if(!isMainRoom()){ ?>
	<div class="modal_zone hide_zone" id="room_blocked">
		<div class="ulist_container">
			<?php echo getRoomBlocked($data['user_roomid']); ?>
		</div>
	</div>
	<?php } ?>
</div>