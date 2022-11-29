<?php
$load_addons = 'giphy';
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
				<p class="label"><?php echo $lang['limit_feature']; ?></p>
					<select id="set_giphy_access">
						<?php echo listRank($data['addons_access'], 1); ?>
					</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['giphy_key']; ?></p>
				<input id="set_giphy_key" class="full_input" value="<?php echo $data['custom1']; ?>" type="text"/>
				<p class="ex_admin sub_text">create app <a class="no_link_like theme_color" href="https://developers.giphy.com" target="_BLANK">https://developers.giphy.com</a></p>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['max_gifs']; ?></p>
				<select id="set_giphy_gifs">
					<?php echo optionCount($data['custom2'], 4, 100, 2); ?>
				</select>
			</div>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['max_stickers']; ?></p>
				<select id="set_giphy_stickers">
					<?php echo optionCount($data['custom3'], 8, 100, 4); ?>
				</select>
			</div>
			<button id="save_giphy" onclick="saveGiphy();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				saveGiphy = function(){
					$.post('addons/giphy/system/action.php', {
						save: 1,
						set_giphy_access: $('#set_giphy_access').val(),
						set_giphy_key: $('#set_giphy_key').val(),
						set_giphy_gifs: $('#set_giphy_gifs').val(),
						set_giphy_stickers: $('#set_giphy_stickers').val(),
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
