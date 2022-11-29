<?php
$load_addons = 'vip';
require_once('../../../system/config_addons.php');

function vipRecover(){
	global $mysqli, $data;
	if($data['vip_end'] > time() && boomAllow(1) && !boomAllow(2)){
		$mysqli->query("UPDATE boom_users SET user_rank = 2 WHERE user_id = '{$data['user_id']}'");
		return 1;
	}
	else {
		return 0;
	}
}
if(isset($_POST['vip_recover']) && boomAllow(1)){
	echo vipRecover();
	die();
}
?>