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
function getIp(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $cloud =   @$_SERVER["HTTP_CF_CONNECTING_IP"];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($cloud, FILTER_VALIDATE_IP)) {
        $ip = $cloud;
    }
    else if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }
    else{
        $ip = $remote;
    }
    return escape($ip);
}
function boomTemplate($getpage, $boom = '') {
	global $data, $lang, $mysqli, $cody;
    $page = BOOM_PATH . '/system/' . $getpage . '.php';
    $structure = '';
    ob_start();
    require($page);
    $structure = ob_get_contents();
    ob_end_clean();
    return $structure;
}
function calHour($h){
	return time() - ($h * 3600);
}
function calWeek($w){
	return time() - ( 3600 * 24 * 7 * $w);
}
function calmonth($m){
	return time() - ( 3600 * 24 * 30 * $m);
}
function calDay($d){
	return time() - ($d * 86400);
}
function calSecond($sec){
	return time() - $sec;
}
function calMinutes($min){
	return time() - ($min * 60);
}
function calHourUp($h){
	return time() + ($h * 3600);
}
function calWeekUp($w){
	return time() + ( 3600 * 24 * 7 * $w);
}
function calmonthUp($m){
	return time() + ( 3600 * 24 * 30 * $m);
}
function calDayUp($d){
	return time() + ($d * 86400);
}
function calMinutesUp($min){
	return time() + ($min * 60);
}
function calSecondUp($sec){
	return time() + $sec;
}
function boomActive($feature){
	if($feature <= 11){
		return true;
	}
}
function boomFormat($txt){
	$count = substr_count($txt, "\n" );
	if($count > 20){
		return $txt;
	}
	else {
		return nl2br($txt);
	}
}
function boomFileVersion(){
	global $data;
	if($data['bbfv'] > 1.0){
		return '?v=' . $data['bbfv'];
	}
	return '';
}
function boomNull($val){
	if(is_null($val)){
		return 0;
	}
	else {
		return $val;
	}
}
function boomCacheUpdate(){
	global $mysqli;
	$mysqli->query("UPDATE boom_setting SET bbfv = bbfv + 0.01 WHERE id > 0");
}
function embedMode(){
	global $data;
	if(isset($_GET['embed'])){
		return true;
	}
}
function embedCode(){
	global $data;
	if(isset($_GET['embed'])){
		return 1;
	}
	else {
		return 0;
	}
}
function myColor($u){
	return $u['user_color'];
}
function myColorFont($u){
	return $u['user_color'] . ' ' . $u['user_font'];
}
function myTextColor($u){
	return $u['bccolor'] . ' ' . $u['bcbold'] . ' ' . $u['bcfont'];
}
function myAvatar($a){
	global $data;
	$path =  '/avatar/';
	if(defaultAvatar($a)){
		$path =  '/default_images/avatar/';
	}
	return $data['domain'] . $path . $a;
}
function defaultAvatar($a){
	if(stripos($a, 'default') !== false){
		return true;
	}
}
function myCover($a){
	global $data;
	return $data['domain'] . '/cover/' . $a;
}
function getCover($user){
	global $data;
	if(userHaveCover($user)){
		return 'style="background-image: url(' . myCover($user['user_cover']) . ');"';
	}
}
function coverClass($user){
	global $data;
	if(userHaveCover($user)){
		return 'cover_size';
	}
}
function userHaveCover($user){
	global $data;
	if($user['user_cover'] != ''){
		return true;
	}
}
function getIcon($icon, $c){
	global $data, $lang;
	return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/' . $icon . boomFileVersion() . '"/>';
}
function boomCode($code, $custom = array()){
	$def = array('code'=> $code);
	$res = array_merge($def, $custom);
	return json_encode( $res, JSON_UNESCAPED_UNICODE);
}
function profileAvatar($a){
	global $data;
	$path =  '/avatar/';
	if(defaultAvatar($a)){
		$path =  '/default_images/avatar/';
	}
	return 'href="' . $data['domain'] . $path  . $a . '" src="' . $data['domain'] . $path  . $a . '"';
}
function boomUserTheme($user){
	global $data;
	if($user['user_theme'] == 'system'){
		return $data['default_theme'];
	}
	else {
		return $user['user_theme'];
	}
}
function linkAvatar($a){
	if(preg_match('@^https?://@i', $a)){
		return true;
	}
}
function escape($t){
	global $mysqli;
	return $mysqli->real_escape_string(trim(htmlspecialchars($t, ENT_QUOTES)));
}
function boomSanitize($t){
	global $mysqli;
	$t = str_replace(array('\\', '/', '.', '<', '>', '%', '#'), '', $t);
	return $mysqli->real_escape_string(trim(htmlspecialchars($t, ENT_QUOTES)));
}
function softEscape($t){
	global $mysqli;
	$atags = '<a><p><h1><h2><h3><h4><img><b><strong><br><ul><li><div><i><span><u><th><td><tr><table><strike><small><ol><hr><font><center><blink><marquee>';
	$t = strip_tags($t, $atags);
	return $mysqli->real_escape_string(trim($t));
}
function systemReplace($text){
	global $lang;
	$text = str_replace('%bcquit%', $lang['leave_message'], $text);
	$text = str_replace('%bcjoin%', $lang['join_message'], $text);
	$text = str_replace('%bcclear%', $lang['clear_message'], $text);
	$text = str_replace('%spam%', $lang['spam_content'], $text);
	$text = str_replace('%bcname%', $lang['name_message'], $text);
	$text = str_replace('%bckick%', $lang['kick_message'], $text);
	$text = str_replace('%bcban%', $lang['ban_message'], $text);
	$text = str_replace('%bcmute%', $lang['mute_message'], $text);
	return $text;
}
function textReplace($text){
	global $data, $lang;
	$text = str_replace('%user%', $data['user_name'], $text);
	return $text;
}
function systemSpecial($content, $type, $custom = array()){
	global $data, $lang;
	$def = array(
		'content'=> $content,
		'type'=> $type,
		'delete'=> 1,
		'title'=> $lang['default_title'],
		'icon'=> 'default.svg',
	);
	$template = array_merge($def, $custom);
	return boomTemplate('element/system_log', $template);
}
function specialLogIcon($icon){
	global $data;
	return $data['domain'] . '/default_images/special/' . $icon . boomFileVersion();
}
function userDetails($id){
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_id = '$id'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function ownAvatar($i){
	global $data;
	if($i == $data['user_id']){
		return 'glob_av';
	}
	return '';
}
function getUserAge($age){
	global $lang;
	return $age . ' ' . $lang['years_old'];
}
function delExpired($d){
	if($d < calSecond(12)){
		return true;
	}
}
function chatAction($room){
	global $mysqli, $data;
	$mysqli->query("UPDATE boom_rooms SET rcaction = rcaction + 1, room_action = '" . time() . "' WHERE room_id = '$room'");
}
function chatLevel($v){
	global $data;
}
function userPostChat($content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'hunter'=> $data['user_id'],
		'room'=> $data['user_roomid'],
		'color'=> escape(myTextColor($data)),
		'type'=> 'public__message',
		'rank'=> 99,
		'snum'=> '',
	);
	$c = array_merge($def, $data, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, snum, tcolor) VALUES ('" . time() . "', '{$c['hunter']}', '$content', '{$c['room']}', '{$c['type']}', '{$c['rank']}', '{$c['snum']}', '{$c['color']}')");
	$last_id = $mysqli->insert_id;
	chatAction($data['user_roomid']);
	if(!empty($c['snum'])){
		$user_post = array(
			'post_id'=> $last_id,
			'type'=> $c['type'],
			'post_date'=> time(),
			'tcolor'=> $c['color'],
			'log_rank'=> $c['rank'],
			'post_message'=> $content,
		);
		$post = array_merge($c, $user_post);
		if(!empty($post)){
			return createLog($data, $post);
		}
	}
}
function userPostChatFile($content, $file_name, $type, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'public__message',
		'file2'=> '',
	);
	$c = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, file) VALUES ('" . time() . "', '{$data['user_id']}', '$content', '{$data['user_roomid']}', '{$c['type']}', '1')");
	$rel = $mysqli->insert_id;
	chatAction($data['user_roomid']);
	if($c['file2'] != ''){
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES
		('$file_name', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel'),
		('{$c['file2']}', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel')
		");
	}
	else {
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES ('$file_name', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel')");
	}
	return true;
}
function systemPostChat($room, $content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'system',
		'color'=> 'chat_system',
		'rank'=> 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, tcolor) VALUES ('" . time() . "', '{$data['system_id']}', '$content', '$room', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	chatAction($room);
	return true;
}
function botPostChat($id, $room, $content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'public__message',
		'color'=> '',
		'rank'=> 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, tcolor) VALUES ('" . time() . "', '$id', '$content', '$room', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	chatAction($room);	
	return true;
}
function postPrivate($from, $to, $content, $snum = ''){
	global $mysqli, $data;
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message) VALUES ('" . time() . "', '$to', '$from', '$content')");
	$last_id = $mysqli->insert_id;
	if($to != $from){
		$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '$to'");
	}
	if($snum != ''){
		$user_post = array(
			'id'=> $last_id,
			'time'=> time(),
			'message'=> $content,
			'hunter'=> $from,
		);
		$post = array_merge($data, $user_post);
		if(!empty($post)){
			return privateLog($post, $post['user_id']);
		}
	}
}
function postPrivateContent($from, $to, $content){
	global $mysqli, $data;
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message, file) VALUES ('" . time() . "', '$to', '$from', '$content', 1)");
	$rel = $mysqli->insert_id;
	$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '$from' OR user_id = '$to'");
	return true;
}
function userPostPrivateFile($content, $target, $file_name, $type){
	global $mysqli, $data;
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message, file) VALUES ('" . time() . "', '$target', '{$data['user_id']}', '$content', 1)");
	$rel = $mysqli->insert_id;
	$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '{$data['user_id']}' OR user_id = '$target'");
	$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES ('$file_name', '" . time() . "', '{$data['user_id']}', 'private', '$type', '$rel')");
	return true;
}
function getFriendList($id, $type = 0){
	global $mysqli;
	$friend_list = array();
	$find_friend = $mysqli->query("SELECT target FROM boom_friends WHERE hunter = '$id' AND fstatus = '3'");
	if($find_friend->num_rows > 0){
		while($find = $find_friend->fetch_assoc()){
			array_push($friend_list, $find['target']);
		}
		if($type == 1){
			array_push($friend_list, $id);
		}
	}
	return $friend_list;
}
function getRankList($rank){
	global $mysqli;
	$list = array();
	$find_list = $mysqli->query("SELECT user_id FROM boom_users WHERE user_rank = '$rank'");
	if($find_list->num_rows > 0){
		while($find = $find_list->fetch_assoc()){
			array_push($list, $find['user_id']);
		}
	}
	return $list;
}
function getStaffList(){
	global $mysqli;
	$list = array();
	$find_list = $mysqli->query("SELECT user_id FROM boom_users WHERE user_rank >= 8");
	if($find_list->num_rows > 0){
		while($find = $find_list->fetch_assoc()){
			array_push($list, $find['user_id']);
		}
	}
	return $list;
}
function boomListNotify($list, $type, $custom = array()){
	global $mysqli, $data;
	if(!empty($list)){
		$values = '';
		foreach($list as $user){
			$def = array(
				'hunter'=> $data['system_id'],
				'room'=> $data['user_roomid'],
				'rank'=> 0,
				'delay'=> 0,
				'reason'=> '',
				'source'=> 'system',
				'sourceid'=> 0,
				'custom' => '',
				'custom2' => '',
			);
			$c = array_merge($def, $custom);
			$values .= "('{$c['hunter']}', '$user', '$type', '" . time() . "', '{$c['source']}', '{$c['sourceid']}', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}'),";
		}
		$values = rtrim($values, ',');
		$mysqli->query("INSERT INTO boom_notification ( notifier, notified, notify_type, notify_date, notify_source, notify_id, notify_rank, notify_delay, notify_reason, notify_custom, notify_custom2) VALUES $values");
		updateListNotify($list);
	}
}
function boomNotify($type, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'hunter'=> $data['system_id'],
		'target'=> 0,
		'room'=> $data['user_roomid'],
		'rank'=> 0,
		'delay'=> 0,
		'reason'=> '',
		'source'=> 'system',
		'sourceid'=> 0,
		'custom' => '',
		'custom2' => '',
	);
	$c = array_merge($def, $custom);
	if($c['target'] == 0){
		return false;
	}
	$mysqli->query("INSERT INTO boom_notification ( notifier, notified, notify_type, notify_date, notify_source, notify_id, notify_rank, notify_delay, notify_reason, notify_custom, notify_custom2) 
	VALUE ('{$c['hunter']}', '{$c['target']}', '$type', '" . time() . "', '{$c['source']}', '{$c['sourceid']}', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}')");
	updateNotify($c['target']); 
}
function updateNotify($id){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_id = '$id'");
}
function updateListNotify($list){
	global $mysqli;
	if(empty($list)){
		return false;
	}
	$list = implode(", ", $list);
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_id IN ($list)");
}
function updateStaffNotify(){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_rank > 7");
}
function updateAllNotify(){
	global $mysqli;
	$delay = calMinutes(2);
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE last_action > '$delay'");
}
function createIgnore(){
	global $mysqli, $data, $cody;
	$ignore_list = '';
	$get_ignore = $mysqli->query("SELECT ignored FROM boom_ignore WHERE ignorer = '{$data['user_id']}'");
	while($ignore = $get_ignore->fetch_assoc()){
		$ignore_list .= $ignore['ignored'] . '|';
	}
	$_SESSION[BOOM_PREFIX . 'ignore'] = '|' . $ignore_list;
}
function isIgnored($ignore, $id){
	global $cody;
	if(strpos($ignore, '|' . $id . '|') !== false){
		return true;
	}
}
function getIgnore(){
	global $cody;
	return $_SESSION[BOOM_PREFIX . 'ignore'];
}
function processChatMsg($post) {
	global $data;
	if($post['user_id'] != $data['user_id'] && !preg_match('/http/',$post['post_message'])){
		$post['post_message'] = str_ireplace($data['user_name'], '<span class="my_notice">' . $data['user_name'] . '</span>', $post['post_message']);
	}
	return mb_convert_encoding(systemReplace($post['post_message']), 'UTF-8', 'auto');
}
function processPrivateMsg($post) {
	global $data;
	return mb_convert_encoding(systemReplace($post['message']), 'UTF-8', 'auto');
}
function mainRoom(){
	global $data;
	if($data['user_roomid'] == 1){
		return true;
	}
}
function renderInfo($user){
}
function chatRank($user){
	global $data;
	if(isBot($user)){
		return '';
	}
	$rank = systemRank($user['user_rank'], 'chat_rank');
	if($rank != ''){
		return $rank;
	}
}
function isQuotable($post){
	if(!isSystem($post['user_id'])){
		return true;
	}
}
function createLog($data, $post, $ignore = ''){
	$log_options = '';
	$report = 0;
	$delete = 0;
	$m = 0;
	if(isIgnored($ignore, $post['user_id'])){
		return false;
	}
	if(boomAllow($post['log_rank'])){
		return false;
	}
	if(canDeleteLog() || canDeleteRoomLog() || canDeleteSelfLog($post)){
		$delete = 1;
		$m++;
	}
	else if(canReport() && !isSystem($post['user_id'])){
		$report = 1;
		$m++;
	}
	if($m > 0){
		$log_options = '<div class="cclear" onclick="logMenu(this, ' . $post['post_id'] . ',' . $delete . ',' . $report . ');"><i class="fa fa-ellipsis-h"></i></div>';
	}
	return  '<li id="log' . $post['post_id'] . '" data="' . $post['post_id'] . '" class="ch_logs ' . $post['type'] . '">
				<div class="avtrig chat_avatar" onclick="avMenu(this,'.$post['user_id'].',\''.$post['user_name'].'\','.$post['user_rank'].','.$post['user_bot'].',\''.$post['country'].'\',\''.$post['user_cover'].'\',\''.$post['user_age'].'\',\''.userGender($post['user_sex']).'\');">
					<img class="cavatar avav ' . avGender($post['user_sex']) . ' ' . ownAvatar($post['user_id']) . '" src="' . myAvatar($post['user_tumb']) . '"/>
				</div>
				<div class="my_text">
					<div class="btable">
							<div class="cname">' . chatRank($post) . '<span class="username ' . myColorFont($post) . '">' . $post['user_name'] . '</span></div>
							<div class="cdate">' . chatDate($post['post_date']) . '</div>
							' . $log_options . '
					</div>
					<div class="chat_message ' . $post['tcolor'] . '">' . processChatMsg($post) . '</div>
				</div>
			</li>';
}
function privateLog($post, $hunter){
	if($hunter == $post['hunter']){
		return '<li id="priv' . $post['id'] . '">
					<div class="private_logs">
						<div class="private_avatar">
							<img data="' . $post['user_id'] . '" class="get_info avatar_private" src="' . myAvatar($post['user_tumb']) . '"/>
						</div>
						<div class="private_content">
							<div class="hunter_private">' . processPrivateMsg($post) . '</div>
							<p class="pdate">' . displayDate($post['time']) . '</p>
						</div>
					</div>
				</li>';
	}
	else {
		return '<li id="priv' . $post['id'] . '">
					<div class="private_logs">
						<div class="private_content">
							<div class="target_private">' . processPrivateMsg($post) . '</div>
							<p class="ptdate">' . displayDate($post['time']) . '</p>
						</div>
						<div class="private_avatar">
							<img data="' . $post['user_id'] . '" class="get_info avatar_private" src="' . myAvatar($post['user_tumb']) . '"/>
						</div>
					</div>
				</li>';
	}
}
function createUserlist($list){
	global $data, $lang;
	if(!isVisible($list)){
		return false;
	}
	$icon = '';
	$muted = '';
	$status = '';
	$mood = '';
	$flag = '';
	$offline = 'offline';
	$rank_icon = getRankIcon($list, 'list_rank');
	$mute_icon = getMutedIcon($list, 'list_mute');
	if(useFlag($list['country'])){
		$flag = '<div class="user_item_flag"><img src="' . countryFlag($list['country']) . '"/></div>';
	}
	if($rank_icon != ''){
		$icon = '<div class="user_item_icon icrank">' . $rank_icon . '</div>';
	}
	if($mute_icon != ''){
		$muted = '<div class="user_item_icon icmute">' . $mute_icon . '</div>';
	}
	if($list['last_action'] > getDelay() || isBot($list)){
		$offline = '';
		$status = getStatus($list['user_status'], 'list_status');
	}
	if(!empty($list['user_mood'])){
		$mood = '<p class="text_xsmall bustate bellips">' . $list['user_mood'] . '</p>';
	}
	return '<div onclick="dropUser(this,'.$list['user_id'].',\''.$list['user_name'].'\','.$list['user_rank'].','.$list['user_bot'].',\''.$list['country'].'\',\''.$list['user_cover'].'\',\''.$list['user_age'] .'\',\''.userGender($list['user_sex']).'\');" class="avtrig user_item ' . $offline . '">
				<div class="user_item_avatar"><img class="avav acav ' . avGender($list['user_sex']) . ' ' . ownAvatar($list['user_id']) . '" src="' . myAvatar($list['user_tumb']) . '"/> ' . $status . '</div>
				<div class="user_item_data"><p class="username ' . myColorFont($list) . '">' . $list["user_name"] . '</p>' . $mood . '</div>
				' . $muted . $icon . $flag . '
			</div>';
}
function useFlag($country){
	global $data;
	if($data['flag_ico'] > 0 && $country != 'ZZ' && $country != ''){
		return true;
	}
}
function listCountry($c){
	global $lang;
	require BOOM_PATH . '/system/location/country_list.php';
	$list_country = '';
	$list_country .= '<option value="ZZ" ' . selCurrent($c, 'ZZ') . '>' . $lang['not_shared'] . '</option>';
	foreach ($country_list as $country => $key) {
		$list_country .= '<option ' . selCurrent($c, $country) . ' value="' . $country . '">' . $key . '</option>';
	}	
	return $list_country;
}
function userCountry($country){
	global $data;
	if($country != 'ZZ' && $country != ''){
		return true;
	}
}
function countryFlag($country){
	global $data;
	return 'system/location/flag/' . $country . '.png';
}
function countryName($country){
	global $lang;
	require BOOM_PATH . '/system/location/country_list.php';
	if(array_key_exists($country, $country_list)){
		return $country_list[$country];
	}
	else {
		return $lang['not_available'];
	}
}
function chatDate($date){
	return date("j/m G:i", $date);
}
function displayDate($date){
	return date("j/m G:i", $date);
}
function longDate($date){
	return date("Y-m-d ", $date);
}
function longDateTime($date){
	return date("Y-m-d G:i ", $date);
}
function userTime($user){          
	$d = new DateTime(date("d F Y H:i:s",time()));
	$d->setTimezone(new DateTimeZone($user['user_timezone']));
	$r =$d->format('G:i');
	return $r;
}
function boomRenderMinutes($val){
	global $lang;
	$day = '';
	$hour = '';
	$minute = '';
	$d = floor ($val / 1440);
	$h = floor (($val - $d * 1440) / 60);
	$m = $val - ($d * 1440) - ($h * 60);
	if($d > 0){
		if($d > 1){ $day = $d . ' ' . $lang['days']; } else{ $day = $d . ' ' . $lang['day']; }
	}
	if($h > 0){
		if($h > 1){ $hour = $h . ' ' . $lang['hours']; } else{ $hour = $h . ' ' . $lang['hour']; }
	}
	if($m > 0){
		if($m > 1){ $minute = $m . ' ' . $lang['minutes']; } else{ $minute = $m . ' ' . $lang['minute']; }
	}
	return trim($day . ' ' . $hour  . ' ' . $minute);
}
function boomRenderSeconds($val){
	global $lang;
	$day = '';
	$hour = '';
	$minute = '';
	$second = '';
	$d = floor ($val / 86400);
	$h = floor (($val - $d * 86400) / 3600);
	$m = floor (($val - ($d * 86400) - ($h * 3600)) / 60);
	$s = $val - ($d * 86400) - ($h * 3600) - ($m * 60);
	if($d > 0){
		if($d > 1){ $day = $d . ' ' . $lang['days']; } else{ $day = $d . ' ' . $lang['day']; } }
	if($h > 0){
		if($h > 1){ $hour = $h . ' ' . $lang['hours']; } else{ $hour = $h . ' ' . $lang['hour']; }
	}
	if($m > 0){
		if($m > 1){ $minute = $m . ' ' . $lang['minutes']; } else{ $minute = $m . ' ' . $lang['minute']; }
	}
	if($s > 0){
		if($s > 1){ $second = $s . ' ' . $lang['seconds']; } else{ $second = $s . ' ' . $lang['second']; }
	}
	return trim($day . ' ' . $hour  . ' ' . $minute . ' ' . $second);
}
function boomTimeLeft($t){
	return boomRenderMinutes(floor(($t - time()) / 60));
}
function boomAllow($rank){
	global $data;
	if($data['user_rank'] >= $rank){
		return true;
	}
}
function userBoomAllow($user, $val){
	if($user['user_rank'] >= $val){
		return true;
	}
}
function boomRole($role){
	global $data;
	if($data['user_role'] >= $role){
		return true;
	}
}
function haveRole($role){
	if($role > 0){
		return true;
	}
}
function isGreater($rank){
	global $data;
	if($data['user_rank'] > $rank){
		return true;
	}
}
function mySelf($id){
	global $data;
	if($id == $data['user_id']){
		return true;
	}
}
function isBot($user){
	if($user['user_bot'] > 0){
		return true;
	}
}
function systemBot($user){
	if($user == 9){
		return true;
	}
}
function isSystem($id){
	global $data;
	if($id == $data['system_id']){
		return true;
	}
}
function getTopic($t){
	global $lang;
	$topic = processUserData($t);
	if(!empty($topic)){
		return systemSpecial($topic, 'topic_log', array('icon'=> 'topic.svg', 'title'=> $lang['topic_title']));
	}
}
function boomRoomData($r){
	global $mysqli, $data;
	$room = array();
	$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = $r");
	if($get_room->num_rows > 0){
		$room = $get_room->fetch_assoc();
		return $room;
	}
}
function boomConsole($type, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'hunter'=> $data['user_id'],
		'target'=> $data['user_id'],
		'room'=> $data['user_roomid'],
		'rank'=> 0,
		'delay'=> 0,
		'reason'=> '',
		'custom' => '',
		'custom2' => '',
	);
	$c = array_merge($def, $custom);
	$mysqli->query("INSERT INTO boom_console (hunter, target, room, ctype, crank, delay, reason, custom, custom2, cdate) VALUES ('{$c['hunter']}', '{$c['target']}', '{$c['room']}', '$type', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}', '" . time() . "')");
}
function boomHistory($type, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'hunter'=> $data['user_id'],
		'target'=> 0,
		'rank'=> 0,
		'delay'=> 0,
		'reason'=> '',
		'content'=> '',
	);
	$c = array_merge($def, $custom);
	if($c['target'] == 0){
		return false;
	}
	$mysqli->query("INSERT INTO boom_history (hunter, target, htype, delay, reason, history_date) VALUES ('{$c['hunter']}', '{$c['target']}', '$type',  '{$c['delay']}', '{$c['reason']}', '" . time() . "')");
}
function renderReason($t){
	global $lang;
	switch($t){
		case '':
			return $lang['no_reason'];
		case 'badword':
			return $lang['badword'];
		case 'spam':
			return $lang['spam'];
		case 'flood':
			return $lang['flood'];
		default:
			return systemReplace($t);
	}
}
function userUnmute($user){
	global $mysqli;
	if(!guestMuted()){
		clearNotifyAction($user['user_id'], 'mute');
		$mysqli->query("UPDATE boom_users SET user_mute = 0, mute_msg = '', user_regmute = 0 WHERE user_id = '{$user['user_id']}'");
		boomNotify('unmute', array('target'=> $user['user_id'], 'source'=> 'mute'));
	}
}
function userUnkick($user){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_kick = 0 WHERE user_id = '{$user['user_id']}'");
}
function muted(){
	global $data;
	if(isMuted($data) || isBanned($data) || isKicked($data) || outChat($data) || isRegmute($data) || guestMuted()){
		return true;
	}
}
function roomMuted(){
	global $data;
	if($data['room_mute'] > 0){
		return true;
	}
}
function isRoomMuted($user){
	if($user['room_mute'] > 0){
		return true;
	}
}
function isMuted($user){
	if($user['user_mute'] > time()){
		return true;
	}
}
function isGuestMuted($user){
	global $data;
	if($user['user_rank'] == 0 && $data['guest_talk'] == 0){
		return true;
	}
}
function guestMuted(){
	global $data;
	if($data['user_rank'] == 0 && $data['guest_talk'] == 0){
		return true;
	}
}
function isRegmute($user){
	if($user['user_regmute'] > time()){
		return true;
	}
}
function mutedData($user){
	if($user['user_mute'] > 0 || $user['user_regmute'] > 0){
		return true;
	}
}
function kickedData($user){
	if($user['user_kick'] > 0){
		return true;
	}
}
function isBanned($user){
	if($user['user_banned'] > 0){
		return true;
	}
}
function isKicked($user){
	if($user['user_kick'] > time()){
		return true;
	}
}
function systemNameFilter($user){
	return '<span onclick="getProfile(' . $user['user_id'] . ')"; class="sysname">' . $user['user_name'] . '</span>';
}
function joinRoom(){
	global $lang, $data, $cody;
	if(allowLogs() && isVisible($data) && $cody['join_room'] == 1){
		$content = str_replace('%user%', systemNameFilter($data), $lang['system_join_room']);
		systemPostChat($data['user_roomid'], $content, array('type'=> 'system__join'));
	}
}
function leaveRoom(){
	global $data, $lang, $cody;
	if(allowLogs() && $cody['leave_room'] == 1){
		if(isVisible($data) && $data['user_roomid'] != 0 && $data['last_action'] > time() - 30 ){
			$content = str_replace('%user%', systemNameFilter($data), $lang['quit_room']);
			systemPostChat($data['user_roomid'], $content, array('type'=> 'system__leave'));
		}
	}
}
function changeNameLog($user, $n){
	global $lang, $data, $cody;
	if(allowLogs() && isVisible($user) && $cody['name_change'] == 1){
		$content = str_replace('%user%', $user['user_name'], $lang['system_name_change']);
		$user['user_name'] = $n;
		$content = str_replace('%nname%', systemNameFilter($user), $content);
		systemPostChat($user['user_roomid'], $content, array('type'=> 'system__action'));
	}
}
function kickLog($user){
	global $lang, $data, $cody;
	if(allowLogs() && $cody['action_log'] == 1 && userInRoom($user)){
		$content = str_replace('%user%', systemNameFilter($user), $lang['system_kick']);
		systemPostChat($user['user_roomid'], $content, array('type'=> 'system__action'));
	}
}
function banLog($user){
	global $lang, $data, $cody;
	if(allowLogs() && $cody['action_log'] == 1 && userInRoom($user)){
		$content = str_replace('%user%', systemNameFilter($user), $lang['system_ban']);
		systemPostChat($user['user_roomid'], $content, array('type'=> 'system__action'));
	}
}
function muteLog($user){
	global $lang, $data, $cody;
	if(allowLogs() && $cody['action_log'] == 1 && userInRoom($user)){
		$content = str_replace('%user%', systemNameFilter($user), $lang['system_mute']);
		systemPostChat($user['user_roomid'], $content, array('type'=> 'system__action'));
	}
}
function processUserData($t){
	global $data;
	return str_replace(array('%user%'), array($data['user_name']), $t);
}
function roomStaff(){
	if(boomRole(4)){
		return true;
	}
}
function userRoomStaff($rank){
	if($rank >= 4){
		return true;
	}
}
function allowLogs(){
	global $data;
	if($data['allow_logs'] == 1){
		return true;
	}
}
function isVisible($user){
	if($user['user_status'] != 6){
		return true;
	}
}
function isSecure($user){
	if(isEmail($user['user_email'])){
		return true;
	}
}
function isMember($user){
	if(!isGuest($user) && !isBot($user)){
		return true;
	}
}
function isGuest($user){
	if($user['user_rank'] == 0){
		return true;
	}
}
function guestForm(){
	global $data;
	if($data['guest_form'] == 1){
		return true;
	}
}
function strictGuest(){
	global $cody;
	if($cody['strict_guest'] == 1){
		return true;
	}
}
function userDj($user){
	if($user['user_dj'] == 1){
		return true;
	}
}
function boomRecaptcha(){
	global $data;
	if($data['use_recapt'] > 0){
		return true;
	}
}

