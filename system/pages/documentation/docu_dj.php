<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('Dj feature'); ?>
<div class="page_element">
	<div class="bmargin15">
		<p class="text_med bpad10">
		Dj feature controls
		</p>
		<p class="sub_text text_small">
		This feature is controled only by command and allow you to set members account as dj and allow them to show on top of the userlist as onair dj. Bellow you
		can see all available commands for the dj feature.
		</p>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/setdj
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Super admin and owner can use this command followed by a username to give dj previlege to a member. Once set to 
				dj the member can then use /onair and /offair commands.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/removedj
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Super admin and owner can use this command followed by a username to remove the dj previleges of a member.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/setonair
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Super admins and owner can use this command followed by a username to set a dj to onair.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/removeonair
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Super admins and owner can use this command followed by a username to set a dj to offair.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/onair
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Every dj can type this command in main chat to set his / her current dj status to onair. His / her name will then
				apear on top of userlist in onair dj's section.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/offair
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Every dj can type this command in main chat to remove his current onair status.
			</div>
		</div>
	</div>
</div>