<?php
$load_addons = 'vpblock';
require_once('../../../system/config_addons.php');

if(!boomAllow(10)){
	die();
}
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" data="vpblock" data-z="vpblock_setting"><?php echo $lang['settings']; ?></li>
				<li class="tab_menu_item" data="vpblock" data-z="vpblock_data"><?php echo $lang['data']; ?></li>
				<li class="tab_menu_item" data="vpblock" data-z="vpblock_help"><?php echo $lang['help']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div id="vpblock">
			<div id="vpblock_setting" class="tab_zone">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['vpblock_status']; ?></p>
					<select id="set_vpblock_status">
						<?php echo onOff($data['custom1']); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vpblock_key']; ?></p>
					<input id="set_vpblock_key" class="full_input" value="<?php echo $data['custom2']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vpblock_action']; ?></p>
					<select id="set_vpblock_delay">
						<?php echo optionMinutes($data['custom5'], array(5,10,15,30,60,120,180,240,300,360,720,1440,2880,4320,10080,20160,43200)); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vpblock_reason']; ?></p>
					<input id="set_vpblock_reason" class="full_input" value="<?php echo $data['custom6']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vpblock_grace']; ?></p>
					<select id="set_vpblock_grace">
						<option <?php echo selCurrent(0, $data['custom8']); ?> value="0"><?php echo $lang['none']; ?></option>
						<?php echo optionMinutes($data['custom8'], array(360,720,1440,2880,4320,10080,20160,43200)); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vpblock_keep']; ?></p>
					<select id="set_vpblock_keep">
						<?php echo optionMinutes($data['custom7'], array(360,720,1440,2880,4320, 10080,20160,43200,129600,259200,518400)); ?>
					</select>
				</div>
				<button onclick="vpblockSave();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			</div>
			<div id="vpblock_data" class="tab_zone hide_zone">
				<div class="admin_search">
					<div class="admin_input bcell">
						<input class="full_input" id="vpblock_search" type="text"/>
					</div>
					<div id="vpblock_find" onclick="vpblockSearch();" class="admin_search_btn default_btn">
						<i class="fa fa-search" aria-hidden="true"></i>
					</div>
				</div>
				<div id="vpblock_result" data="" class="tmargin15">
				</div>
			</div>
			<div id="vpblock_help" class="tab_zone hide_zone no_rtl">
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Getting api key
					</div>
					<div class="docu_content">
						<div class="pad10 text_small">
							<p class="sub_text">
							This addons require a api key to run. Note that proxycheck.io offer 1000 query per day for free but you need to register with them to have such free plan. If you need more 
							ip verification in a day then you can purchase their very low cost plan and protect your chat. Here is link <span onclick="openLinkPage('https://proxycheck.io');" class="theme_color link_like bclick">https://proxycheck.io</span>.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Settings
					</div>
					<div class="docu_content">
						<div class="pad10 text_small">
							<p class="bold bmargin5"><?php echo $lang['vpblock_status']; ?></p>
							<p class="sub_text">Turn on and off the current adblock effect.</p>
							<p class="bold bmargin5 tmargin10"><?php echo $lang['vpblock_key']; ?></p>
							<p class="sub_text">This addons require a api key you can create your own free api key at https://proxycheck.io note that 1000 daily query are included in the free plan if you need more you must purchase extra query plan at low cost.</p>
							<p class="bold bmargin5 tmargin10"><?php echo $lang['vpblock_action']; ?></p>
							<p class="sub_text">Define the duration of the kick action when a user try to enter the chat page using a proxy or a vpn.</p>
							<p class="bold bmargin5 tmargin10"><?php echo $lang['vpblock_reason']; ?></p>
							<p class="sub_text">Message that will be displayed to the user.</p>
							<p class="bold bmargin5 tmargin10"><?php echo $lang['vpblock_grace']; ?></p>
							<p class="sub_text">Set the time after registration of a user where the vpblock should stop looking for vpn for the user there is no need to extend the check for a long period of time if a user is safe.</p>
							<p class="bold bmargin5 tmargin10"><?php echo $lang['vpblock_keep']; ?></p>
							<p class="sub_text">Set the time that already checked ip are stored in database once that delay expire they will be rescanned.</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Data
					</div>
					<div class="docu_content">
						<div class="pad10 text_small">
							<p class="sub_text">
							From this section you can search for a specific user fromt he search bar and turn off or on the vpblock check for the specific user. This feature can be very usefull to stop vpblock blocking account that may be false 
							positive.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				vpblockSave = function(){
					$.post('addons/vpblock/system/action.php', {
						vpblock_save: 1,
						status: $('#set_vpblock_status').val(),
						key: $('#set_vpblock_key').val(),
						action: $('#set_vpblock_action').val(),
						delay: $('#set_vpblock_delay').val(),
						reason: $('#set_vpblock_reason').val(),
						grace: $('#set_vpblock_grace').val(),
						keep: $('#set_vpblock_keep').val(),
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
				vpblockSearch = function(){
					$.post('addons/vpblock/system/action.php', {
						search: $('#vpblock_search').val(),
						token: utk,
						}, function(response) {
							$('#vpblock_result').html(response);
					});	
				}	
				vpblockUser = function(user, item){
					var vpval = $(item).attr('data');
					if(vpval == 1){
						var vpend = 0;
					}
					else if(vpval == 0){
						var vpend = 1;
					}
					$.post('addons/vpblock/system/action.php', {
						user: user,
						value: vpend,
						token: utk,
						}, function(response) {
					});	
				}
			</script>
		</div>
	</div>
</div>