function encrypt($d){
	return sha1(str_rot13($d . BOOM_CRYPT));
}
function boomEncrypt($d, $encr){
	return sha1(str_rot13($d . $encr));
}
function getDelay(){
	return time() - 35;
}
function getMinutes($t){
	return $t / 60;
}
function userActive($user, $c){
	global $data, $cody;
	if(!isVisible($user) && !boomAllow($cody['can_inv_view'])){
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/innactive.svg"/>';
	}
	else if($user['last_action'] >= getDelay() || isBot($user)){
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/active.svg"/>';
	}
	else {
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/innactive.svg"/>';
	}
}
function isOwner($user){
	if($user['user_rank'] == 11){
		return true;
	}
}
function isStaff($rank){
	if($rank >= 8){
		return true;
	}
}
function genKey(){
	return md5(rand(10000,99999) . rand(10000,99999));
}
function genCode(){
	return rand(111111,999999);
}
function genSnum(){
	global $data;
	return $data['user_id'] . rand(1111111, 9999999);
}
function boomUnderClear($t){
	return str_replace('_', ' ', $t);
}
function allowGuest(){
	global $data;
	if($data['allow_guest'] == 1){
		return true;
	}
}
function boomMerge($a, $b){
	$c = $a . '_' . $b;
	return trim($c);
}
function clearNotifyAction($id, $type){
	global $mysqli;
	$mysqli->query("DELETE FROM boom_notification WHERE notified = '$id' AND notify_source = '$type'");
}
function setToken(){
	global $data, $cody;
	if(!empty($_SESSION[BOOM_PREFIX . 'token'])){
		$_SESSION[BOOM_PREFIX . 'token'] = $_SESSION[BOOM_PREFIX . 'token'];
		return $_SESSION[BOOM_PREFIX . 'token'];
	}
	else {
		$session = md5(rand(000000,999999));
		$_SESSION[BOOM_PREFIX . 'token'] = $session;
		return $session;
	}
}
function logPending($c){
	return array('log', $c);
}
function modalPending($c, $t, $s = 400){
	return array('modal', $c,$t,$s);
}
function pendingPush($s, $d){
	if(is_array($d)){
		array_push($s, $d);
	}
	return $s;
}
function boomDuplicateIp($val){
	global $mysqli, $data, $cody;
	$dupli = $mysqli->query("SELECT * FROM `boom_banned` WHERE `ip` = '$val'");
	if($dupli->num_rows > 0){
		return true;
	}
}
function checkToken() {
	global $cody;
    if (!isset($_POST['token']) || !isset($_SESSION[BOOM_PREFIX . 'token']) || empty($_SESSION[BOOM_PREFIX . 'token'])) {
        return false;
    }
	if($_POST['token'] == $_SESSION[BOOM_PREFIX . 'token']){
		return true;
	}
    return false;
}

