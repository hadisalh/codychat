<?php
function mainVoiceRecord(){
	global $data;
	if(boomAllow($data['addons_access']) && $data['custom2'] == 1){
		return true;
	}
}
function privateVoiceRecord(){
	global $data;
	if(boomAllow($data['addons_access']) && $data['custom3'] == 1){
		return true;
	}
}
?>