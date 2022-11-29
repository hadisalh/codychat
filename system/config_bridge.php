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
$boom_access = 0;
require("database.php");
require("variable.php");
require("function_bridge.php");
$bmysqli = @new mysqli(BOOM_DHOST, BOOM_DUSER, BOOM_DPASS, BOOM_DNAME);
if (mysqli_connect_errno() || $check_install != 1) {
	die();
}
else{
	$bget_data = $bmysqli->query("SELECT boom_setting.* FROM boom_setting WHERE boom_setting.id = '1'");
	if($bget_data->num_rows > 0){
		$bdata = $bget_data->fetch_assoc();
		$boom_version = bridgeVersion();
		$boom_access = 1;
	}
	else {
		die();
	}
}
date_default_timezone_set("{$bdata['timezone']}");
?>