// ranking functions

function getMutedIcon($user, $c){
	global $lang;
	if(isGuestMuted($user)){
		return '<img title="' . $lang['view_only'] . '" class="' . $c . '" src="default_images/actions/guestmuted.svg"/>';
	}
	if(isRegmute($user)){
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/regmuted.svg"/>';
	}
	else if(isMuted($user)){
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/muted.svg"/>';
	}
	else if(isRoomMuted($user)){
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/room_muted.svg"/>';
	}
	else {
		return '';
	}
}

// sex and gender and status functions
function listGender($sex){
	global $lang;
	$list = '';
	$list .= '<option ' . selCurrent($sex, 1) . ' value="1">' . $lang['male'] . '</option>';
	$list .= '<option ' . selCurrent($sex, 2) . ' value="2">' . $lang['female'] . '</option>';
	$list .= '<option ' . selCurrent($sex, 3) . ' value="3">' . $lang['other'] . '</option>';
	return $list;
}
function validGender($sex){
	$gender = array(1,2,3);
	if(in_array($sex, $gender)){
		return true;
	}
}
function getGender($s){
	global $lang;
	switch($s){
		case 1:
			return $lang['male'];
		case 2:
			return $lang['female'];
		case 3:
			return $lang['other'];
		default:
			return $lang['other'];
	}
}
function userGender($g){
	global $lang;
	switch($g){
		case 1:
			return $lang['male'];
		case 2:
			return $lang['female'];
		default:
			return '';
	}
}
function avGender($s){
	global $data;
	if($data['gender_ico'] > 0){
		switch($s){
			case 1:
				return 'avsex boy';
			case 2:
				return 'avsex girl';
			case 3:
				return 'avsex nosex';
			default:
				return 'avsex nosex';
		}
	}
	else {
		return 'avsex nosex';
	}
}

