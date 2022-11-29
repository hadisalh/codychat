<?php
require('../config_session.php');

if(!canManageReport()){
	die();
}
if(isset($_POST['chat_report'])){
	$id = escape($_POST['chat_report']);
	$report = reportInfo($id);
	if(empty($report)){
		echo 1;
		die();
	}
	$get_report = $mysqli->query("
		SELECT boom_chat.*, boom_users.*
		FROM boom_chat
		LEFT JOIN boom_users
		ON boom_chat.user_id = boom_users.user_id WHERE boom_chat.post_id = '{$report['report_post']}' LIMIT 1
	");
	if($get_report->num_rows > 0){
		$rep = $get_report->fetch_assoc();
		$repp = array_merge($report, $rep);
	}
	else {
		$mysqli->query("DELETE FROM boom_report WHERE report_id = '$id' AND report_type = 1");
		updateStaffNotify();
		echo 1;
		die();
	}
}
else {
	die();
}
?>
<div class="pad20">
	<div class="head_report pad10 vmargin10 background_box">
		<?php echo boomTemplate('element/log_chat', $repp); ?>
	</div>
	<div class="btable tpad10" id="report_control">
		<div class="bcell report_action">
			<button onclick="removeReport(1,<?php echo $repp['report_id']; ?>, <?php echo $repp['user_id']; ?>);" class="remove_report reg_button delete_btn"><?php echo $lang['delete']; ?></button>
			<button onclick="unsetReport(<?php echo $repp['report_id']; ?>, 1);" class="unset_report reg_button default_btn"><?php echo $lang['action_none']; ?></button>
		</div>
	</div>
</div>