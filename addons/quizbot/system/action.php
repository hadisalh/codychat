<?php
$load_addons = 'quizbot';
require('../../../system/config_addons.php');
if(!boomAllow($cody['can_manage_addons'])){
	die();
}
if(isset($_POST['room'], $_POST['status'], $_POST['type'], $_POST['quiz_file'], $_POST['scramble_file'])){
	
	$status = escape($_POST['status']);
	$room = escape($_POST['room']);
	$type = escape($_POST['type']);
	$quiz_file = escape($_POST['quiz_file']);
	$scramble_file = escape($_POST['scramble_file']);
	
	$mysqli->query("UPDATE boom_addons SET custom1 = '$room', custom2 = '$status', custom3 = '$type', custom4 = '$quiz_file', custom5 = '$scramble_file' WHERE addons = '$load_addons'");
	echo 5;
	die();
}
if(isset($_POST['reset_score']) && boomAllow($cody['can_manage_addons'])){
	$mysqli->query("UPDATE boom_users SET quiz_score = '0' WHERE user_id > 0");
	echo 1;
	die();
}
?>