// mobile function

function getMobile() {
	$list = array('mobile','phone','iphone','ipad','ipod','android','silk','kindle','blackberry','opera Mini','opera Mobi','symb');
	foreach($list as $val){
		if(stripos($_SERVER['HTTP_USER_AGENT'], $val) !== false){
			return 1;
		}
	}
	return 0;
} 
function getMobileIcon($user, $c){
	global $lang;
	if($user['user_mobile'] > 0){
		return '<img title="' . $lang['mobile'] . '" class="' . $c . '" src="default_images/icons/mobile.svg"/>';
	}
}

// status functions

function validStatus($val){
	$valid = array(1,2,3,6);
	if($val == 6 && !canInvisible()){
		return false;
	}
	if(in_array($val, $valid)){
		return true;
	}
}
function statusTitle($status){
	global $lang;
	switch($status){
		case 1:  
			return $lang['online'];
		case 2:  
			return $lang['away'];
		case 3:  
			return $lang['busy'];
		case 6:  
			return $lang['invisible'];
		default: 
			return $lang['online'];
	}
}
function statusIcon($status){
	switch($status){
		case 1:
			return 'online.svg';
		case 2:
			return 'away.svg';
		case 3:
			return 'busy.svg';
		case 6:
			return 'invisible.svg';
		default:
			return 'online.svg';
	}	
}
function getStatus($status, $c){
	switch($status){
		case 2:
			return curStatus(statusTitle(2), statusIcon(2), $c);
		case 3:
			return curStatus(statusTitle(3), statusIcon(3), $c);
		default:
			return '';
	}
}
function listStatus($status){
	switch($status){
		case 1:
			return statusMenu(statusTitle(1), statusIcon(1));
		case 2:
			return statusMenu(statusTitle(2), statusIcon(2));
		case 3:
			return statusMenu(statusTitle(3), statusIcon(3));
		case 6:
			return statusMenu(statusTitle(6), statusIcon(6));
		default:
			return statusMenu(statusTitle(1), statusIcon(1));
	}
}
function listAllStatus(){
	$list = '';
	$list .= statusElement(1, statusTitle(1), statusIcon(1));
	$list .= statusElement(2, statusTitle(2), statusIcon(2));
	$list .= statusElement(3, statusTitle(3), statusIcon(3));
	if(canInvisible()){
		$list .= statusElement(6, statusTitle(6), statusIcon(6));
	}
	return $list;
}
function newStatusIcon($status){
	return 'default_images/status/' . statusIcon($status);
}
function curStatus($txt, $icon, $c){
	return '<img title="' . $txt . '" class="' . $c . '" src="default_images/status/' . $icon . '"/>';	
}
function statusMenu($txt, $icon){
	return '<div class="status_zone"><img class="status_icon" src="default_images/status/' . $icon . '"/></div><div class="status_text">' . $txt . '</div>';
}
function statusElement($val, $txt, $icon){
	return '<div class="status_option sub_item" onclick="updateStatus(' . $val . ');" data="' . $val . '">
				<div class="zone_status"><img class="icon_status" src="default_images/status/' . $icon . '"/></div>
				<div class="icon_text">' . $txt . '</div>
			</div>';
}

