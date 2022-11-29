<?php
if(!defined('BOOM')){
	die();
}
$ad = array(
	'name' => 'quizbot',
	'bot_name'=> 'Quizbot',
	'bot_type'=> 2,
	'custom1'=> 0,
	'custom2'=> 0,
	'custom3'=> 1,
	'custom4'=> 'English1.txt',
	'custom5'=> 'Scramble_english.txt'
);
$mysqli->query("ALTER TABLE `boom_users` ADD quiz_score int(11) NOT NULL DEFAULT '0'");
?>