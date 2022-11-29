<?php
require_once('../config_session.php');
if(!boomAllow(10)){
	die();
}
if(!canRoom()){
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['room_name']; ?></p>
			<input id="set_room_name" class="full_input" type="text" maxlength="<?php echo $cody['max_room_name']; ?>" />
		</div>
		<div class="setting_element">	
			<p class="label"><?php echo $lang['room_type']; ?></p>
			<select  class="select_room"  id="set_room_type">
				<?php echo roomRanking(); ?>
			</select>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['password']; ?></p>
			<input id="set_room_password" class="full_input" type="text" maxlength="20"/>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['room_description']; ?></p>
			<textarea id="set_room_description" class="full_textarea medium_textarea" type="text" maxlength="<?php echo $cody['max_description']; ?>"></textarea>
		</div>
	</div>
	<button class="reg_button theme_btn" onclick="addAdminRoom();" id="add_admin_room"><i class="fa fa-plus"></i> <?php echo $lang['create']; ?></button>
	<button class="reg_button cancel_modal default_btn"><?php echo $lang['cancel']; ?></button>
</div>