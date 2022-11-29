<?php
if(!defined('BOOM')){
	die();
}
function vpblockInstall(){
	global $mysqli, $data;
	$mysqli->query("ALTER TABLE `boom_users` ADD user_vpblock int(1) NOT NULL DEFAULT '1'");
	$mysqli->query("CREATE TABLE IF NOT EXISTS `boom_vpblock` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`vpip` varchar(60) NOT NULL DEFAULT '',
		`vptype` int(1) NOT NULL DEFAULT '0',
		`vpdate` int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `vpip` (`vpip`),
	KEY `vpdate` (`vpdate`)
	) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");
	boomIndexing('boom_users', 'user_vpblock');
}
$ad = array(
	'name' => 'vpblock',
	'access'=> 0,
	'custom1'=> 0,
	'custom2'=> '',
	'custom3'=> 1,
	'custom5'=> 60,
	'custom6'=> 'Use of proxy / vpn detected',
	'custom7'=> 1440,
	'custom8'=> 10080,
	);
	
vpblockInstall();	
?>