// system ranking define name and functions

function botRankTitle(){
	global $lang;
	return $lang['user_bot'];
}
function botRankIcon(){
	global $lang;
	return 'bot.svg';
}
function rankIcon($rank){
	switch($rank){
		case 0:
			return 'guest.svg';
		case 1:
			return 'user.svg';
		case 2:
			return 'vip.svg';
		case 8:
			return 'mod.svg';
		case 9:
			return 'admin.svg';
		case 10:
			return 'super.svg';
		case 11:
			return 'owner.svg';
		default:
			return 'user.svg';
	}
}
function rankTitle($rank){
	global $lang;
	switch($rank){
		case 0:
			return $lang['guest'];
		case 1:
			return $lang['user'];
		case 2:
			return $lang['vip'];
		case 8:
			return $lang['mod'];
		case 9:
			return $lang['admin'];
		case 10:
			return $lang['super_admin'];
		case 11:
			return $lang['owner'];
		case 99:
			return $lang['nobody'];
		default:
			return $lang['user'];
	}
}
function roomRankTitle($rank){
	global $lang;
	switch($rank){
		case 6:
			return $lang['r_owner'];
		case 5:
			return $lang['r_admin'];
		case 4:
			return $lang['r_mod'];
		default:
			return $lang['user'];
	}
}
function roomRankIcon($rank){
	switch($rank){
		case 6:
			return 'room_owner.svg';
		case 5:
			return 'room_admin.svg';
		case 4:
			return 'room_mod.svg';
		default:
			return 'user.svg';
	}
}
function botRank($type){
	return curRanking($type, botRankTitle(), botRankIcon());
}
function systemRank($rank, $type){
	switch($rank){
		case 2:
		case 8:
		case 9:
		case 10:
		case 11:
			return curRanking($type, rankTitle($rank), rankIcon($rank));
		default:
			return '';
	}
}
function proRanking($user, $type){
	if(isBot($user)){
		return proRank($type, botRankTitle(), botRankIcon());
	}
	else {
		switch($user['user_rank']){
			case 0:
			case 1:
			case 2:
			case 8:
			case 9:
			case 10:
			case 11:
				return proRank($type, rankTitle($user['user_rank']), rankIcon($user['user_rank']));
			default:
				return '';
		}
	}
}
function roomRank($rank, $type){
	switch($rank){
		case 6:
		case 5:
		case 4:
			return curRanking($type, roomRankTitle($rank), roomRankIcon($rank));
		default:
			return '';
	}
}
function listRank($current, $req = 0){
	global $data;
	$rank = '';
	if($req == 1){
		$rank .= '<option value="0" ' . selCurrent($current, 0) . '>' . rankTitle(0) . '</option>';
	}
	$rank .= '<option value="1" ' . selCurrent($current, 1) . '>' . rankTitle(1) . '</option>';
	$rank .= '<option value="2" ' . selCurrent($current, 2) . '>' . rankTitle(2) . '</option>';
	$rank .= '<option value="8" ' . selCurrent($current, 8) . '>' . rankTitle(8) . '</option>';
	$rank .= '<option value="9" ' . selCurrent($current, 9) . '>' . rankTitle(9) . '</option>';
	$rank .= '<option value="10" ' . selCurrent($current, 10) . '>' . rankTitle(10) . '</option>';
	$rank .= '<option value="11" ' . selCurrent($current, 11) . '>' . rankTitle(11) . '</option>';
	$rank .= '<option value="99" ' . selCurrent($current, 99) . '>' . rankTitle(99) . '</option>';
	return $rank;
}
function changeRank($current){
	global $data, $cody;
	$rank = '';
	if(boomAllow($cody['can_rank'])){
		$rank .= '<option value="1" ' . selCurrent($current, 1) . '>' . rankTitle(1) . '</option>';
		$rank .= '<option value="2" ' . selCurrent($current, 2) . '>' . rankTitle(2) . '</option>';
		$rank .= '<option value="8" ' . selCurrent($current, 8) . '>' . rankTitle(8) . '</option>';
	}
	if(boomAllow(11)){
		$rank .= '<option value="9" ' . selCurrent($current, 9) . '>' . rankTitle(9) . '</option>';
		$rank .= '<option value="10" ' . selCurrent($current, 10) . '>' . rankTitle(10) . '</option>';
	}
	return $rank;
}
function listRoomRank($current = 0){
	global $lang, $data;
	$rank = '';
	$rank .= '<option value="0" ' . selCurrent($current, 0) . '>' . $lang['none'] . '</option>';
	$rank .= '<option value="4" ' . selCurrent($current, 4) . '>' . roomRankTitle(4) . '</option>';
	$rank .= '<option value="5" ' . selCurrent($current, 5) . '>' . roomRankTitle(5) . '</option>';
	if(boomAllow(9)){
		$rank .= '<option value="6" ' . selCurrent($current, 6) . '>' . roomRankTitle(6) . '</option>';
	}
	return $rank;
}
function curRanking($type, $txt, $icon){
	return '<img src="default_images/rank/' . $icon . '" class="' . $type . '" title="' . $txt . '"/>';
}
function proRank($type, $txt, $icon){
	return '<img src="default_images/rank/' . $icon . '" class="' . $type . '"/> ' . $txt;
}
function getRankIcon($list, $type){
	if(isBot($list)){
		return botRank($type);
	}
	else if(haveRole($list['user_role']) && !isStaff($list['user_rank'])){
		return roomRank($list['user_role'], $type);
	}
	else {
		return systemRank($list['user_rank'], $type);
	}
}

