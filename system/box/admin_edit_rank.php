<?php
require_once('../config_session.php');
if(!isset($_POST['target']) || !boomAllow(9)){
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);
if(!canRankUser($user)){
	echo 0;
	die();
}
?>
<div class="pad20">
	<p class="label"><?php echo $lang['user_rank']; ?></p>
	<select id="profile_rank" onchange="changeRank(this, <?php echo $user['user_id']; ?>);">
		<?php echo changeRank($user['user_rank']); ?>
	</select>
</div>