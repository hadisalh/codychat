<?php
if(!defined('BOOM')){
	die();
}
$mysqli->query("ALTER TABLE boom_users DROP COLUMN quiz_score");
?>