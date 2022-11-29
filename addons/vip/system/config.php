<?php
$load_addons = 'vip';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" data="vip" data-z="vip_setting"><?php echo $lang['settings']; ?></li>
				<li class="tab_menu_item" data="vip" data-z="vip_manage" onclick="vipLoadList();"><?php echo $lang['vip_manage']; ?></li>
				<li class="tab_menu_item" data="vip" data-z="vip_transaction" onclick="vipLoadTransaction();"><?php echo $lang['vip_transaction']; ?></li>
				<li class="tab_menu_item" data="vip" data-z="vip_help"><?php echo $lang['help']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div id="vip">
			<div id="vip_setting" class="tab_zone">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['vip_mode_status']; ?></p>
					<select id="set_paypal_mode">
						<option <?php echo selCurrent($data['custom6'], 0); ?> value="0"><?php echo $lang['off']; ?></option>
						<option <?php echo selCurrent($data['custom6'], 1); ?> value="1"><?php echo $lang['vip_sandbox']; ?></option>
						<option <?php echo selCurrent($data['custom6'], 2); ?> value="2"><?php echo $lang['vip_live']; ?></option>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_paypal_id']; ?></p>
					<input id="set_paypal_id" class="full_input" value="<?php echo $data['custom9']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_paypal_secret']; ?></p>
					<input id="set_paypal_secret" class="full_input" value="<?php echo $data['custom10']; ?>" type="text"/>
				</div>
				<div class="setting_element ">
					<p class="label"><?php echo $lang['vip_currency']; ?></p>
					<select id="set_vip_currency">
						<?php echo listVipCurrency($data['custom7']); ?>
					</select>
				</div>
				<div class="vpad15">
					<?php echo boxTitle('shopping-cart', $lang['vip_plan']); ?>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_plan1']; ?></p>
					<input id="set_plan1" class="full_input" value="<?php echo $data['custom1']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_plan2']; ?></p>
					<input id="set_plan2" class="full_input" value="<?php echo $data['custom2']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_plan3']; ?></p>
					<input id="set_plan3" class="full_input" value="<?php echo $data['custom3']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_plan4']; ?></p>
					<input id="set_plan4" class="full_input" value="<?php echo $data['custom4']; ?>" type="text"/>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['vip_plan5']; ?></p>
					<input id="set_plan5" class="full_input" value="<?php echo $data['custom5']; ?>" type="text"/>
				</div>
				<button id="save_vip_plan" onclick="saveVip();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			</div>
			<div id="vip_manage" class="tab_zone hide_zone">
				<div class="vpad10">
					<button onclick="vipAddBox();" class="reg_button theme_btn"><i class="fa fa-plus"></i> <?php echo $lang['vip_add']; ?></button>
				</div>
				<div id="vip_search_user" class="vpad15">
					<div class="admin_search">
						<div class="admin_input bcell">
							<input class="full_input" placeholder="<?php echo $lang['search']; ?>" id="vip_user_find" type="text"/>
						</div>
						<div onclick="searchVipUser();" class="admin_search_btn default_btn">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div id="vip_paid_listing" class="tpad10">
				</div>
				<div class="centered_element vpad10 hidden">
					<p class="bold"><?php echo $lang['load_more']; ?></p>
				</div>
			</div>
			<div id="vip_transaction" class="tab_zone hide_zone">
				<div id="vip_search_transaction" class="vpad15">
					<div class="admin_search">
						<div class="admin_input bcell">
							<input class="full_input" placeholder="<?php echo $lang['search']; ?>" id="vip_find" type="text"/>
						</div>
						<div onclick="searchVip();" class="admin_search_btn default_btn">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div id="vip_transaction_list" class="vpad15">
				</div>
			</div>
			<div id="vip_help" class="tab_zone hide_zone no_rtl">
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Edit languages
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								You can edit the language of the addons in <span class="theme_color">addons / vip / language /</span> folder note that all languages are there and are
								a full copy of the Default one.<br><br>If you want for example to edit text for <?php echo $data['user_language']; ?> language then open the 
								<span class="theme_color"><?php echo $data['user_language']; ?>.php</span> edit the text
								inside with a real php editor such as notpad++ and save the file in utf8 format.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Setting up paypal api
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								First of all to be able to accept payment you will need to have a verified Paypal account.<br><br>Once you have a verified account you will need 
								to create your api id and secret from the paypal developer site. Go to <a target="_BLANK" class="theme_color" href="https://developer.paypal.com/">Paypal developer</a>
								and create your paypal api.by logging to your dashboard using your verified paypal account.<br><br>Once in the dashboard you will be able to create your REST api.
								It is important that you create a <span class="theme_color">REST</span> api and not a SOAP api. As company such as paypal update often their documentation please
							refer to paypal documentation on how to create and manage your api keys.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Managing plans
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								You can disable any plan you want by simply set the plan you want to remove to <span class="theme_color">0.00</span> or <span class="theme_color">0</span>
								once the plan is set to 0 it will not be available for purchase and will disapear from the list when the user trigger the vip box.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Special feature display
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
								The vip addons is getting special feature according to the limitation section of your admin panel example if you select to allow username color to vip and higher 
								rank then that option will be added automatically to the list of vip feature. You can also add your custom vip feature by adding them to the language file. Please 
								refer to the Edit languages to know more about adding your own special feature the instruction will be inside the language file.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Paypal mode selection
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							You can choose from 3 mode <span class="theme_color">Sandbox</span>, <span class="theme_color">Live</span> or even <span class="theme_color">Off</span>
							while you set the paypal mode to off then the paypal addons will be disabled. You can use sandbox id and secret if you need to test the addons before going live.
							The live mode is for real transaction and will send money to your paypal account. You can setup a Sandbox from your paypal dashboard from the 
							<a target="_BLANK" class="theme_color" href="https://developer.paypal.com/">Paypal developer</a>.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Transactions
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							You can search for a transaction by <span class="theme_color">order id</span>, <span class="theme_color">invoice id</span> or by <span class="theme_color">username</span> to
							retreive a specific transaction. Note that those transaction numbers are only available from your paypal account.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Transaction icons
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							There is 2 type of transaction icon the the <i class="fa fa-check-circle success"></i> mean that a transaction have ended successfully. The <i class="fa fa-exclamation-triangle warn"></i> will apear when 
							a problem occured while the process of the transaction. In the case of a faillure of the transaction you must refer to your paypal account to know more about the reason that transaction was not ended 
							successfully.
							</p>
						</div>
					</div>
				</div>
				<div class="docu_box">
					<div class="docu_head border_bottom sub_list">
						Vip manual add
					</div>
					<div class="docu_content">
						<div class="docu_description">
							<p>
							You can add manually some vip plan to a user by going in the <span class="theme_color">Add vip</span> Tab. Note that you cannot add a vip plan to a user that is already set to vip using the system vip.
							To do so you will first need to remove the vip of the specified member then aply a vip plan to his account after.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				vipWait = 0;
				saveVip = function(){
					$.post('addons/vip/system/action.php', {
						plan1: $('#set_plan1').val(),
						plan2: $('#set_plan2').val(),
						plan3: $('#set_plan3').val(),
						plan4: $('#set_plan4').val(),
						plan5: $('#set_plan5').val(),
						paypal_mode: $('#set_paypal_mode').val(),
						paypal_id: $('#set_paypal_id').val(),
						paypal_secret: $('#set_paypal_secret').val(),
						currency: $('#set_vip_currency').val(),
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
				searchVip = function(){
					$.post('addons/vip/system/action.php', {
						search_vip: $('#vip_find').val(),
						token: utk,
						}, function(response) {
							$('#vip_transaction_list').html(response);
					});	
				}
				vipAddBox = function(){
					$.post('addons/vip/system/vip_add.php', {
						token: utk,
						}, function(response) {
							showModal(response);
					});	
				}
				searchVipUser = function(){
					$.post('addons/vip/system/action.php', {
						vip_search_user: $('#vip_user_find').val(),
						token: utk,
						}, function(response) {
							$('#vip_paid_listing').html(response);
					});	
				}
				vipCancelPlan = function(vip){
					$.post('addons/vip/system/template/vip_cancel.php', {
						vip_cancel: vip,
						token: utk,
						}, function(response) {
							showModal(response,400);
					});
				}
				vipConfirmCancel = function(vip){
					$.post('addons/vip/system/action.php', {
						vip_cancel: vip,
						token: utk,
						}, function(response) {
							if(response == 1){
								hideModal();
								callSaved(system.actionComplete, 1);
								$('#pvip'+vip).remove();
							}
					});
				}
				vipLoadList = function(){
					$.post('addons/vip/system/action.php', {
						vip_load_list: 1,
						token: utk,
						}, function(response) {
							$('#vip_user_find').val('');
							$('#vip_paid_listing').html(response);
					});
				}
				vipLoadTransaction = function(){
					$.post('addons/vip/system/action.php', {
						load_transaction: 1,
						token: utk,
						}, function(response) {
							$('#vip_find').val('');
							$('#vip_transaction_list').html(response);
					});
				}
				vipDetails = function(id){
					$.post('addons/vip/system/vip_details.php', {
						tdetails: id,
						token: utk,
						}, function(response) {
							if(response == 0){
								callSaved(system.error, 3);
							}
							else {
								showModal(response, 500);
							}
					});	
				}
				vipWait = 0;
				addVipData = function(){
					if(vipWait == 0){
						vipWait = 1;
						$.post('addons/vip/system/action.php', {
							vip_add: 1,
							vip_user: $('#set_vip_name').val(),
							vip_plan: $('#set_vip_plan').val(),
							token: utk,
							}, function(response) {
								vipWait = 0;
								if(response == 2){
									callSaved(system.noUser, 3);
								}
								else if(response == 3){
									callSaved(system.cannotUser, 3);
								}
								else if(response.indexOf("pvip") >= 1){
									hideModal();
									callSaved(system.actionComplete, 1);
									if($('.vipuserelem:visible').length){
										$('#vip_paid_listing').prepend(response);
									}
									else {
										$('#vip_paid_listing').html(response);
									}
								}
								else {
									callSaved(system.error, 3);
								}
						});	
					}
				}
			</script>
		</div>
	</div>
</div>
