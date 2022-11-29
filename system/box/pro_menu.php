<?php
require('../config_session.php');

if(!isset($_POST['target'], $_POST['page'])){
	echo boomCode(0);
	die();
}
$id = escape($_POST['target']);
$user = boomUserInfo($id);
if(empty($user)){
	echo boomCode(0);
	die();
}
$user['page'] = escape($_POST['page']);
$content = boomTemplate('element/pro_menu', $user);
if(empty($content)){
	$content = boomTemplate('element/pro_menu_empty');
}
echo boomCode(1, array('data'=> $content));
?>