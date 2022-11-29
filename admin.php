<?php
/**
* Codychat
*
* @package Codychat
* @author www.boomcoding.com
* @copyright 2020
* @terms any use of this script without a legal license is prohibited
* all the content of Codychat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
require_once("system/config.php");

$page_info = array(
	'page'=> 'admin',
	'page_load'=> 'system/pages/admin/setting_dashboard.php',
	'page_menu'=> 1,
	'page_rank'=> 8,
	'page_nohome'=> 1,
);

// loading head tag element
include('control/head_load.php');

// load page header
include('control/header.php');

// create page menu
$side_menu  = '';
$side_menu .= pageMenu('admin/setting_dashboard.php', 'tachometer', $lang['dashboard'], 8);

// menu drop 1
	$drop1  = pageDropItem('admin/setting_main.php', $lang['main_settings'], 11);
	$drop1 .= pageDropItem('admin/setting_registration.php', $lang['registration_settings'], 10);
	$drop1 .= pageDropItem('admin/setting_display.php', $lang['display_settings'], 11);
	$drop1 .= pageDropItem('admin/setting_email.php', $lang['email_settings'], 11);
	$drop1 .= pageDropItem('admin/setting_data.php', $lang['database_management'], 10);
	$drop1 .= pageDropItem('admin/setting_delays.php', $lang['delay_settings'], 10);
$side_menu .= pageDropMenu('cogs', $lang['system_config'], $drop1, 10);

$side_menu .= pageMenu('admin/setting_members.php', 'users', $lang['users_management'], 8);
$side_menu .= pageMenu('admin/setting_action.php', 'legal', $lang['manage_action'], 8);
$side_menu .= pageMenu('admin/setting_chat.php', 'comment', $lang['chat_settings'], 10);
$side_menu .= pageMenu('admin/setting_rooms.php', 'home', $lang['room_management'], 10);

// menu drop 2
	$drop2  = pageDropItem('admin/setting_filter.php', $lang['filter'], 9);
	$drop2 .= pageDropItem('admin/setting_ip.php', $lang['ban_management'], 9);
	$drop2 .= pageDropItem('admin/setting_console.php', $lang['system_logs'], $cody['can_view_console']);
	$drop2 .= pageDropItem('admin/setting_info.php', $lang['system_diagnostic'], 11);
$side_menu .= pageDropMenu('wrench', $lang['system_tools'], $drop2, min(9,$cody['can_view_console']));

$side_menu .= pageMenu('admin/setting_limit.php', 'filter', $lang['limit_management'], 10);
$side_menu .= pageMenu('admin/setting_player.php', 'music', $lang['player_settings'], 10);
$side_menu .= pageMenu('admin/setting_modules.php', 'cubes', $lang['manage_modules'], 10);
$side_menu .= pageMenu('admin/setting_addons.php', 'puzzle-piece', $lang['addons_management'], $cody['can_manage_addons']);
$side_menu .= pageMenu('admin/setting_pages.php', 'file-text', $lang['page'], 11);
$side_menu .= pageMenu('admin/setting_update.php', 'cloud-download', $lang['update_zone'], 11);

$side_menu .= pageMenuFunction("openLinkPage('documentation.php');", 'book', $lang['manual'], 9);

// load page content
echo boomTemplate('element/base_page_menu', $side_menu);
 ?>
 <!-- load page script -->
<script data-cfasync="false" src="js/function_admin.js<?php echo $bbfv; ?>"></script>
<?php
// close page body
include('control/body_end.php');
?>

