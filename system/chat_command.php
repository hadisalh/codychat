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
require_once("config_session.php");

if (!isset($_POST['content'], $_POST['snum'])){
	echo boomCode(99);
}
if(isTooLong($_POST['content'], $data['max_main'])){
	echo boomCode(99);
	die();
}
if(muted() || roomMuted()){
	echo boomCode(99);
	die();
}
if(checkFlood()){
	echo boomCode(100);
	die();
}

$snum = escape($_POST['snum']);
$content = escape($_POST['content']);
$content = wordFilter($content, 1);
$content = textFilter($content);
$command = explode(' ',trim($content));

if(empty($content) && $content !== '0' || !inRoom()){
	echo boomCode(4);
	die();
}

if(substr($command[0], 0, 1) !== '/'){
	echo boomCode(200);
	die();
}
else if( $command[0] == '/console'){
	echo boomCode(10);
	die();
}
else if( $command[0] == '/monitor'){
	echo boomCode(11);
	die();
}
else if( $command[0] == '/clean'){
	echo boomCode(12);
	die();
}	
else if( $command[0] == '/topic' && (boomAllow(8) || boomRole(5)) ){
	$topic = trimCommand($content, '/topic');
	changeTopic($topic, $data['user_roomid']);
	$room = boomRoomData($data['user_roomid']);
	if(!empty($room)){
		echo boomCode(14, array('data'=> getTopic($room['topic'])));
	}
	else {
		echo boomCode(4);
	}
	die();
}
else if( $command[0] == '/mute' && canMute()){
	$mute = trimCommand($content, '/mute');
	$user = nameDetails($mute);
	if(empty($user)){
		echo boomCode(3);
		die();
	}
	if(!canMuteUser($user)){
		echo boomCode(0);
		die();
	}
	echo boomCode(300, array('data'=> $user['user_id']));
	die();
}
else if( $command[0] == '/kick' && canKick()){
	$kick = trimCommand($content, '/kick');
	$user = nameDetails($kick);
	if(empty($user)){
		echo boomCode(3);
		die();
	}
	if(!canKickUser($user)){
		echo boomCode(0);
		die();
	}
	echo boomCode(400, array('data'=> $user['user_id']));
	die();
}
else if( $command[0] == '/ban' && canBan()){
	$ban = trimCommand($content, '/ban');
	$user = nameDetails($ban);
	if(empty($user)){
		echo boomCode(3);
		die();
	}
	if(!canBanUser($user)){
		echo boomCode(0);
		die();
	}
	echo boomCode(500, array('data'=> $user['user_id']));
	die();
}
else if( $command[0] == '/ignore'){
	$toignore = trimCommand($content, '/ignore');
	$user = nameDetails($toignore);
	$code = ignore($user['user_id']);
	echo boomCode($code);
	die();
}
elseif ( $command[0] == '/clear' && canClearRoom()){
	clearRoom($data['user_roomid']);
	echo boomCode(99);
	die();
}
else if ( $command[0] == '/seen'){
	$search = trimCommand($content, '/seen');
	$result = userSeen($search);
	$log = systemSpecial($result, 'seen', array('icon'=> 'seen.svg', 'title'=> $lang['seen_title']));
	echo boomCode(1000, array('data'=> $log));
	die();
}
else if($command[0] == '/clearcache' && boomAllow(11)){
	boomCacheUpdate();
	echo boomCode(1);
	die();
}
else if($command[0] == '/onair' && userDj($data)){
	$code = setOnAir($data);
	echo boomCode($code);
	die();
}
else if($command[0] == '/offair' && userDj($data)){
	$code = setOffAir($data);
	echo boomCode($code);
	die();
}
else if($command[0] == '/removeonair' && boomAllow(10)){
	$target = trimCommand($content, '/removeonair');
	$user = nameDetails($target);
	$code = removeOnair($user['user_id']);
	echo boomCode($code);
	die();
}
else if($command[0] == '/setonair' && boomAllow(10)){
	$target = trimCommand($content, '/setonair');
	$user = nameDetails($target);
	$code = addOnair($user['user_id']);
	echo boomCode($code);
	die();
}
else if($command[0] == '/setdj' && boomAllow(10)){
	$target = trimCommand($content, '/setdj');
	$user = nameDetails($target);
	$code = makeDj($user['user_id']);
	echo boomCode($code);
	die();
}
else if($command[0] == '/removedj' && boomAllow(10)){
	$target = trimCommand($content, '/removedj');
	$user = nameDetails($target);
	$code = removeDj($user['user_id']);
	echo boomCode($code);
	die();
}
else {
	echo boomCode(200);
	die();
}
?>