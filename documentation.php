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
$page_info = array(
	'page'=> 'admin',
	'page_load'=> 'system/pages/documentation/docu_settings.php',
	'page_menu'=> 1,
	'page_rank'=> 9,
	'page_rtl'=> 0,
	'page_nohome'=> 1,
);
require_once("system/config.php");

// loading head tag element
include('control/head_load.php');

// load page header
include('control/header.php');

// create page menu
$menu = '';
$menu .= pageMenu('documentation/docu_settings.php', 'cogs', 'Settings definition');
$menu .= pageMenu('documentation/docu_ranking.php', 'star', 'Ranking');
$menu .= pageMenu('documentation/docu_room.php', 'home', 'Rooms settings');
$menu .= pageMenu('documentation/docu_music.php', 'music', 'Music player');
$menu .= pageMenu('documentation/docu_dj.php', 'headphones', 'Dj feature');
$menu .= pageMenu('documentation/docu_action.php', 'legal', 'System action');
$menu .= pageMenu('documentation/docu_command.php', 'chevron-right', 'Commands');
$menu .= pageMenu('documentation/docu_console.php', 'terminal', 'Console commands', 11);

// load page content
echo boomTemplate('element/base_page_menu', $menu);

// close page body
include('control/body_end.php');
?>