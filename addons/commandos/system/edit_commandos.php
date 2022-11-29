<?php
$load_addons = 'commandos';
require_once('../../../system/config_addons.php');

if(!isset($_POST['edit_commandos'])){
	die();
}
if(!boomAllow($cody['can_manage_addons'])){
	die();
}
$id = escape($_POST['edit_commandos']);
$get_commandos = $mysqli->query("SELECT * FROM boom_commandos WHERE id = '{$id}'");
if($get_commandos->num_rows < 1){
	echo 0;
	die();
}
$command = $get_commandos->fetch_assoc();
?>
<div class="pad_box">
	<div class="form_split">
		<div class="form_left">
			<div class="setting_element ">
				<p class="label"><?php echo $lang['commandos_mode']; ?></p>
				<select id="commandos_edit_mode">
					<option <?php echo selCurrent($command['command_mode'], 1); ?> value="1"><?php echo $lang['commandos_base']; ?></option>
					<option <?php echo selCurrent($command['command_mode'], 2); ?> value="2"><?php echo $lang['commandos_user']; ?></option>
				</select>
			</div>
		</div>
		<div class="form_right">
			<div class="setting_element">
				<p class="label"><?php echo $lang['commandos_rank']; ?></p>
				<select id="commandos_edit_rank">
					<?php echo listRank($command['command_rank'], 1); ?>
				</select>
			</div>
		</div>
	</div>
	<div class="boom_form">
		<div class="setting_element ">
			<p class="label"><?php echo $lang['commandos_command']; ?></p>
			<input id="commandos_edit_command" value="<?php echo $command['command']; ?>" class="full_input" type="text"/>
			<input id="commandos_edit_id" value="<?php echo $command['id']; ?>" class="hidden"/>
		</div>
		<div class="setting_element ">
			<p class="label"><?php echo $lang['commandos_output']; ?></p>
			<textarea id="commandos_edit_output" class="full_textarea large_textarea" type="text"><?php echo $command['command_output']; ?></textarea>
		</div>
	</div>
	<button id="add_superbot" onclick="saveEditCommandos();" type="button" class="reg_button theme_btn"><i class="fa fa-plus-circle"></i> <?php echo $lang['save']; ?></button>
</div>