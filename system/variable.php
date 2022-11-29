<?php
$cody['max_reg'] = 5; 				// max registration per day per ip
$cody['max_room_name'] = 30; 		// max lenght of room name
$cody['max_description'] = 150; 	// max lenght of room description
$cody['act_time'] = 1;				// turn on off the innactivity balancer (0)off (1)on
$cody['max_room'] = 1;				// maximum room that a single user can create
$cody['reg_filter'] = 1;			// turn on off the ip registration filter (0)off (1)on
$cody['strict_guest'] = 1;			// strict guest registration mode follow system settings
$cody['max_verify'] = 3;			// maximum verification email allowed per 24 hours per user
$cody['max_report'] = 3;			// maximum active report allowed per users.
$cody['guest_per_day'] = 20;		// maximum guest account per day with same ip
$cody['guest_delay'] = 30;			// delay for wich a guest account cannot be overwrited in minutes
$cody['flood_delay'] = 15;			// minutes of mute applyed when a flood is detected
$cody['flood_limit'] = 6;			// post required within 10 sec to trigger flood protection
$cody['strip_direct'] = 0;			// set to 1 to activate direct display hard mode
$cody['default_mute'] = 5;			// default mute delay in mute box
$cody['ignore_clean'] = 30;			// ignore expire automaticly after x days 0 for never
$cody['use_geo'] = 1;				// set to 0 to disable the auto geolocalisation
$cody['default_kick'] = 5;			// default kick delay in kick box
$cody['rbreak'] = 900;				// right chat panel mobile breakpoint in pixel
$cody['lbreak'] = 1260;				// left chat panel mobile breakpoint in pixel
$cody['right_size'] = 280;			// default right panel size in pixel
$cody['left_size'] = 150;			// default left panel size in pixel
$cody['report_history'] = 100;		// max log history private report will show
$cody['card_cover'] = 1;			// display card cover set 0 to disable or 1 to enable

/* permission settings */

$cody['can_flood'] = 8;				// rank that is not affected by the mute protection.
$cody['can_word_filter'] = 10;		// rank required to not be affected by word filter
$cody['can_post_news'] = 11;		// rank required to post news
$cody['can_delete_news'] = 11;		// rank required to delete news post
$cody['can_reply_news'] = 1;		// rank required to reply to news
$cody['can_delete_wall'] = 8;		// rank required to delete wall post
$cody['can_delete_logs'] = 8;		// rank required to delete chat post
$cody['can_delete_slogs'] = 1;		// rank required to delete self posted chat log
$cody['can_invisible'] = 9;			// rank required to have invisibility option
$cody['can_inv_view'] = 11;			// rank required to view invisible in admin panel
$cody['can_modify_avatar'] = 8;		// rank required to modify users avatar
$cody['can_modify_cover'] = 8;		// rank required to modify users cover
$cody['can_modify_name'] = 9;		// rank required to modify users username
$cody['can_modify_mood'] = 8;		// rank required to modify users mood
$cody['can_modify_about'] = 8;		// rank required to modify users about me
$cody['can_modify_email'] = 10;		// rank required to modify users email
$cody['can_modify_color'] = 10;		// rank required to modify users color
$cody['can_modify_password'] = 10;	// rank required to modify users password
$cody['can_view_history'] = 8;		// rank required to view users action history
$cody['can_view_console'] = 10;		// rank required to access console in admin panel
$cody['can_clear_console'] = 11;	// rank required to clear the admin console log
$cody['can_view_email'] = 10;		// rank required to view users email
$cody['can_view_timezone'] = 10;	// rank required to view users timezone
$cody['can_view_id'] = 10;			// rank required to view users id
$cody['can_view_ip'] = 10;			// rank required to view users ip
$cody['can_room_pass'] = 8;			// rank required to enter room without pass
$cody['can_rank'] = 10;				// rank required to change rank of members do not go bellow 11, 10 or 9
$cody['can_ban'] = 9;				// rank required to have ban power
$cody['can_kick'] = 8;				// rank required to have kick power
$cody['can_delete'] = 10;			// rank required to have delete power
$cody['can_report'] = 1;			// rank required to have report ability
$cody['can_maintenance'] = 8;		// rank required to enter chat while in maintenance mode
$cody['can_manage_addons'] = 11;	// rank required to install, config and uninstall addons
$cody['can_edit_info'] = 0;			// rank required to edit general profile information
$cody['can_edit_about'] = 0;		// rank required to edit profile about
$cody['can_manage_report'] = 8;		// rank required to view and manage report
$cody['can_self_report'] = 10;		// rank required to remove a self involved report
$cody['can_manage_history'] = 10;	// rank required to manage profile history
$cody['can_delete_private'] = 1;	// rank required to delete private chat
$cody['can_clear_room'] = 11;		// rank required to have /clear room ability

/* system log messages */

$cody['join_room'] = 1;				// show log when entering room 0 disabled 1 enabled
$cody['leave_room'] = 1;			// show log when leaving room 0 disabled 1 enabled
$cody['name_change'] = 1;			// show log when change username 0 disabled 1 enabled
$cody['action_log'] = 1;			// show log when an action is taken 0 disabled 1 enabled

/* color count in the system */

$cody['color_count'] = 32;			// number of color used and defined in css
$cody['gradient_count'] = 40;		// number of gradient used and defined in css
$cody['neon_count'] = 32;			// number of gradient used and defined in css
			
/* misc */

$cody['audio_download'] = 0;        // show download button for uploaded audio
$cody['clean_delay'] = 5;			// delay for system cleaning in minutes

// cookie and session settings

define('BOOM_PREFIX', 'bc_');

// do not edit function below they are very important for the system to work properly

define('BOOM', 1);
define('BOOM_PATH', dirname(__DIR__));

define('BOOM_DHOST', $DB_HOST);
define('BOOM_DNAME', $DB_NAME);
define('BOOM_DUSER', $DB_USER);
define('BOOM_DPASS', $DB_PASS);
define('BOOM_CRYPT', $encryption);

function setBoomCookie($i, $p){
	setcookie(BOOM_PREFIX . "userid","$i",time()+ 31556926, '/');
	setcookie(BOOM_PREFIX . "utk","$p",time()+ 31556926, '/');
}
function unsetBoomCookie(){
	setcookie(BOOM_PREFIX . "userid","",time() - 1000, '/');
	setcookie(BOOM_PREFIX . "utk","",time() - 1000, '/');
}
function setBoomLang($val){
	setcookie(BOOM_PREFIX . "lang","$val",time()+ 31556926, '/');
}
function setBoomCookieLaw(){
	setcookie(BOOM_PREFIX . "claw","1",time()+ 31556926, '/');
}
?>