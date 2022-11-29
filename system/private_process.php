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
if (isset($_POST['target']) && isset($_POST['content'])){
	if(muted()){
		die();
	}
	if(checkFlood()){
		echo 100;
		die();
	}
	$target = escape($_POST['target']);
	$content = escape($_POST['content']);
	$content = wordFilter($content, 1);
	$content = textFilter($content);

	if(!canSendPrivate($target)){
		echo 20;
		die();
	}
	else {
		echo postPrivate($data['user_id'], $target, $content, 1);
	}
}
else {
	echo 4;
}
?>