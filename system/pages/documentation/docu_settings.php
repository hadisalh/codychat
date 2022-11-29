<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('Settings definition'); ?>
<div class="page_element">
	<div class="docu_box">
		<div class="docu_head sub_list">
			Main options
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Index path
			</div>
			<div class="docu_description">
				Index path is the most important setting of the chat it must be 
				the absolute path to your current chat. Index path must <span class="theme_color">not</span>
				end with a /.
			</div>
			<div class="docu_title">
				Site title
			</div>
			<div class="docu_description">
				Name of your site that will be displayed on the browser tab.
			</div>
			<div class="docu_title">
				Site description
			</div>
			<div class="docu_description">
				Here you can add your site description this will add description of
				your site in the head tag of each pages.
			</div>
			<div class="docu_title">
				Site keyword
			</div>
			<div class="docu_description">
				Keyword of your site must be added and separated by 
				a coma ex : chat, room, chatroom, mobile...
			</div>
			<div class="docu_title">
				Site timezone
			</div>
			<div class="docu_description">
				Define the current timezone selection for displaying current time in chat
			</div>
			<div class="docu_title">
				Default language
			</div>
			<div class="docu_description">
				Define the default system language.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Registration options
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Bridge login
			</div>
			<div class="docu_description">
				That option is only turned on when you want to use a bridge to login using other
				cms like wordpress, drupal etc... Note that you need to install the bridge first
				to be able to activate that function. Check on Bcaccess for available bridge.
			</div>
			<div class="docu_title">
				Allow new registration
			</div>
			<div class="docu_description">
				Turn on and off site registration if turned off a message will
				be displayed to visitor that registration are closed.
			</div>
			<div class="docu_title">
				Mute new account
			</div>
			<div class="docu_description">
				If turned on this option will mute all new registered guest or member for the given time
				once the time is done the system will automaticly remove the registration mute on the new member.
			</div>
			<div class="docu_title">
				Ask for verification
			</div>
			<div class="docu_description">
				If turned on this option will ask to all new members
				to verify their account before they will be able to enter the system.
			</div>
			<div class="docu_title">
				Max registration per day
			</div>
			<div class="docu_description">
				Define the maximum registration that the same ip can do in the system
				per 24 hours period.
			</div>
			<div class="docu_title">
				Allow duplicate email registration
			</div>
			<div class="docu_description">
				Allow or not registration with same email. If turned off only 1 account 
				can register per email.
			</div>
			<div class="docu_title">
				Max username length
			</div>
			<div class="docu_description">
				Define the maximum characters allowed to username when a new member register
				to the system.
			</div>
			<div class="docu_title">
				Minimum age to register
			</div>
			<div class="docu_description">
				Define the minimum age required to register to the system.
			</div>
			<div class="docu_title">
				Allow guest
			</div>
			<div class="docu_description">
				Allow member to use the guest login to enter chat. Note that
				guest can bring lot of problem due to vpn or other tool used
				for changing ip. When this option is turned off the system will
				automaticly delete all guest members from the database.
			</div>
			<div class="docu_title">
				Guest extended form
			</div>
			<div class="docu_description">
				If turned on the system will require guest to choose gender and age on the login.
			</div>
			<div class="docu_title">
				Allow guest talk in chat
			</div>
			<div class="docu_description">
				Turned on this option will allow guest to enter the chat but will prevent them to talk. Guest will be in view mode only.
			</div>
			<div class="docu_title">
				Activate facebook login
			</div>
			<div class="docu_description">
				If turned on the facebook login button will apear in the login 
				form and registration form. ( require to make a facebook app )
			</div>
			<div class="docu_title">
				Facebook app id
			</div>
			<div class="docu_description">
				Field where you insert your Facebook app id that you have created.
			</div>
			<div class="docu_title">
				Facebook app secret
			</div>
			<div class="docu_description">
				Field where you insert your Facebook app secret that you have created.
			</div>
			<div class="docu_title">
				Google recaptcha
			</div>
			<div class="docu_description">
				To activate google recaptcha you need to create your recaptcha api key <a href="https://www.google.com/recaptcha/intro/v3beta.html" class="theme_color">here</a> you need to set your api key to 
				recaptcha version 2.0 and not 3.0 this is important.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Display options
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Default theme
			</div>
			<div class="docu_description">
				Define the default system theme.
			</div>
			<div class="docu_title">
				Login page style
			</div>
			<div class="docu_description">
				Define the template used as login page
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Email settings
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Mail system type
			</div>
			<div class="docu_description">
				You can select mail or smtp the mail function will use the basic mail() php function
				and the smtp will use smtp mail connection. Important to note that some
				vps and shared host may block the smtp function on their server to prevent spamming
				and keep their reputation. If the smtp is not working for you please contact your
				host provider and make sure they unlock the smtp protocol for you. Note that 
				we do not modify or support server side settings.
			</div>
			<div class="docu_title">
				Site email
			</div>
			<div class="docu_description">
				Email adress that will show in email as sender.
				Note that site email can be overwrited by the smtp server email.
			</div>
			<div class="docu_title">
				Sender name
			</div>
			<div class="docu_description">
				Name from who the email is coming from.
			</div>
			<div class="docu_title">
				Smtp host
			</div>
			<div class="docu_description">
				Smtp host server adress.
			</div>
			<div class="docu_title">
				Smtp username
			</div>
			<div class="docu_description">
				Smtp username to connect to smtp server.
			</div>
			<div class="docu_title">
				smtp password
			</div>
			<div class="docu_description">
				Password of smtp to connect to smtp server
			</div>
			<div class="docu_title">
				Smtp port
			</div>
			<div class="docu_description">
				Port to connect to your smtp server.
			</div>
			<div class="docu_title">
				Smtp encryption
			</div>
			<div class="docu_description">
				Smtp encryption type can be ssl or tls that refer to your smtp server.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Upload & database
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Max avatar size allowed
			</div>
			<div class="docu_description">
				Define maximum size of file allowed when uploading avatar. 
				This value must not exceed upload value from dashboard system info.
			</div>
			<div class="docu_title">
				Max file size allowed
			</div>
			<div class="docu_description">
				Define maximum file size that a user can upload. 
				this value must not exceed upload value from dashboard system info.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Delays settings
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Disconnect innactive members
			</div>
			<div class="docu_title">
				Chat logs delete
			</div>
			<div class="docu_description">
				Define the time before a main chat post get deleted from the database.
				It is strongly recommended to keep this value to 7 days or lower to increase
				chat performance.
			</div>
			<div class="docu_title">
				Private logs delete
			</div>
			<div class="docu_description">
				Define the time before a private chat post get deleted from the database. It is strongly
				recommended to keep this value to 7 days or lower to increase chat performance.
			</div>
			<div class="docu_title">
				Wall logs delete
			</div>
			<div class="docu_description">
				Define the time before a wall post post get deleted from the database. It is strongly
				recommended to keep this value to 180 days or lower to increase chat performance.
			</div>
			<div class="docu_title">
				Delete innactive user
			</div>
			<div class="docu_description">
				Define the time for an innactive account to be deleted by the system. Once an account is deleted all
				data related to that account is erased and cannot be recovered. Select never if you wish to not delete
				innactive members account automaticly.
			</div>
			<div class="docu_title">
				Innactive room deletion
			</div>
			<div class="docu_description">
				Define the time for an innactive room to be deleted by the system. This feature will only affect rooms created
				by members and will not affect rooms created by owners. Select never if you wish to not delete innactive rooms
				automatically.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Chat options
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Display system logs
			</div>
			<div class="docu_description">
				If turned on this option will show message when user enter or leave room.
			</div>
			<div class="docu_title">
				Show rank icons
			</div>
			<div class="docu_description">
				If turned on this option display ranking icons in the userlist.
			</div>
			<div class="docu_title">
				Show avatar gender
			</div>
			<div class="docu_description">
				If turned on this option display a gender color border around the avatar.
			</div>
			<div class="docu_title">
				Show userlist flags
			</div>
			<div class="docu_description">
				If turned on this option display country flags in the userlist. This apply only if the member have selected a country in
				his / her profile.
			</div>
			<div class="docu_title">
				Main chat max character
			</div>
			<div class="docu_description">
				Maximum allowed character per post in main chat box.
			</div>
			<div class="docu_title">
				Private chat max character
			</div>
			<div class="docu_description">
				Maximum allowed character per post in private box.
			</div>
			<div class="docu_title">
				Display offline users
			</div>
			<div class="docu_description">
				If turned on this feature will display a offline and online list of users in room.
				if no offline users the list will not apear.
			</div>
			<div class="docu_title">
				Chat refresh delay
			</div>
			<div class="docu_description">
				Lower this value is faster the chat refresh but higher is the server usage
				. 3000 - 3500 are recommended settings. Note that lowering that value under
				3000 will not make chat faster if your server is not capable of such speed and will
				create the oposite effect as expected.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Limits options
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Allow avatar
			</div>
			<div class="docu_description">
				Define rank required for a member to be able to upload an avatar in chat.
			</div>
			<div class="docu_title">
				Allow profile cover
			</div>
			<div class="docu_description">
				Define rank to add a profile cover to the account.
			</div>
			<div class="docu_title">
				Allow animated cover
			</div>
			<div class="docu_description">
				Define rank required to add a animated cover to the account note that
				this setting depend of the Allow profile cover setting. This setting cannot
				be set lower than private cover permission.
			</div>
			<div class="docu_title">
				Allow chat upload
			</div>
			<div class="docu_description">
				Define required rank to be able to access upload feature in main chat.
			</div>
			<div class="docu_title">
				Allow private upload
			</div>
			<div class="docu_description">
				Define required rank to be able to access upload feature in private chat.
			</div>
			<div class="docu_title">
				Allow wall upload
			</div>
			<div class="docu_description">
				Define required rank to be able to access upload feature in wall.
			</div>
			<div class="docu_title">
				Allow username change
			</div>
			<div class="docu_description">
				Define rank required for a member to be able to change his username in system.
			</div>
			<div class="docu_title">
				Allow mood
			</div>
			<div class="docu_description">
				Define rank required for a member to be able to set a mood under their name in profile and userlist.
			</div>
			<div class="docu_title">
				Allow account verification
			</div>
			<div class="docu_description">
				Define the rank required to auto verify their account. Set this option to owner if you do not wish to
				use the manual verification system inside the profile.
			</div>
			<div class="docu_title">
				Allow special emoticon
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to access and use special emoticon set.
			</div>
			<div class="docu_title">
				Allow username color
			</div>
			<div class="docu_description">
				Define rank required to choose username color. Set this option to owner if you do not wish other to choose their own color.
			</div>
			<div class="docu_title">
				Allow username gradient
			</div>
			<div class="docu_description">
				Define rank required to choose username gradient.
			</div>
			<div class="docu_title">
				Allow neon username
			</div>
			<div class="docu_description">
				Define rank required to choose neon color for username.
			</div>
			<div class="docu_title">
				Allow text color
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to use text color in chat.
			</div>
			<div class="docu_title">
				Allow text gradient
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to use text gradient in chat.
			</div>
			<div class="docu_title">
				Allow neon text
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to use neon text color in chat.
			</div>
			<div class="docu_title">
				Allow direct display
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to post image and embed youtube directly to chat.
				otherwise their link will show only as plain text.
			</div>
			<div class="docu_title">
				Allow room creation
			</div>
			<div class="docu_description">
				Define required rank to be able to create room in the system.
			</div>
			<div class="docu_title">
				Allow users themes
			</div>
			<div class="docu_description">
				Define required rank to be able to select own theme. this setting only affect room display.
			</div>
			<div class="docu_title">
				Allow history in chat
			</div>
			<div class="docu_description">
				Define required rank for a member to be able to scroll the chat to top and view history.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Filters
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Action
			</div>
			<div class="docu_description">
				Define the default action to take on a specified filter.
			</div>
			<div class="docu_title">
				Duration
			</div>
			<div class="docu_description">
				Define the duration of the selected action of filter.
			</div>
			<div class="docu_title">
				Add word to filter
			</div>
			<div class="docu_description">
				Add a badword to the wordfilter. it will filter both private and main chat.
			</div>
			<div class="docu_title">
				Add word to name filter
			</div>
			<div class="docu_description">
				The name filter allow you to prevent users to register or change their name with certain word in. Example if you want to prevent members to use the word <span class="theme_color">shit</span>
				in their usename then add it to the filter. The filter is case unsensitive so you do not need to add <span class="theme_color">SHIT</span> and <span class="theme_color">shit</span> ... both 
				are covered by the filter no need to repeat them.
			</div>
			<div class="docu_title">
				Add text to spam filter
			</div>
			<div class="docu_description">
				Its important to do not mix spam filter and word filter. The spam filter is used for more complex word such as url or spam. Example
				if you want to block a url in the chat <span class="theme_color">www.google.com</span> you can add in spam filter <span class="theme_color">google.com</span> in the spam filter. Spam filter will 
				see some variant of the filter even if the user put space or use capital or lowercase letters example if a user type
				<span class="theme_color">w w w . G o O g L e . C o M</span> the spam filter will still detect it and aply the action.
			</div>
			<div class="docu_title">
				Add provider to email filter
			</div>
			<div class="docu_description">
				The email filter is a very powerfull tool that allow you to add in filter a list of all email provider that you accept for registration. Example if you only add <span class="theme_color">gmail</span> to 
				the filter then no email other than gmail email will be accepted for new registration. When you add provider to filter do not repeat or add anything else than the name of the provider. Example if you 
				want to add <span class="theme_color">hotmail</span> then in the filter simply add <span class="theme_color">hotmail</span>... This will cover all possible email from hotmail such as 
				<span class="theme_color">hotmail.com, hotmail.fr, hotmail.uk...</span>. Never add the @ before the provider added. You can reset email filter please read console section to know more about how to do.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Player settings
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Default stream player
			</div>
			<div class="docu_description">
				Define the default player stream station when creating a room. If set to no default this will
				hide the player.
			</div>
			<div class="docu_title">
				Stream alias
			</div>
			<div class="docu_description">
				Name of stream that will be visible in the player.
			</div>
			<div class="docu_title">
				Stream url
			</div>
			<div class="docu_description">
				Url of the stream source. Note that this must be a sound source and not a website that contain a source.
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			Manage modules
		</div>
		<div class="docu_content">
			<div class="docu_title">
				Room lobby
			</div>
			<div class="docu_description">
				If activated this feature will show a room list page before the member enter the chat.
			</div>
			<div class="docu_title">
				Wall system
			</div>
			<div class="docu_description">
				If activated this module will allow the friend wall system. Turn off if you wish to not use the friend wall system.
			</div>
			<div class="docu_title">
				Cookie law
			</div>
			<div class="docu_description">
				This module will ask the visitor to agree to your site privacy policy in order for you to be in regulation with the GDPR.
			</div>
		</div>
	</div>
</div>