<?php
$pversion = PHP_MAJOR_VERSION . PHP_MINOR_VERSION;
if($pversion >= 72){
	$boom_version = 'php72';
}
else if($pversion >= 71){
	$boom_version = 'php71';
}
else {
	$boom_version = 'php70';
}
?>