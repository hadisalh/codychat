<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('System action'); ?>
<div class="page_element">
	<div class="docu_box">
		<div class="docu_head sub_list">
			Mute
		</div>
		<div class="docu_content">
			<div class="docu_description">
				The mute option is preventing people to talk in both private and main chat in the entire chat it can be removed with the unmute action.
				when a user is muted the <span class="error"><i class="fa fa-microphone-slash"></i></span> icon will apear on side of his / her username in the list.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Kick
		</div>
		<div class="docu_content">
			<div class="docu_description">
				This feature allow you to kick a user out of chat for up to 72 hours. If you need more than 72 hours then please use the ban feature. Once kicked you will be prompt
				to specify a reason for the kick ( optional ). The member will then see a kick page and a timer. Once the timer will reach 0 the page will automatically refresh and 
				bring back the user in the chat.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Unmute
		</div>
		<div class="docu_content">
			<div class="docu_description">
				This action remove the current mute from a member already muted.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Room mute
		</div>
		<div class="docu_content">
			<div class="docu_description">
				This action prevent the member to talk in specific room where the action has been set. again when a user is muted from a specific room when he / she enter the room
				a <span class="warn"><i class="fa fa-microphone-slash"></i></span> will apear on side of his / her name in the userlist.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Room block
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Room block prevent a user to enter a specific room when this action is set to a user he / she will not be able to join the room where the action has been set.
				<br/>
				<span class="theme_color">Note that you cannot block a user from the main room as it is the landing room of the system.</span>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Ban
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Block the ip and the account of the specified user to enter the site.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Unban
		</div>
		<div class="docu_content">
			<div class="docu_description">
				Remove ip from banned ip and also unblock the specified user account and allow the members to came back to the site.
			</div>
		</div>
	</div>
</div>