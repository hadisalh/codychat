<?php
/**
* Codychat
*
* @package Codychat
* @author www.boomcoding.com
* @copyright 2020
* @terms any use of this script without a legal license is prohibited
* all the content of Codychat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
require_once('../config_session.php');

$check_action = getDelay();
$online_delay = time() - ( 86400 * 7 );
$online_user = '';
$offline_user = '';
$onair_user = '';
$online_count = 0;
$onair_count = 0;

if($data['last_action'] < getDelay()){
	$mysqli->query("UPDATE boom_users SET last_action = '" . time() . "' WHERE user_id = '{$data['user_id']}'");
}

$data_list = $mysqli->query("
	SELECT user_name, user_mobile, user_color, user_font, user_rank, user_dj, user_onair, user_join, user_tumb, user_status, user_sex, user_age, user_cover, country,
	user_id, user_mute, user_regmute, room_mute, last_action, user_bot, user_role, user_mood, country
	FROM `boom_users`
	WHERE `user_roomid` = {$data["user_roomid"]}  AND last_action > '$check_action' AND user_status != 6 || user_bot = 1
	ORDER BY `user_rank` DESC, user_role DESC, `user_name` ASC 
");

if($data['max_offcount'] > 0){
	$offline_list = $mysqli->query("
		SELECT user_name, user_mobile, user_color, user_font, user_rank, user_dj, user_onair, user_join, user_tumb, user_status, user_sex, user_age, user_cover, country,
		user_id, user_mute, user_regmute, room_mute, last_action, user_bot, user_role, user_mood, country
		FROM `boom_users`
		WHERE `user_roomid` = {$data["user_roomid"]}  AND last_action > '$online_delay' AND last_action < '$check_action' AND user_status != 6 AND  user_rank != 0 AND user_bot = 0
		ORDER BY last_action DESC LIMIT {$data['max_offcount']}
	");
}

mysqli_close($mysqli);

if ($data_list->num_rows > 0){
	while ($list = $data_list->fetch_assoc()){
		if($list['user_dj'] == 1 && $list['user_onair'] == 1){
			$onair_user .= createUserlist($list);
			$onair_count++;
		}
		else {
			$online_user .= createUserlist($list);
			$online_count++;
		}
	}
}
if($data['max_offcount'] > 0){
	if($offline_list->num_rows > 0){
		while($offlist = $offline_list->fetch_assoc()){
			$offline_user .= createUserlist($offlist);
		}
	}
}

?>
<div id="container_user">
	<?php if($onair_user != ''){ ?>
	<div class="user_count">
		<div class="bcell">
			<?php echo $lang['onair']; ?> <span class="ucount theme_btn"><?php echo $onair_count; ?></span>
		</div>
	</div>
	<div class="online_user"><?php echo $onair_user; ?></div>
	<?php } ?>
	<div class="user_count">
		<div class="bcell">
			<?php echo $lang['online']; ?> <span class="ucount back_theme"><?php echo $online_count; ?></span>
		</div>
	</div>
	<div class="online_user"><?php echo $online_user; ?></div>
	<?php if($offline_user != ''){ ?>
	<div class="user_count">
		<div class="bcell">
			<?php echo $lang['offline']; ?>
		</div>
	</div>
	<div class="online_user"><?php echo $offline_user; ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>