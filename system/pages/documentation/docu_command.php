<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('System commands'); ?>
<div class="page_element">
	<div class="bmargin15">
		<p class="text_med bpad10">
		The Commands
		</p>
		<p class="sub_text text_small">
		Many action can be taken very fast by using commands. The command must be typed in chat input and you must fill the specific command rank requirement in
		order to be able to use it.
		</p>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clear
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in main chat the <span class="theme_color">/clear</span> command will erase logs or clear private conversation. Note that the /clear command will
				work in main chat only for staff members.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/topic
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed followed with some text the <span class="theme_color">/topic</span> command will add a default special welcome message to the room. The topic can
				be set individually for each room. To remove a topic from a room simply use the <span class="theme_color">/topic</span> command without adding text after it.
				This will make topic empty and disabled for the specific room.
				<br/>
				<br/>
				You can use the <span class="theme_color">%user%</span> variable in the topic message this variable will be replaced by the members username.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/seen
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/seen</span> command followed by a username will tell the last time a user has been seen.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/mute
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/mute</span> command followed by a username open the mute box allowing you to kick the specific user.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/kick
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/kick</span> command followed by a username open the kick box allowing you to kick the specific user.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/ban
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/ban</span> command followed by a username open the kick box allowing you to kick the specific user.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/ignore
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/ignore</span> command followed by a username ignore the specified username account.
				Note that you cannot ignore a staff member.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearcache
		</div>
		<div class="docu_content">
			<div class="docu_description">
				If typed in the main chat input the <span class="theme_color">/clearcache</span> command will increase version files and will make people reload new files on their next refresh this command is very useful after
				you make css or jquery modification or system image edit such as logo or favicon.
			</div>
		</div>
	</div>
</div>