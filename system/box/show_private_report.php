<?php
require('../config_session.php');

$show_report = '';
if(!canManageReport()){
	die();
}
if(isset($_POST['private_report'])){
	$id = escape($_POST['private_report']);
	$report = reportInfo($id);
	if(empty($report)){
		echo 1;
		die();
	}
	$privlog = $mysqli->query("
		SELECT 
		log.*, boom_users.user_id, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_bot 
		FROM ( SELECT * FROM `boom_private` WHERE  `hunter` = '{$report['report_user']}' AND `target` = '{$report['report_target']}'  OR `hunter` = '{$report['report_target']}' AND `target` = '{$report['report_user']}' ORDER BY `id` DESC LIMIT {$cody['report_history']}) AS log 
		LEFT JOIN boom_users
		ON log.hunter = boom_users.user_id
		ORDER BY `time` DESC
	");
	if($privlog->num_rows > 0){
		while($log = $privlog->fetch_assoc()){
			$show_report .= privateLog($log, $report['report_user']);
		}
	}
	else {
		$mysqli->query("DELETE FROM boom_report WHERE report_id = '$id' AND report_type = 3");
		updateStaffNotify();
		echo 1;
		die();
	}
}
else {
	die();
}
?>
<div>
	<div id="preport_box" class="background_box box_height300 pad20">
		<?php echo $show_report; ?>
	</div>
	<div class="btable pad20" id="report_control">
		<div class="bcell report_action">
			<button onclick="removeReport(3,<?php echo $report['report_id']; ?>, <?php echo $report['report_target']; ?>);" class="reg_button delete_btn"><?php echo $lang['do_action']; ?></button>
			<button onclick="unsetReport(<?php echo $report['report_id']; ?>, 3);" class="unset_report reg_button default_btn"><?php echo $lang['action_none']; ?></button>
		</div>
	</div>
</div>