// room access ranking functions

function roomAccessTitle($room){
	global $lang;
	switch($room){
		case 0:
			return $lang['public'];
		case 1:
			return $lang['members'];
		case 2:
			return $lang['vip'];
		case 8:
			return $lang['staff'];
		case 9:
			return $lang['admin'];
		default:
			return $lang['public'];
	}
}
function roomAccessIcon($room){
	global $lang;
	switch($room){
		case 0:
			return 'public_room.svg';
		case 1:
			return 'member_room.svg';
		case 2:
			return 'vip_room.svg';
		case 8:
			return 'staff_room.svg';
		case 9:
			return 'admin_room.svg';
		default:
			return 'public_room.svg';
	}
}
function roomRanking($rank = 0){
	global $lang;
	$room_menu = '<option value="0" ' . selCurrent($rank, 0) . '>' . roomAccessTitle(0) . '</option>';
	if(boomAllow(1)){
		$room_menu .= '<option value="1" ' . selCurrent($rank, 1) . '>' . roomAccessTitle(1) . '</option>';
	}
	if(boomAllow(2)){ 
		$room_menu .= '<option value="2" ' . selCurrent($rank, 2) . '>' . roomAccessTitle(2) . '</option>';
	}
	if(boomAllow(8)){ 
		$room_menu .= '<option value="8" ' . selCurrent($rank, 8) . '>' . roomAccessTitle(8) . '</option>';
	}
	if(boomAllow(9)){ 
		$room_menu .= '<option value="9" ' . selCurrent($rank, 9) . '>' . roomAccessTitle(9) . '</option>';
	}
	return $room_menu;
}
function roomIcon($room, $type){
	global $lang;
	switch($room['access']){
		case 0:
		case 1:
		case 2:
		case 8:
		case 9:
			return roomIconTemplate($type, roomAccessTitle($room['access']), roomAccessIcon($room['access']));
		default:
			return roomIconTemplate($type, roomAccessTitle(0), roomAccessIcon(0));
	}
}
function roomIconTemplate($type, $txt, $icon){
	global $data;
	return '<img title="' . $txt . '" class="' . $type .  '" src="' . $data['domain'] . '/default_images/rooms/' . $icon . '">';	
}
function roomLock($room, $type){
	global $data, $lang;
	if($room['password'] != ''){
		return '<img title="' . $lang['password'] . '" class="' . $type .  '" src="' . $data['domain'] . '/default_images/rooms/locked_room.svg">';
	}
}

