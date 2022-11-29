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
if (isset($_POST["remail"])){
	require_once(__DIR__ . "/config.php");
	
	$email = escape($_POST['remail']);
	
	if(!isEmail($email)){
		echo 3;
		die();
	}
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_email = '$email' AND user_bot = 0 LIMIT 1");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
		echo resetUserPass($user);
		die();
	}
	else {
		echo 2;
		die();
	}
}
else {
	echo 99;
	die();
}
?>