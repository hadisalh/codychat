<?php
require_once('../config_session.php');
if(!isset($_POST['id'], $_POST['type'])){
	echo 0; 
	die();
}
$type = escape($_POST['type']);
$id = escape($_POST['id']);

if($type == 'wall'){
	$action = "deleteWall($id);";
}
else if($type == 'wall_reply'){
	$action = "deleteReply($id);";
}
else if($type == 'news'){
	$action = "deleteNews($id);";
}
else if($type == 'news_reply'){
	$action = "deleteNewsReply($id);";
}
else {
	echo 0;
	die();
}
?>
<div class="pad25">
	<div class="vpad25">
		<p class="centered_element" ><?php echo $lang['delete_post']; ?></p>
	</div>
	<div class="centered_element">
		<button onclick="<?php echo $action; ?>" class="reg_button theme_btn"><?php echo $lang['yes']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>