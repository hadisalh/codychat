<?php
$load_addons = 'youtube';
require('../../../system/config_addons.php');

if(!isset($_POST['youtube_search'])){
	die();
}

$content = escape($_POST['youtube_search']);
if($content == ''){
	die();
}
if(muted() || !boomAllow($data['addons_access'])){
	die();
}
if(checkFlood()){
	die();
}
$content = urlencode($content);
$youcall = doCurl('https://www.googleapis.com/youtube/v3/search?part=snippet,id&q=' . $content . '&maxResults=8&type=video&key=' . $data['custom1']);
echo $youcall;
die();
?>