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
session_start();
$boom_access = 0;
require("database.php");
require("variable.php");
require("function.php");
require("function_2.php");
if(!checkToken() || !isset($_COOKIE[BOOM_PREFIX . 'userid']) || !isset($_COOKIE[BOOM_PREFIX . 'utk'])){
	die();
}
$mysqli = @new mysqli(BOOM_DHOST, BOOM_DUSER, BOOM_DPASS, BOOM_DNAME);
if (mysqli_connect_errno()){
	die();
}
$pass = escape($_COOKIE[BOOM_PREFIX . 'utk']);
$ident = escape($_COOKIE[BOOM_PREFIX . 'userid']);
$get_data = $mysqli->query("SELECT boom_setting.*, boom_users.* FROM boom_users, boom_setting WHERE boom_users.user_id = '$ident' AND boom_users.user_password = '$pass' AND boom_setting.id = '1'");
if($get_data->num_rows > 0){
	$data = $get_data->fetch_assoc();
	$boom_access = 1;
}
else {
	die();
}
require("language/{$data['user_language']}/language.php");
date_default_timezone_set($data['user_timezone']);
?>