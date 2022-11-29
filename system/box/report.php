<?php
require_once('../config_session.php');

if(!isset($_POST['type'], $_POST['id'])){
	die();
}
$id = escape($_POST['id']);
$type = escape($_POST['type']);

if(!canSendReport()){
	echo 3;
	die();
}
?>

<div class="pad25">
	<div class="bpad15 text_med bold">
		<i class="fa fa-exclamation-triangle error"></i> <?php echo $lang['report_post']; ?>
	</div>
	<div class="bpad10">
		<p class="text_small" ><?php echo $lang['report_warning']; ?></p>
	</div>
	<div class="setting_element">
		<p class="label"><?php echo $lang['reason']; ?></p>
		<select id="report_reason">
			<?php echo listReport(); ?>
		</select>
	</div>
	<div class="tpad15">
		<button onclick="makeReport(<?php echo $type; ?>,<?php echo $id; ?>);" class="reg_button theme_btn"><?php echo $lang['report']; ?></button>
		<button class="reg_button close_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>