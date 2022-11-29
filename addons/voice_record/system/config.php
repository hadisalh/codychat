<?php
$load_addons = 'voice_record';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}

?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div class="page_element">
		<div class="config_section">
			<div class="setting_element ">
				<p class="label"><?php echo $lang['voice_access']; ?></p>
					<select id="set_voice_access">
						<?php echo listRank($data['addons_access'], 1); ?>
					</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['voice_main']; ?></p>
				<select id="set_voice_main">
					<?php echo onOff($data['custom2']); ?>
				</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['voice_main_time']; ?></p>
				<select id="set_voice_main_time">
					<?php echo optionCount($data['custom4'], 5, 120, 5); ?>
				</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['voice_private']; ?></p>
				<select id="set_voice_private">
					<?php echo onOff($data['custom3']); ?>
				</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['voice_private_time']; ?></p>
				<select id="set_voice_private_time">
					<?php echo optionCount($data['custom5'], 5, 120, 5); ?>
				</select>
			</div>
			<button id="save_voice_recorder" onclick="saveVoiceRecord();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				saveVoiceRecord = function(){
					$.post('addons/voice_record/system/action.php', {
						save: 1,
						set_voice_access: $('#set_voice_access').val(),
						set_voice_main: $('#set_voice_main').val(),
						set_voice_main_time: $('#set_voice_main_time').val(),
						set_voice_private: $('#set_voice_private').val(),
						set_voice_private_time: $('#set_voice_private_time').val(),
						token: utk,
						}, function(response) {
							if(response == 5){
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
