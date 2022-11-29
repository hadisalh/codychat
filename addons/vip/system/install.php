<?php
if(!defined('BOOM')){
	die();
}
function vipInstallation(){
	global $mysqli, $data;
	$mysqli->query("ALTER TABLE `boom_users` ADD vip_end int(11) NOT NULL DEFAULT '0'");
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vip_transaction` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`userid` int(11) NOT NULL DEFAULT '11',
		`userp` varchar(50) NOT NULL DEFAULT '',
		`plan` varchar(20) NOT NULL DEFAULT '',
		`price` varchar(20) NOT NULL DEFAULT '',
		`currency` varchar(20) NOT NULL DEFAULT '',
		`gateaway` varchar(50) NOT NULL DEFAULT '',
		`invoice` varchar(100) NOT NULL DEFAULT '',
		`order_id` varchar(100) NOT NULL DEFAULT '',
		`email` varchar(200) NOT NULL DEFAULT '',
		`vdate` int(11) NOT NULL DEFAULT '0',
		`status` varchar(100) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`),
	KEY `userid` (`userid`),
	KEY `order_id` (`order_id`)
	) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");
}
$ad = array(
	'name' => 'vip',
	'access'=> 0,
	'max'=> 1,
	'custom1'=> '5.00',
	'custom2'=> '15.00',
	'custom3'=> '30.00',
	'custom4'=> '60.00',
	'custom5'=> '200.00',
	'custom6'=> 0,
	'custom7'=> 'USD',
	);
	
$install_vip = vipInstallation();	
$index_vip = boomIndexing('boom_users', 'vip_end');

?>