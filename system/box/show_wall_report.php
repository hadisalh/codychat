<?php
require('../config_session.php');

if(!canManageReport()){
	die();
}
if(isset($_POST['wall_report'])){
	$id = escape($_POST['wall_report']);
	$report = reportInfo($id);
	if(empty($report)){
		echo 1;
		die();
	}
	$get_report = $mysqli->query("
		SELECT boom_post.*, boom_users.*
		FROM boom_post
		LEFT JOIN boom_users
		ON boom_post.post_user = boom_users.user_id WHERE boom_post.post_id = '{$report['report_post']}' LIMIT 1
	");
	if($get_report->num_rows > 0){
		$rep = $get_report->fetch_assoc();
		$repp = array_merge($report, $rep);
	}
	else {
		$mysqli->query("DELETE FROM boom_report WHERE report_id = '$id' AND report_type = 2");
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
	<div class="report_content">
		<?php echo showPost($repp['post_id'], 1); ?>
	</div>
	<div class="btable tpad10" id="report_control">
		<div class="bcell report_action">
			<button onclick="removeReport(2,<?php echo $repp['report_id']; ?>, <?php echo $repp['user_id']; ?>);" class="remove_report reg_button delete_btn"><?php echo $lang['do_action']; ?></button>
			<button onclick="unsetReport(<?php echo $repp['report_id']; ?>, 2);" class="unset_report reg_button default_btn"><?php echo $lang['action_none']; ?></button>
		</div>
	</div>
</div>