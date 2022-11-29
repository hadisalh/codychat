<?php
$load_addons = 'commandos';
require_once('../../../system/config_addons.php');

function commandosTemplate($list){
	global $data;
	switch($list['command_mode']){
		case 1:
			$list['dtype'] = '<i class="fa fa-user"></i>';
			break;
		case 2:
			$list['dtype'] = '<i class="fa fa-user success"></i>';
			break;
		default:
			$list['dtype'] = '<i class="fa fa-user"></i>';
	}
	return boomTemplate('../addons/commandos/system/template/commandos_data', $list);
}
if(isset($_POST['list_commandos']) && boomAllow($cody['can_manage_addons'])){
	$listing = '';
	$get_list = $mysqli->query("SELECT * FROM boom_commandos WHERE id > 0 ORDER BY COMMAND ASC");
	if($get_list->num_rows > 0){
		while($list = $get_list->fetch_assoc()){
			$listing .= commandosTemplate($list);
		}
	}
	else {
		$listing .= emptyZone($lang['no_data']);
	}
	echo $listing;
}
?>