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
	'page'=> 'home',
	'page_nohome'=> 1,
);
require_once("system/config.php");

if($chat_install != 1){
	include('builder/installer.php');
	die();
}
$chat_room = getRoomId();
if($chat_room > 0){
	$data['user_roomid'] = $chat_room;
	$page_info['page'] = 'chat';
}

// loading head tag element
include('control/head_load.php');

// loading page content
if($page['page'] == 'chat'){
	include('control/chat.php');
}
else {
	include('control/lobby.php');
}

// close page body
include('control/body_end.php');
?>