// permission functions

function canEditRoom(){
	if(boomRole(6) || boomAllow(9)){
		return true;
	}
}
function canManageRoom(){
	if(boomRole(4) || boomAllow(9)){
		return true;
	}
}
function canUploadChat(){
	global $data;
	if(boomAllow($data['allow_cupload'])){
		return true;
	}
}
function canUploadPrivate(){
	global $data;
	if(boomAllow($data['allow_pupload'])){
		return true;
	}
}
function canUploadWall(){
	global $data;
	if(boomAllow($data['allow_wupload'])){
		return true;
	}
}
function canCover(){
	global $data;
	if(boomAllow($data['allow_cover'])){
		return true;
	}
}
function canGifCover(){
	global $data;
	if(boomAllow($data['allow_gcover'])){
		return true;
	}
}
function canRoom(){
	global $data;
	if(boomAllow($data['allow_room'])){
		return true;
	}
}
function canEmo(){
	global $data;
	if(boomAllow($data['emo_plus'])){
		return true;
	}
}
function canName(){
	global $data;
	if(boomAllow($data['allow_name'])){
		return true;
	}
}
function canDirect(){
	global $data;
	if(boomAllow($data['allow_direct'])){
		return true;
	}
}
function userCanDirect($user){
	global $data;
	if(userBoomAllow($user, $data['allow_direct'])){
		return true;
	}
}
function canColor(){
	global $data;
	if(boomAllow($data['allow_colors'])){
		return true;
	}
}
function canGrad(){
	global $data;
	if(boomAllow($data['allow_grad'])){
		return true;
	}
}
function canNeon(){
	global $data;
	if(boomAllow($data['allow_neon'])){
		return true;
	}
}
function canFont(){
	global $data;
	if(useFont() && boomAllow($data['allow_font'])){
		return true;
	}
}
function canMood(){
	global $data;
	if(boomAllow($data['allow_mood'])){
		return true;
	}
}
function canVerify(){
	global $data;
	if(boomAllow($data['allow_verify'])){
		return true;
	}
}
function canHistory(){
	global $data;
	if(boomAllow($data['allow_history'])){
		return true;
	}
}
function canAvatar(){
	global $data;
	if(boomAllow($data['allow_avatar'])){
		return true;
	}
}
function canTheme(){
	global $data;
	if(boomAllow($data['allow_theme'])){
		return true;
	}
}
function canInfo(){
	global $cody;
	if(boomAllow($cody['can_edit_info'])){
		return true;
	}
}
function canAbout(){
	global $cody;
	if(boomAllow($cody['can_edit_about'])){
		return true;
	}
}
function canNameColor(){
	global $data;
	if(boomAllow($data['allow_name_color'])){
		return true;
	}
}
function canNameGrad(){
	global $data;
	if(boomAllow($data['allow_name_grad'])){
		return true;
	}
}
function canNameNeon(){
	global $data;
	if(boomAllow($data['allow_name_neon'])){
		return true;
	}
}
function canNameFont(){
	global $data;
	if(useFont() && boomAllow($data['allow_name_font'])){
		return true;
	}
}
function canInvisible(){
	global $data, $cody;
	if(boomAllow($cody['can_invisible'])){
		return true;
	}
}
function canPostNews(){
	global $data, $cody;
	if(boomAllow($cody['can_post_news'])){
		return true;
	}
}
function canModifyAvatar($user){
	global $data, $cody;
	if(!empty($user) && canAvatar() && canEditUser($user, $cody['can_modify_avatar'])){
		return true;
	}
}
function canModifyCover($user){
	global $data, $cody;
	if(!empty($user) && canCover() && canEditUser($user, $cody['can_modify_cover'])){
		return true;
	}
}
function canModifyName($user){
	global $data, $cody;
	if(!empty($user) && canName() && canEditUser($user, $cody['can_modify_name'])){
		return true;
	}
}
function canModifyMood($user){
	global $data, $cody;
	if(!empty($user) && canMood() && canEditUser($user, $cody['can_modify_mood'])){
		return true;
	}
}
function canModifyAbout($user){
	global $data, $cody;
	if(!empty($user) && canEditUser($user, $cody['can_modify_about'])){
		return true;
	}
}
function canModifyEmail($user){
	global $data, $cody;
	if(!empty($user) && isMember($user) && isSecure($user) && canEditUser($user, $cody['can_modify_email'], 1)){
		return true;
	}
}
function canModifyColor($user){
	global $data, $cody;
	if(!empty($user) && canNameColor() && canEditUser($user, $cody['can_modify_color'])){
		return true;
	}
}
function canModifyPassword($user){
	global $data, $cody;
	if(!empty($user) && isMember($user) && isSecure($user) && canEditUser($user, $cody['can_modify_password'], 1)){
		return true;
	}
}
function canUserHistory($user){
	global $data, $cody;
	if(!empty($user) && canEditUser($user, $cody['can_view_history'], 1)){
		return true;
	}
}
function canViewInvisible(){
	global $cody;
	if(boomAllow($cody['can_inv_view'])){
		return true;
	}
}
function canViewTimezone($user){
	global $data, $cody;
	if(canEditUser($user, $cody['can_view_timezone'], 1)){
		return true;
	}
}
function canViewEmail($user){
	global $data, $cody;
	if(userHaveEmail($user) && canEditUser($user, $cody['can_view_email'], 1)){
		return true;
	}
}
function canViewId($user){
	global $data, $cody;
	if(canEditUser($user, $cody['can_view_id'], 1)){
		return true;
	}
}
function canCritera($t){
	if(boomAllow($t)){
		return true;
	}
}
function canViewIp($user){
	global $data, $cody;
	if(canEditUser($user, $cody['can_view_ip'], 1)){
		return true;
	}
}
function canRoomPassword(){
	global $data, $cody;
	if(boomAllow($cody['can_room_pass']) || boomRole(6)){
		return true;
	}
}
function canBan(){
	global $data, $cody;
	if(boomAllow($cody['can_ban'])){
		return true;
	}
}
function canBanUser($user){
	global $data, $cody;
	if(!empty($user) && canEditUser($user, $cody['can_ban'], 1)){ 
		return true;
	}
}
function canRankUser($user){
	global $data, $cody;
	if(isOwner($user) || isGuest($user)){
		return false;
	}
	if(!empty($user) && canEditUser($user, $cody['can_rank'], 0)){ 
		return true;
	}
}
function canDeleteUser($user){
	global $data, $cody;
	if(isOwner($user)){
		return false;
	}
	if(!empty($user) && canEditUser($user, $cody['can_delete'], 1)){ 
		return true;
	}
}
function canKick(){
	global $data, $cody;
	if(boomAllow($cody['can_kick'])){
		return true;
	}
}
function canKickUser($user){
	global $data, $cody;
	if(!empty($user) && canEditUser($user, $cody['can_kick'], 1)){ 
		return true;
	}
}
function canDeleteNews($news){
	global $data, $cody;
	if(mySelf($news['news_poster'])){
		return true;
	}
	if(boomAllow($cody['can_delete_news']) && isGreater($news['user_rank'])){
		return true;
	}
}
function canDeleteNewsReply($reply){
	global $data, $cody;
	if(mySelf($reply['reply_uid'])){
		return true;
	}
	if(boomAllow($cody['can_delete_news']) && isGreater($reply['user_rank'])){
		return true;
	}
}
function canDeleteWall($wall){
	global $data, $cody;
	if(mySelf($wall['post_user'])){ 
		return true;
	}
	if(boomAllow($cody['can_delete_wall']) && isGreater($wall['user_rank'])){
		return true;
	}
}
function canDeleteWallReply($wall){
	global $data, $cody;
	if(mySelf($wall['reply_user'])){
		return true;
	}
	if(mySelf($wall['reply_uid'])){ 
		return true;
	}
	if(boomAllow($cody['can_delete_wall']) && isGreater($wall['user_rank'])){
		return true;
	}
}
function canDeleteLog(){
	global $cody;
	if(boomAllow(1) && boomAllow($cody['can_delete_logs'])){
		return true;
	}
}
function canDeleteSelfLog($p){
	global $data, $cody;
	if($p['user_id'] == $data['user_id'] && boomAllow($cody['can_delete_slogs'])){
		return true;
	}
}
function canReport(){
	global $cody;
	if(boomAllow($cody['can_report'])){
		return true;
	}
}
function canManageReport(){
	global $cody;
	if(boomAllow($cody['can_manage_report'])){
		return true;
	}
}
function selfManageReport($id){
	global $cody;
	if(!mySelf($id)){
		return true;
	}
	if(mySelf($id) && boomAllow($cody['can_self_report'])){
		return true;
	}
}
function canDeletePrivate(){
	global $cody;
	if(boomAllow($cody['can_delete_private'])){
		return true;
	}
}
function canDeleteRoomLog(){
	if(boomAllow(1) && boomRole(4)){
		return true;
	}
}
function canClearRoom(){
	global $cody;
	if(boomAllow($cody['can_clear_room'])){
		return true;
	}
}

