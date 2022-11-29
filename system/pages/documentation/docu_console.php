<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('Console commands'); ?>
<div class="page_element">
	<div class="bmargin15">
		<p class="text_med bpad10">
		The Console
		</p>
		<p class="sub_text text_small">
		You can open the system console by typing <span class="theme_color bold">/console</span> in the main chat input. 
		Or you can also open the console by doing <span class="theme_color bold">Ctrl + alt + backspace</span> on your keyboard. Once the 
		console is open use one of the following command to achieve some database modification. Note that you should never delete 
		content from the database manually to prevent any system faillures.
		</p>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearprivate
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearprivate</span> will reset all private
				and clear all private message from the database. Note that this command cannot be reverted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearnotification
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearnotification</span> will reset all notification
				and clear all notification from the database. Note that this command cannot be reverted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearchat
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearchat</span> will clear all chat messages from the database.
				this will affect all rooms. Note that this command cannot be reverted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearnews
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearnews</span> will clear all news from the database.
				Note that this command cannot be reverted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearwall
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearwall</span> will reset all wall component including
				wall comment and wall likes and dislike. Note that this command cannot be reverted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearreport
		</div>
		<div class="docu_content">
			<div class="docu_description">
				When typed in the console the command <span class="theme_color bold">/clearreport</span> will clear all reports from the database.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/resetterms
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console the  <span class="theme_color bold">/resetterms</span> command will set back terms page
				to the initial state. This command is usefull to recover initial terms file in case you make mistake by 
				editing it.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/resetprivacy
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console the  <span class="theme_color bold">/resetprivacy</span> command will set back privacy page
				to the initial state. This command is usefull to recover initial privacy file in case you make mistake by 
				editing it.			
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/resethelp
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console the  <span class="theme_color bold">/resethelp</span> command will set back help page
				to the initial state. This command is usefull to recover initial help file in case you make mistake by 
				editing it.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/makevisible
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console the <span class="theme_color bold">/makevisible</span> command will remove invisibility to
				all members that are not full chat owner.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/clearcache
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console <span class="theme_color bold">/clearcache</span> command will increase version files and will make people reload new files on their next refresh this command is very useful after
				you make css or jquery modification or system image edit such as logo or favicon.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/removelanguage
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<p>Once typed in the console <span class="theme_color bold">/removelanguage</span> command followed by a specific language name will set default system language to all users that use the specific language this will
				then allow you to remove the language from the chat core. Note that you cannot remove the default language selected in your settings.
				</p>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/removetheme
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<p>
				Once typed in the console <span class="theme_color bold">/removetheme</span> command followed by a specific theme name will set default system theme to all users that use the specific theme this will
				then allow you to remove the theme from the chat core. Note that you cannot remove the default theme selected in your settings.
				</p>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/resetemailfilter
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<p>
				Once typed in the console <span class="theme_color bold">/resetemailfilter</span> all element from the email filter will be removed and replaced by the default list that include 100 predefined most used and 
				trusted email provider.
				</p>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/makefullowner
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<p>
				Once typed in the console <span class="theme_color bold">/makefullowner</span> command followed by a username will make that user owner as same as you. It is important to know that for security and integrity purpose
				there is no command to reverse this action then to remove the rank of a owner the only way to do it is from the database. Be carefull when giving this rank you should always have full trust in the member you will
				set owner.
				</p>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/stylereset
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console <span class="theme_color bold">/stylereset</span> command will reset to default all users font and colors that do not meet the limitation. Use this command in case
				you wish to globally reconfigure the already set fonts and colors after modifying the limitation displays options.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/moodreset
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console <span class="theme_color bold">/moodreset</span> command will reset to default all moods that do not meet the mood limitation.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			/themereset
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Once typed in the console <span class="theme_color bold">/themereset</span> command will reset to default all users theme that do not meet the themes limitation.
			</div>
		</div>
	</div>
</div>