<?php
if(!defined('BOOM')){
	die();
}
$ad = array(
	'name' => 'commandos',
	'custom1'=> '@',
	);
	
$mysqli->query("CREATE TABLE IF NOT EXISTS `boom_commandos` (
				`id` int(10) NOT NULL AUTO_INCREMENT,
				`command` varchar(50) NOT NULL DEFAULT '',
				`command_output` varchar(2000) NOT NULL DEFAULT '',
				`command_mode` int(1) NOT NULL DEFAULT '1',
				`command_rank` int(2) NOT NULL DEFAULT '10',
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci AUTO_INCREMENT=1");
				
?>