// DO NOT MODIFY THE MUTE PERMISSION THIS WILL MAKE CONFLICT IN THE SYSTEM.

function canMute(){
	global $data, $cody;
	if(boomAllow(8)){
		return true;
	}
}
function canMuteUser($user){
	global $data, $cody;
	if(!empty($user) && canEditUser($user, 8, 1)){ 
		return true;
	}
}

function fileFlood(){
	global $cody;
	$f = basename($_SERVER['PHP_SELF']);
	$t1 = round(microtime(true)*1000);
	$t2 = round(microtime(true)*1000) - 500;
	
	if(isset($_SESSION[BOOM_PREFIX . 'ufile'], $_SESSION[BOOM_PREFIX . 'ufiletime'])){
		if($_SESSION[BOOM_PREFIX . 'ufile'] == $f && $_SESSION[BOOM_PREFIX . 'ufiletime'] >= $t2){
			return true;
		}
		else {
			$_SESSION[BOOM_PREFIX . 'ufiletime'] = $t1;
			$_SESSION[BOOM_PREFIX . 'ufile'] = $f;
			return false;
		}
	}
	else {
		$_SESSION[BOOM_PREFIX . 'ufiletime'] = $t1;
		$_SESSION[BOOM_PREFIX . 'ufile'] = $f;
		return false;
	}
}
?>