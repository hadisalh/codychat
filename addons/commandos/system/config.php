<?php
$load_addons = 'commandos';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}

?>
<style>
.commandos_type { width:50px; }
</style>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" data="commandos" data-z="commandos_add"><?php echo $lang['add']; ?></li>
				<li class="tab_menu_item" data="commandos" data-z="commandos_listing" onclick="listCommandos();"><?php echo $lang['commandos_list']; ?></li>
				<li class="tab_menu_item" data="commandos" data-z="commandos_setting"><?php echo $lang['settings']; ?></li>
				<li class="tab_menu_item" data="commandos" data-z="commandos_help"><?php echo $lang['help']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div id="commandos">
			<div id="commandos_add" class="tab_zone">
				<div class="form_split">
					<div class="form_left">
						<div class="setting_element ">
							<p class="label"><?php echo $lang['commandos_mode']; ?></p>
							<select id="commandos_add_mode">
								<option value="1"><?php echo $lang['commandos_base']; ?></option>
								<option value="2"><?php echo $lang['commandos_user']; ?></option>
							</select>
						</div>
					</div>
					<div class="form_right">
						<div class="setting_element">
							<p class="label"><?php echo $lang['commandos_rank']; ?></p>
							<select id="commandos_add_rank">
								<?php echo listRank(0, 1); ?>
							</select>
						</div>
					</div>
					<div class="clear">
					</div>
				</div>
				<div class="boom_form">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['commandos_command']; ?></p>
						<input id="commandos_add_command" class="full_input" type="text"/>
					</div>
					<div class="setting_element ">
						<p class="label"><?php echo $lang['commandos_output']; ?></p>
						<textarea id="commandos_add_output" class="full_textarea medium_textarea" type="text"/></textarea>
					</div>
				</div>
				<button id="add_superbot" onclick="addCommandos();" type="button" class="reg_button theme_btn"><i class="fa fa-plus-circle"></i> <?php echo $lang['add']; ?></button>
			</div>
			<div id="commandos_listing" class="tab_zone hide_zone">
				<div id="commandos_list">
				</div>
			</div>
			<div id="commandos_setting" class="tab_zone hide_zone">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['limit_feature']; ?></p>
						<select id="set_commandos_access">
							<?php echo listRank($data['addons_access'], 1); ?>
						</select>
				</div>
				<div class="setting_element ">
					<p class="label"><?php echo $lang['commandos_prefix']; ?></p>
					<input id="set_commandos_prefix" class="full_input" value="<?php echo $data['custom1']; ?>" type="text"/>
				</div>
				<button id="save_commandos" onclick="saveCommandos();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			</div>
			<div id="commandos_help" class="hide_zone tab_zone no_rtl">
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Command syntax
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								You can add 2 the user based command or the base command. A user based command is a command that require to be followed by a username. Example if you want to 
								create the <span class="theme_color"><?php echo $data['custom1']; ?>welcome</span> command and want it to work only when it is followed by a username then
								you need to select the user based command mode for the specific command. When a command is set to user mode the <span class="theme_color">%user%</span>
								in the output will be replaced by the username provided. If the name do not exist the command will abort. in Both case the <span class="theme_color">%me%</span>
								will be replaced by the name of the user that trigger Commandos.
							</p>
							<br/>
							<p>Normal command syntax -> <span class="theme_color"><?php echo $data['custom1']; ?>welcome</span></p>
							<p>User based command syntax -> <span class="theme_color"><?php echo $data['custom1']; ?>welcome <?php echo $data['user_name']; ?></span></p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Command field
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								In the command field you can add command you wish to add to the commandos. It is important that you do not add the prefix in the command input. Example if
								you want to add <span class="theme_color"><?php echo $data['custom1']; ?>hello</span> simply add <span class="theme_color">hello</span> to the command input.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Output field
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							In the output field you can add the output that Commandos should send to the chat when a user trigger the command. You can add some html tag. Here are
							the html tag accepted by Commandos 
							</p>
							<div class="vpad10 bold">
								<p><?php echo htmlspecialchars('<span> <u> <strike> <small> <font> <center> <blink> <marquee>'); ?></p>
								<p><?php echo htmlspecialchars('<a> <p> <h1> <h2> <h3> <h4> <b> <strong> <br> <i> <ul> <li>'); ?><p>
							</div>
							You can also insert avatar and image or youtube video by simply adding the url of those or the emoticon tag. example if you want to add a smile simply add
							<span class="theme_color">:)</span> or <span class="theme_color">:smile:</span> in the output field. All images, youtube link and emoticon are converted
							by Commandos during the output with default system processing.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Predefined word completion
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							the following code are going to be replaced by their respective value by Commandos. Example if your output is <span class="theme_color">hello %user% welcome to the chat my name is %me%</span>
							the output of commandos when a user will type the command will be <span class="theme_color">hello target_username welcome to the chat my name is <?php echo $data['user_name']; ?></span>.
							the target_username represent the username on who you have called the command. Read command syntax section to know more about how syntax work.
							</p>
							<div class="vpad10">
								<p><span class="theme_color">%me%</span> - your current username</p>
								<p><span class="theme_color">%user%</span> - target username</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				addCommandos = function(){
					$.post('addons/commandos/system/action.php', {
						add_mode: $('#add_mode').val(),
						commandos_add_command: $('#commandos_add_command').val(),
						commandos_add_output: $('#commandos_add_output').val(),
						commandos_add_rank: $('#commandos_add_rank').val(),
						commandos_add_mode: $('#commandos_add_mode').val(),
						token: utk,
						}, function(response) {
							if(response == 1){
								callSaved(system.saved, 1);
								$('#commandos_add_command').val('');
								$('#commandos_add_output').val('');
								$('#commandos_add_rank').val('');
								
							}
							else if(response == 2){
								callSaved('<?php echo $lang['commandos_already_exist']; ?>', 3);
							}
							else if(response == 3){
								callSaved(system.emptyField, 3);
							}
							else{
								callSaved(system.error, 3);
							}
					});	
				}
				saveEditCommandos = function(){
					$.post('addons/commandos/system/action.php', {
						add_mode: $('#add_mode').val(),
						commandos_edit_command: $('#commandos_edit_command').val(),
						commandos_edit_output: $('#commandos_edit_output').val(),
						commandos_edit_rank: $('#commandos_edit_rank').val(),
						commandos_edit_mode: $('#commandos_edit_mode').val(),
						commandos_edit_id: $('#commandos_edit_id').val(),
						token: utk,
						}, function(response) {
							if(response == 1){
								callSaved(system.saved, 1);
								hideModal();
							}
							else if(response == 2){
								callSaved('<?php echo $lang['commandos_already_exist']; ?>', 3);
							}
							else if(response == 3){
								callSaved(system.emptyField, 3);
							}
							else{
								callSaved(system.error, 3);
							}
					});	
				}
				deleteCommandos = function(item, id){
					$.post('addons/commandos/system/action.php', {
						delete_commandos: id,
						token: utk,
						}, function(response) {
							if(response == 1){
								$(item).parent().remove();
							}
							else{
								callSaved(system.error, 3);
							}
					});	
				}
				editCommandos = function(id){
					$.post('addons/commandos/system/edit_commandos.php', {
						edit_commandos: id,
						token: utk,
						}, function(response) {
							showModal(response, 600);
					});	
				}
				listCommandos = function(){
					$.post('addons/commandos/system/list_commandos.php', {
						list_commandos: 1,
						token: utk,
						}, function(response) {
							$('#commandos_list').html(response);
					});	
				}
				saveCommandos = function(){
					$.post('addons/commandos/system/action.php', {
						save: 1,
						set_commandos_access: $('#set_commandos_access').val(),
						set_commandos_prefix: $('#set_commandos_prefix').val(),
						token: utk,
						}, function(response) {
							if(response == 1){
								callSaved(system.saved, 1);
							}
							else{
								callSaved(system.error, 3);
							}
					});	
				}

			</script>
		</div>
	</div>
</div>
