<?php
$load_addons = 'youtube';
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
				<p class="label"><?php echo $lang['youtube_access']; ?></p>
					<select id="set_youtube_access">
						<?php echo listRank($data['addons_access'], 1); ?>
					</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['youtube_key']; ?></p>
				<input id="set_youtube_key" class="full_input" value="<?php echo $data['custom1']; ?>" type="text"/>
				<p class="ex_admin sub_text">create app <a class="no_link_like theme_color" href="https://developers.google.com/youtube/v3/getting-started" target="_BLANK">https://developers.google.com/youtube/v3/getting-started</a></p>
			</div>
			<button id="save_youtube" onclick="saveyoutube();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				saveyoutube = function(){
					$.post('addons/youtube/system/action.php', {
						save: 1,
						set_youtube_access: $('#set_youtube_access').val(),
						set_youtube_key: $('#set_youtube_key').val(),
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
