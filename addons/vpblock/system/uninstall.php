<?php
if(!defined('BOOM')){
	die();
}
$mysqli->query("ALTER TABLE `boom_users` DROP `user_vpblock`");
$mysqli->query("DROP TABLE boom_vpblock");
?>