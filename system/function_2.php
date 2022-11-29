<?php
function boomLogged(){
	global $boom_access;
	if($boom_access == 1){
		return true;
	}
}
function emoprocess($string) {
	$string = str_replace(array(':)',':P',':D',':(',':-O'),array(':smile:',':tongue:',':smileface:',':sad:',':omg:'), $string);
	return $string;
}
function normalise($text, $a){
	$count = substr_count($text,"http");
	if($count > $a){
		return false;
	}
	return true;
}
function burl(){
	$ht = 'http';
	if(isset($_SERVER['HTTPS'])){
		$ht = 'https';
	}
	$burl = $ht . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $burl;
}
function inRoom(){
	global $data;
	if($data['user_roomid'] != '0'){
		return true;
	}
}
function userInRoom($user){
	if($user['user_roomid'] != '0'){
		return true;
	}
}
function myRoom($room){
	global $data;
	if($data['user_roomid'] == $room){
		return true;
	}
}
function mustVerify(){
	global $data;
	if($data['user_verify'] != 0 && !isStaff($data['user_rank']) &&  $data['activation'] == 1 ){
		return true;
	}
}
function clearBoomCache(){
	global $mysqli;
	$mysqli->query("UPDATE boom_setting SET bbfv = bbfv + 0.05");
}
function boomVersionUpdate($v){
	global $mysqli, $data;
	$mysqli->query("UPDATE boom_setting SET version = '$v' WHERE id > 0");
}
function verified($user){
	if($user['verified'] > 0){
		return true;
	}
}
function usePlayer(){
	global $data;
	if($data['player_id'] != 0){
		return true;
	}
}
function maintMode(){
	global $data, $cody;
	if(boomLogged()){
		if($data['maint_mode'] > 0 && !boomAllow($cody['can_maintenance'])){
			return true;
		}
	}
}
function boomThisText($text){
	global $lang, $data;
	$text = str_replace(
	array(
		'%email%',
		'%user%', 
		'%cemail%',
	),
	array(
		$data['user_email'],
		$data['user_name'],
		'<span class="theme_color">' . $data['user_email'] . '</span>',
	),
	$text);
	return $text;
}
function isBoomJson($res){
	if(is_string($res) && is_array(json_decode($res, true)) && (json_last_error() == JSON_ERROR_NONE)){
		return true;
	}
}
function isBoomObject($res){
	if(is_object($res)){
		return true;
	}
}
function getUserTheme($theme){
	global $data;
	if($theme == 'system'){
		return $data['default_theme'];
	}
	else {
		return $theme;
	}
}
function boomSex($s){
	if($s != 0){
		return true;
	}
}
function boomAge($a){
	if($a != 0){
		return true;
	}
}
function pageMenu($load, $icon, $txt, $rank = 0){
	if(okMenu($rank)){
		$menu = array(
			'load'=> $load,
			'icon'=> $icon,
			'txt'=> $txt,
		);
		return boomTemplate('element/page_menu', $menu);
	}
}
function pageMenuFunction($load, $icon, $txt, $rank = 0){
	if(okMenu($rank)){
		$menu = array(
			'load'=> $load,
			'icon'=> $icon,
			'txt'=> $txt, 
		);
		return boomTemplate('element/page_menu_function', $menu);
	}
}
function pageDropMenu($icon, $txt, $drop, $rank = 0){
	if(okMenu($rank)){
		$menu = array(
			'icon'=> $icon,
			'txt'=> $txt,
			'drop'=> $drop,
		);
		return boomTemplate('element/page_drop_menu', $menu);
	}
}
function pageDropItem($load, $txt, $rank = 0){
	if(okMenu($rank)){
		$menu = array(
			'load'=> $load,
			'txt'=> $txt
		);
		return boomTemplate('element/page_drop_item', $menu);
	}
}
function okMenu($rank){
	if($rank == 0){
		return true;
	}
	if(boomLogged() && boomAllow($rank)){
		return true;
	}
}
function roomType($type){
	global $data;
	if($type >= 0 && $type <= $data['user_rank']){
		return true;
	}
}
function bannedIp($ip){
	global $mysqli, $data;
	$getip = $mysqli->query("SELECT * FROM boom_banned WHERE ip = '$ip'");
	if($getip->num_rows > 0){
		return true;
	}
}
function checkBan($ip){
	global $mysqli, $data;
	if(boomLogged()){
		if(boomAllow(11)){
			return false;
		}
		if(isBanned($data)){
			return true;
		}
		else {
			$getip = $mysqli->query("SELECT * FROM boom_banned WHERE ip = '$ip'");
			if($getip->num_rows > 0){
				return true;
			}
		}
	}
}
function checkKick(){
	global $mysqli, $data;
	if(boomLogged()){
		if(kickedData($data)){
			if(isKicked($data)){
				if(boomAllow(11)){
					removeAllAction($user);
				}
				else {
					return true;
				}
			}
			else {
				userUnkick($data);
			}
		}
	}
}
function removeAllAction($user){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_kick = 0, user_mute = 0, user_ban = 0, user_regmute = 0 WHERE user_id = {$user['user_id']}");
}
function boomStaffContact($id){
	global $mysqli;
	$user = userDetails($id);
	if(empty($user)){
		return false;
	}
	if(isStaff($user['user_rank'])){
		return true;
	}
}
function useLobby(){
	global $data;
	if($data['use_lobby'] == 1){
		return true;
	}
}
function useFont(){
	global $data;
	if(boomActive($data['allow_font']) || boomActive($data['allow_name_font'])){
		return true;
	}
}
function clearPrivate($hunter, $target){
	global $mysqli;
	$mysqli->query("DELETE FROM boom_private WHERE hunter = '$hunter' AND target = '$target' OR hunter = '$target' AND target = '$hunter'");
	return 1;
}
function _isCurl(){
    return function_exists('curl_version');
}
function optionCount($sel, $min, $max, $divider, $alias = ''){
	$val = '';
	for ($n = $min; $n <= $max; $n+=$divider) {
		$val .= '<option value="' . $n . '" ' . selCurrent($sel, $n) . '>' . $n . ' ' . $alias . '</option>';
	}
	return $val;
}
function optionMinutes($sel, $list = array()){
	$val = '';
	foreach($list as $n) {
		$val .= '<option value="' . $n . '" ' . selCurrent($sel, $n) . '>' . boomRenderMinutes($n) . '</option>';
	}
	return $val;
}
function optionSeconds($sel, $list = array()){
	$val = '';
	foreach($list as $n) {
		$val .= '<option value="' . $n . '" ' . selCurrent($sel, $n) . '>' . boomRenderSeconds($n) . '</option>';
	}
	return $val;
}
function bridgeMode($type){
	global $data;
	if($data['use_bridge'] == $type){
		return true;
	}
}
function getConfig($val){
	global $data;
	return $data[$val];
}
function minText($val){
	global $lang;
	return str_replace('%number%', $val, $lang['min_text']);
}
function sessionCleanup(){
	global $cody;
	unset($_SESSION['facebook_access_token']);
	unset($_SESSION[BOOM_PREFIX . 'token']);
	unset($_SESSION[BOOM_PREFIX . 'last']);
	unset($_SESSION[BOOM_PREFIX . 'flood']);
	unset($_SESSION['HA::STORE']);
	unset($_SESSION['HA::CONFIG']);
	unset($_SESSION['FBRLH_state']);
	unset($_SESSION['token']);
}
function trimContent($text){
	$text = str_ireplace(array('****', 'system__', 'public__', 'my_notice', '%bcclear%', '%bcjoin%', '%bcquit%', '%bckick%', '%bcban%', '%bcmute%', '%bcname%', '%spam%'), '*****', $text);
	return $text;
}
function getBoomName($name, $connection){
	$t = 0;
	$tcount = 0;
	$try = $name;
	while($t == 0){
		$tdouble = $connection->query("SELECT * FROM boom_users WHERE user_name = '$try'");
		if($tdouble->num_rows > 0){
			$tcount++;
			$try = $name . $tcount;
		}
		else{
			$t = 1;
		}
	}
	return $try;
}
function colorChoice($sel, $type, $min = 1){
	global $cody;
	$show_c = '';
	switch($type){
		case 1:
			$c = 'choice';
			break;
		case 2:
			$c = 'user_choice';
			break;
		case 3:
			$c = 'name_choice';
			break;
		default:
			return false;
	}
	for ($n = $min; $n <= $cody['color_count']; $n++) {
		$val = 'bcolor' . $n;
		$back = 'bcback' . $n;
		$add_sel = '';
		if($val == $sel){
			$add_sel = '<i class="fa fa-check bccheck"></i>';
		}
		$show_c .= '<div data="' . $val . '" class="color_switch ' . $c . ' ' . $back . '">' . $add_sel . '</div>';
	}
	return $show_c;
}
function gradChoice($sel, $type, $min = 1){
	global $cody;
	$show_c = '';
	switch($type){
		case 1:
			$c = 'choice';
			break;
		case 2:
			$c = 'user_choice';
			break;
		case 3:
			$c = 'name_choice';
			break;
		default:
			return false;
	}
	for ($n = $min; $n <= $cody['gradient_count']; $n++) {
		$val = 'bgrad' . $n;
		$back = 'backgrad' . $n;
		$add_sel = '';
		if($val == $sel){
			$add_sel = '<i class="fa fa-check bccheck"></i>';
		}
		$show_c .= '<div data="' . $val . '" class="color_switch ' . $c . ' ' . $back . '">' . $add_sel . '</div>';
	}
	return $show_c;
}
function neonChoice($sel, $type, $min = 1){
	global $cody;
	$show_c = '';
	switch($type){
		case 1:
			$c = 'choice';
			break;
		case 2:
			$c = 'user_choice';
			break;
		case 3:
			$c = 'name_choice';
			break;
		default:
			return false;
	}
	for ($n = $min; $n <= $cody['neon_count']; $n++) {
		$val = 'bneon' . $n;
		$back = 'bnback' . $n;
		$add_sel = '';
		if($val == $sel){
			$add_sel = '<i class="fa fa-check bccheck"></i>';
		}
		$show_c .= '<div data="' . $val . '" class="color_switch ' . $c . ' ' . $back . '">' . $add_sel . '</div>';
	}
	return $show_c;
}
function boomFileSpace($f){
	return str_replace(' ', '_', $f);
}
function registerBlock($ip){
	global $mysqli, $data, $cody;
	if(bannedIp($ip)){
		return true;
	}
	if($cody['reg_filter'] == 1){
		$check = $mysqli->query("SELECT user_kick, user_banned, user_mute FROM boom_users WHERE user_ip = '$ip' AND ( user_kick > " . time() . " OR user_banned > 0 OR user_mute > " . time() . ")");
		if($check->num_rows > 0){
			while($user = $check->fetch_assoc()){
				if(isBanned($user) || isKicked($user) || isMuted($user)){
					return true;
				}
			}
		}
	}
}
function registerMax($ip, $max, $type = 0){
	global $mysqli, $data;
	$reg_delay = calDay(1);
	$add_query = '';
	if($type == 1){
		$add_query = "AND user_rank = 0";
	}
	$accounts = $mysqli->query("SELECT user_id FROM boom_users WHERE user_ip = '$ip' AND user_join >= '$reg_delay' $add_query");
	if($accounts->num_rows >= $max){
		return true;
	}
}
function boomOkRegister($ip){
	global $mysqli, $data, $cody;
	$good = 0;
	$counting = 0;
	if(registerblock($ip)){
		return false;
	}
	if(registerMax($ip, $cody['max_reg'])){
		return false;
	}
	return true;
}
function guestCanRegister(){
	global $data;
	if(isGuest($data) && registration()){
		return true;
	}
}
function okGuest($ip){
	global $mysqli, $data, $cody;
	if(registerBlock($ip)){
		return false;
	}
	if(registerMax($ip, $cody['guest_per_day'], 1)){
		return false;
	}
	return true;
}
function smiliesType(){
	return array('.png', '.svg', '.gif');
}
function listSmilies($type){
	$supported = smiliesType();
	switch($type){
		case 1:
			$emo_act = 'content';
			$closetype = 'closesmilies';
			break;
		case 2:
			$emo_act = 'message_content';
			$closetype = 'closesmilies_priv';
			break;
	}
	$files = scandir(BOOM_PATH . '/emoticon');
	foreach ($files as $file){
		if ($file != "." && $file != ".."){
			$smile = preg_replace('/\.[^.]*$/', '', $file);
			foreach($supported as $sup){
				if(strpos($file, $sup)){
					echo '<div  title=":' . $smile . ':" class="emoticon ' . $closetype . '"><img  class="lazyboom" data-img="emoticon/' . $smile . $sup . '" src="" onclick="emoticon(\'' . $emo_act . '\', \':' . $smile . ':\')"/></div>';;
				}
			}
		}
	}
}
function boomMoveFile($source){
	move_uploaded_file(preg_replace('/\s+/', '', $_FILES["file"]["tmp_name"]), BOOM_PATH . '/' . $source);
}
function validImageData($source){
	$i = getimagesize(BOOM_PATH . '/' . $source);
	if($i !== false){
		return true;
	}
}
function sourceExist($source){
	if(file_exists(BOOM_PATH . '/' . $source)){
		return true;
	}
}
function createTumbnail($source, $path, $type, $width, $height, $sizew, $sizeh) {
	$dst    = @imagecreatetruecolor($sizew, $sizeh);
	switch ($type) {
		case 'image/gif':
			$src = @imagecreatefromgif(BOOM_PATH . '/' . $source);
			break;
		case 'image/png':
			$src = @imagecreatefrompng(BOOM_PATH . '/' . $source);
			break;
		case 'image/jpeg':
			$src = @imagecreatefromjpeg(BOOM_PATH . '/' . $source);
			break;
		default:
			return false;
			break;
	}
	$new_width  = $height * $sizew / $sizeh;
	$new_height = $width * $sizeh / $sizew;
	if ($new_width > $width) {
		$h = (($height - $new_height) / 2);
		@imagecopyresampled($dst, $src, 0, 0, 0, $h, $sizew, $sizeh, $width, $new_height);
	} else {
		$w = (($width - $new_width) / 2);
		@imagecopyresampled($dst, $src, 0, 0, $w, 0, $sizew, $sizeh, $new_width, $height);
	}
	switch ($type) {
		case 'image/gif':
			@imagegif($dst, BOOM_PATH . '/' . $path, 80);
			break;
		case 'image/png':
			@imagejpeg($dst, BOOM_PATH . '/' . $path, 80);
			break;
		case 'image/jpeg':
			@imagejpeg($dst, BOOM_PATH . '/' . $path, 80);
			break;
		default:
			return false;
			break;
	}
	if ($dst)
		@imagedestroy($dst);
	if ($src)
		@imagedestroy($src);
}
function imageTumb($source, $path, $type, $size) {
	$dst = '';
	switch ($type) {
		case 'image/png':
			$src = @imagecreatefrompng(BOOM_PATH . '/' . $source);
			break;
		case 'image/jpeg':
			$src = @imagecreatefromjpeg(BOOM_PATH . '/' . $source);
			break;
		default:
			return false;
			break;
	}
    $width = imagesx($src);
    $height = imagesy($src);
    $new_width = floor($width * ($size / $height));
    $new_height = $size;
	if($height > $size){
		$dst = @imagecreatetruecolor($new_width, $new_height);
		if($type == 'image/png'){
			@imagecolortransparent($dst, imagecolorallocate($dst, 0, 0, 0));
			@imagealphablending( $dst, false );
			@imagesavealpha( $dst, true );
		}
		@imagecopyresized($dst, $src, 0,0,0,0,$new_width,$new_height,$width,$height);
		switch ($type) {
			case 'image/png':
				@imagepng($dst, BOOM_PATH . '/' . $path);
				break;
			case 'image/jpeg':
				@imagejpeg($dst, BOOM_PATH . '/' . $path);
				break;
			default:
				return false;
				break;
		}
	}
	if($dst != ''){
		@imagedestroy($dst);
	}
	if($src){
		@imagedestroy($src);
	}
}
function imageTumbGif($source, $path, $type, $size) {
	$dst = '';
	switch ($type) {
		case 'image/gif':
			$src = @imagecreatefromgif(BOOM_PATH . '/' . $source);
			break;
		case 'image/png':
			$src = @imagecreatefrompng(BOOM_PATH . '/' . $source);
			break;
		case 'image/jpeg':
			$src = @imagecreatefromjpeg(BOOM_PATH . '/' . $source);
			break;
		default:
			return false;
			break;
	}
    $width = imagesx($src);
    $height = imagesy($src);
	if($height > $size){
		$new_width = floor($width * ($size / $height));
		$new_height = $size;
	}
	else {
		$new_width = $width;
		$new_height = $height;
	}
	$dst = @imagecreatetruecolor($new_width, $new_height);
	if($type == 'image/png'){
		@imagecolortransparent($dst, imagecolorallocate($dst, 0, 0, 0));
		@imagealphablending( $dst, false );
		@imagesavealpha( $dst, true );
	}
	@imagecopyresized($dst, $src, 0,0,0,0,$new_width,$new_height,$width,$height);
	switch ($type) {
		case 'image/gif':
			@imagegif($dst, BOOM_PATH . '/' . $path);
			break;
		case 'image/png':
			@imagepng($dst, BOOM_PATH . '/' . $path);
			break;
		case 'image/jpeg':
			@imagejpeg($dst, BOOM_PATH . '/' . $path);
			break;
		default:
			return false;
			break;
	}
	if($dst != ''){
		@imagedestroy($dst);
	}
	if($src){
		@imagedestroy($src);
	}
}
function validName($name){
	global $data, $mysqli;
	$lowname = mb_strtolower($name);
	$reserved = array('system__', 'public__', 'my_notice');
	foreach ($reserved as $sreserve){
		if(stripos($lowname,mb_strtolower($sreserve)) !== FALSE){
			return false;
		}
	}
	$get_name = $mysqli->query("SELECT word FROM boom_filter WHERE word_type != 'email'");
	if($get_name->num_rows > 0){
		while($reject = $get_name->fetch_assoc()){
			if (stripos($lowname, mb_strtolower($reject['word'])) !== FALSE) {
				return false;
			}
		}
	}
	$regex = 'a-zA-Z0-9\p{Arabic}\p{Cyrillic}\p{Latin}\p{Han}\p{Katakana}\p{Hiragana}\p{Hebrew}';
	if(preg_match('/^[' . $regex . ']{1,}([\-\_ ]{1})?([' . $regex . ']{1,})?$/ui', $name) && mb_strlen($name, 'UTF-8') <= $data['max_username'] && !ctype_digit($name) && mb_strlen($name, 'UTF-8') >= 2){
		return true;
	}
	return false;
}
function doCurl($url, $f = array()){
	$result = '';
	if(function_exists('curl_init')){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		if(!empty($f)){
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $f);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_REFERER, @$_SERVER['HTTP_HOST']);
		$result = curl_exec($curl);
		if(curl_errno($curl)){
			$result = '';
		}
		curl_close($curl);
	}
	return $result;
}
function trimCommand($text, $trim){
	return trim(str_replace($trim, '', $text));
}
function encodeFile($ext){
	global $data;
	$file_name = md5(microtime());
	$file_name = substr($file_name, 0, 12);
	return 'user' . $data['user_id'] . '_' . $file_name . "." . $ext;
}
function encodeFileTumb($ext, $user){
	global $data;
	$file_name = md5(microtime());
	$file_name = substr($file_name, 0, 12);
	$fname['full'] = 'user' . $user['user_id'] . '_' . $file_name . '.' . $ext;
	$fname['tumb'] = 'user' . $user['user_id'] . '_' . $file_name . '_tumb.'. $ext;
	return $fname;
}
function listAge($current, $type){
	global $data, $lang;
	$age = '';
	if($type == 1){
		$age .= '<option value="0" class="placeholder" selected disabled>' . $lang['age'] . '</option>';
	}
	for($value = $data['min_age']; $value <= 99; $value++){
		$age .=  '<option value="' . $value . '" ' . selCurrent($current, $value) . '>' . $value . '</option>';
	}
	if($type == 2){
		$age .=  '<option value="0" ' . selCurrent($current, 0) . '>' . $lang['not_shared'] . '</option>';
	}
	return $age;
}
function yesNo($value){
	global $lang;
	$menu = '';
	$menu .= '<option value="1" ' . selCurrent($value, 1) . '>' . $lang['yes'] . '</option>';
	$menu .= '<option value="0" ' . selCurrent($value, 0) . '>' . $lang['no'] . '</option>';
	return $menu;
}
function onOff($value){
	global $lang;
	$menu = '';
	$menu .= '<option value="1" ' . selCurrent($value, 1) . '>' . $lang['on'] . '</option>';
	$menu .= '<option value="0" ' . selCurrent($value, 0) . '>' . $lang['off'] . '</option>';
	return $menu;
}
function playerList(){
	global $mysqli, $data;
	$playlist = '';
	$play_list = $mysqli->query("SELECT * FROM boom_radio_stream WHERE id > 0");
	if($play_list->num_rows > 0){
		while($player = $play_list->fetch_assoc()){
			$playlist .= '<div class="radio_element sub_list_item" data="' . $player['stream_url'] . '"><div class="sub_list_name">' . $player['stream_alias'] . '</div></div>';
		}
	}
	echo $playlist;
}
function adminPlayer($curr, $type){
	global $mysqli, $lang;
	$playlist = '';
	if($type == 1){
		$playlist .= '<option value="0">' . $lang['option_default'] . '</option>';
	}
	if($type == 2){
		$playlist .= '<option value="0">' . $lang['no_default'] . '</option>';
	}
	$play_list = $mysqli->query("SELECT * FROM boom_radio_stream WHERE id > 0");
	if($play_list->num_rows > 0){
		while($player = $play_list->fetch_assoc()){
			$playlist .= '<option  value="' . $player['id'] . '" ' . selCurrent($curr, $player['id']) . '>' . $player['stream_alias'] . '</option>';
		}
	}	
	return $playlist;
}
function getPlayer($room_player){
	global $mysqli, $data;
	$pdata['player_title'] = '';
	$pdata['player_url'] = '';
	if(usePlayer()){
		if($room_player == 0){
			$main_player = $mysqli->query("SELECT * FROM boom_radio_stream WHERE id = '{$data['player_id']}'");
			if($main_player->num_rows > 0){
				$player  = $main_player->fetch_assoc();
				$pdata['player_title'] = $player['stream_alias'];
				$pdata['player_url'] = $player['stream_url'];
			}
		}
		else {
			$get_player = $mysqli->query("SELECT * FROM boom_radio_stream WHERE id = '{$room_player}'");
			if($get_player->num_rows > 0){
				$player = $get_player->fetch_assoc();
				$pdata['player_title'] = $player['stream_alias'];
				$pdata['player_url'] = $player['stream_url'];
			}
			else {
				$main_player = $mysqli->query("SELECT * FROM boom_radio_stream WHERE id = '{$data['player_id']}'");
				if($main_player->num_rows > 0){
					$player = $main_player->fetch_assoc();
					$pdata['player_title'] = $player['stream_alias'];
					$pdata['player_url'] = $player['stream_url'];
				}
			}
		}
	}
	return $pdata;
}
function introLanguage(){
	$language_list = '';
	$dir = glob(BOOM_PATH . '/system/language/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$language = str_replace(BOOM_PATH . '/system/language/', '', $dirnew);
		$language_list .= boomTemplate('element/language', $language);
	}
	return $language_list;
}
function listLanguage($lang){
	$language_list = '';
	$dir = glob(BOOM_PATH . '/system/language/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$language = str_replace(BOOM_PATH . '/system/language/', '', $dirnew);
		$language_list .= '<option ' . selCurrent($lang, $language) . ' value="' . $language . '">' . $language . '</option>';
	}
	return $language_list;
}
function listTheme($th, $type){
	global $lang;
	$theme_list = '';
	if($type == 2){
		$theme_list .= '<option ' . selCurrent($th, 'system') . ' value="system">' . $lang['system_theme'] . '</option>';
	}
	$dir = glob(BOOM_PATH . '/css/themes/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$theme = str_replace(BOOM_PATH . '/css/themes/', '', $dirnew);
		$theme_list .= '<option ' . selCurrent($th, $theme) . ' value="' . $theme . '">' . $theme . '</option>';
	}
	return $theme_list;
}
function smailProcess($email) {
	if(!strstr($email, '@')){
		return '';
	}
	$s = explode('@', $email);
	if(strtolower($s[1]) == 'gmail.com' || strtolower($s[1]) == 'googlemail.com') {
		$s[0] = str_replace('.', '', $s[0]);
		return $s[0] . '@' . $s[1];
	}
	else if(strtolower($s[1]) == 'yahoo.'){
		if(!strstr($s[0], '-')){
			return $s[0] . '@' . $s[1];
		}
		else {
			$y = explode('-', $s[0]);
			return $y[0] . '@' . $s[1];
		}
	}
	else {
		return '';
	}
}
function checkEmail($email){
	global $mysqli, $data;
	$check_email = $mysqli->query("SELECT user_id FROM `boom_users` WHERE LOWER(`user_email`) = LOWER('$email')");
	if($check_email->num_rows < 1){
		return true;
	}
}
function checkSmail($email){
	global $mysqli, $data;
	$smail = smailProcess($email);
	if($smail == ''){
		return true;
	}
	else {
		$check_smail = $mysqli->query("SELECT user_id FROM `boom_users` WHERE LOWER(`user_smail`) = LOWER('$smail')");
		if($check_smail->num_rows < 1){
			return true;
		}
	}
}
function boomSame($val1, $val2){
	if(mb_strtolower($val1) == mb_strtolower($val2)){
		return true;
	}
}
function roomActive($w){
	global $data;
	if($w['room_action'] > calWeek(1) || $w['room_id'] == 1){
		return '<img class="sub_list_active" src="' . $data['domain'] . '/default_images/icons/active.svg"/>';
	}
	else {
		return '<img class="sub_list_active" src="' . $data['domain'] . '/default_images/icons/innactive.svg"/>';
	}
}
function boomWarning($message, $type = ''){
	$box['message'] = $message;
	$box['type'] = $type;
	return boomTemplate('element/warning_box', $box);
}
function getPostData($id){
	global $mysqli;
	$user = array();
	$get_post = $mysqli->query("SELECT * FROM boom_post WHERE post_id = '$id'");
	if($get_post->num_rows > 0){
		$user = $get_post->fetch_assoc();
	}
	return $user;
}
function unlinkAvatar($file){
	if(!defaultAvatar($file)){
		$delete =  BOOM_PATH. '/avatar/' . $file;
		if(file_exists($delete)){
			unlink($delete);
		}
	}
	return true;
}
function unlinkCover($file){
	$file = trim(str_replace(array('/', '..'), '', $file));
	if($file == '' || empty($file)){
		return false;
	}
	$delete =  BOOM_PATH . '/cover/' . $file;
	if(file_exists($delete)){
		unlink($delete);
	}
}
function selCurrent($cur, $val){
	if($cur == $val){
		return 'selected';
	}
}
function getTimezone($zone){
	$list_zone = '';
	require BOOM_PATH . '/system/element/timezone.php';
	foreach ($timezone as $line) {
		$list_zone .= '<option value="' . $line . '" ' . selCurrent($zone, $line) . '>' . $line . '</option>';
	}
	return $list_zone;
}
function roomExist($name, $id){
	global $mysqli;
	$check_room = $mysqli->query("SELECT room_name FROM boom_rooms WHERE room_name = '$name' AND room_id != '$id'");
	if($check_room->num_rows > 0){
		return true;
	}
}
function bValid($val){
    if(preg_match('/^[a-f0-9\-]{36}$/', $val)){
		return 1;
	}
	return 0;
}
function insideChat($p){
	if($p == 'chat'){
		return true;
	}
}
function outChat($user){
	if($user['user_roomid'] < 1){
		return true;
	}
}
function checkName($name){
	if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)){
		return true;
	}
}
function freeUsername($user, $id){
	global $mysqli;
	$getuser = $mysqli->query("SELECT user_name FROM boom_users WHERE user_name = '$user' AND user_id != '$id'");
	if($getuser->num_rows < 1){
		return true;
	}
}
function validNameColor($color){
	global $data;
	if($color == 'user'){
		return true;
	}
	if(canNameColor() && preg_match('/^bcolor[0-9]{1,2}$/', $color)){
		return true;
	}
	if(canNameGrad() && preg_match('/^bgrad[0-9]{1,2}$/', $color)){
		return true;
	}
	if(canNameNeon() && preg_match('/^bneon[0-9]{1,2}$/', $color)){
		return true;
	}
}
function validTextColor($color){
	global $data;
	if($color == ''){
		return true;
	}
	if(canColor() && preg_match('/^bcolor[0-9]{1,2}$/', $color)){
		return true;
	}
	if(canGrad() && preg_match('/^bgrad[0-9]{1,2}$/', $color)){
		return true;
	}
	if(canNeon() && preg_match('/^bneon[0-9]{1,2}$/', $color)){
		return true;
	}
}
function validTextFont($font){
	global $data;
	if($font == ''){
		return true;
	}
	if(canFont() && preg_match('/^bfont[0-9]{1,2}$/', $font)){
		return true;
	}
}
function validNameFont($font){
	global $data;
	if($font == ''){
		return true;
	}
	if(canNameFont() && preg_match('/^bnfont[0-9]{1,2}$/', $font)){
		return true;
	}
}
function validTextWeight($f){
	$val = array('', 'ital', 'bold', 'boldital', 'heavybold', 'heavyital');
	if(in_array($f, $val)){
		return true;
	}
}
function listFontStyle($v){
	$list = '';
	$list .= '<option ' . selCurrent($v, '') . ' value="">Normal</option>';
	$list .= '<option ' . selCurrent($v, 'bold') . ' value="bold">Bold</option>';
	$list .= '<option ' . selCurrent($v, 'heavybold') . ' value="heavybold">Heavy</option>';
	$list .= '<option ' . selCurrent($v, 'ital') . ' value="ital">Italic</option>';
	$list .= '<option ' . selCurrent($v, 'boldital') . ' value="boldital">Bold italic</option>';
	$list .= '<option ' . selCurrent($v, 'heavyital') . ' value="heavyital">Heavy italic</option>';
	return $list;
}
function listFont($v){
	$list = '';
	$list .= '<option ' . selCurrent($v, '') . ' value="">Normal</option>';
	$list .= '<option ' . selCurrent($v, 'bfont1') . ' value="bfont1">Kalam</option>';
	$list .= '<option ' . selCurrent($v, 'bfont2') . ' value="bfont2">Signika</option>';
	$list .= '<option ' . selCurrent($v, 'bfont3') . ' value="bfont3">Grandmaster</option>';
	$list .= '<option ' . selCurrent($v, 'bfont4') . ' value="bfont4">Comic neue</option>';
	$list .= '<option ' . selCurrent($v, 'bfont5') . ' value="bfont5">Quicksand</option>';
	$list .= '<option ' . selCurrent($v, 'bfont6') . ' value="bfont6">Orbitron</option>';
	$list .= '<option ' . selCurrent($v, 'bfont7') . ' value="bfont7">Lemonada</option>';
	$list .= '<option ' . selCurrent($v, 'bfont8') . ' value="bfont8">Grenze Gotisch</option>';
	$list .= '<option ' . selCurrent($v, 'bfont9') . ' value="bfont9">Merienda</option>';
	$list .= '<option ' . selCurrent($v, 'bfont10') . ' value="bfont10">Amita</option>';
	$list .= '<option ' . selCurrent($v, 'bfont11') . ' value="bfont11">Averia Libre</option>';
	$list .= '<option ' . selCurrent($v, 'bfont12') . ' value="bfont12">Turret Road</option>';
	$list .= '<option ' . selCurrent($v, 'bfont13') . ' value="bfont13">Sansita</option>';
	$list .= '<option ' . selCurrent($v, 'bfont14') . ' value="bfont14">Comfortaa</option>';

	return $list;
}
function listNameFont($v){
	$list = '';
	$list .= '<option ' . selCurrent($v, '') . ' value="">Normal</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont1') . ' value="bnfont1">Kalam</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont2') . ' value="bnfont2">Signika</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont3') . ' value="bnfont3">Grandmaster</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont4') . ' value="bnfont4">Comic neue</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont5') . ' value="bnfont5">Quicksand</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont6') . ' value="bnfont6">Orbitron</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont7') . ' value="bnfont7">Lemonada</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont8') . ' value="bnfont8">Grenze Gotisch</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont9') . ' value="bnfont9">Merienda</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont10') . ' value="bnfont10">Amita</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont11') . ' value="bnfont11">Averia Libre</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont12') . ' value="bnfont12">Turret Road</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont13') . ' value="bnfont13">Sansita</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont14') . ' value="bnfont14">Comfortaa</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont15') . ' value="bnfont15">Charm</option>';
	$list .= '<option ' . selCurrent($v, 'bnfont16') . ' value="bnfont16">Lobster Two</option>';

	return $list;
}
function unlinkUpload($path, $file){
	$delete =  BOOM_PATH . '/upload/' . $path . '/' . $file;
	if(file_exists($delete)){
		unlink($delete);
	}
}
function deleteFile($path){
	$delete =  BOOM_PATH . '/' . $path;
	if(file_exists($delete)){
		unlink($delete);
	}
}
function resetAvatar($u){
	global $mysqli;
	$unlink_tumb = unlinkAvatar($u['user_tumb']);
	if(isBot($u)){
		switch($u['user_bot']){
			case 1:
				$av = 'default_bot.png';
				break;
			case 9:
				$av = 'default_system.png';
				break;
			default:
				$av = 'default_bot.png';
		}
	}
	else {
		switch($u['user_rank']){
			case 0:
				$av = 'default_guest.png';
				break;
			default:
				$av = genderAvatar($u['user_sex']);
		}
	}
	$mysqli->query("UPDATE boom_users SET user_tumb = '$av' WHERE user_id = '{$u['user_id']}'");
	return $av;
}
function genderAvatar($s){
	switch($s){
		case 1:
			return 'default_male.png';
		case 2:
			return 'default_female.png';
		default:
			return 'default_avatar.png';
	}
}
function resetCover($u){
	global $mysqli;
	$unlink_cover = unlinkCover($u['user_cover']);
	$mysqli->query("UPDATE boom_users SET user_cover = '' WHERE user_id = '{$u['user_id']}'");
}
function setOnair($user){
	global $mysqli;
	if(userDj($user)){
		$mysqli->query("UPDATE boom_users SET user_onair = 1 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
}
function setOffair($user){
	global $mysqli;
	if(userDj($user)){
		$mysqli->query("UPDATE boom_users SET user_onair = 0 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
}
function removeOnair($target){
	global $mysqli;
	$user = userDetails($target);
	if(empty($user)){
		return 3;
	}
	if(canEditUser($user, 10) && userDj($user)){
		$mysqli->query("UPDATE boom_users SET user_onair = 0 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
	else {
		return 0;
	}
}
function addOnair($target){
	global $mysqli;
	$user = userDetails($target);
	if(empty($user)){
		return 3;
	}
	if(canEditUser($user, 10) && userDj($user)){
		$mysqli->query("UPDATE boom_users SET user_onair = 1 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
	else {
		return 0;
	}
}
function makeDj($target){
	global $mysqli;
	$user = userDetails($target);
	if(empty($user)){
		return 3;
	}
	if(canEditUser($user, 10, 1) || boomAllow(10) && mySelf($user['user_id'])){
		$mysqli->query("UPDATE boom_users SET user_dj = 1 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
	else {
		return 0;
	}
}
function removeDj($target){
	global $mysqli;
	$user = userDetails($target);
	if(empty($user)){
		return 3;
	}
	if(canEditUser($user, 10, 1) || boomAllow(10) && mySelf($user['user_id'])){
		$mysqli->query("UPDATE boom_users SET user_dj = 0, user_onair = 0 WHERE user_id = '{$user['user_id']}'");
		return 1;
	}
	else {
		return 0;
	}
}
function userReset($user, $rank){
	global $mysqli, $data;
	$color = '';
	$mood = '';
	$name = '';
	$theme = '';
	$cover = '';
	$visible = '';
	$font = '';
	$tfont = '';
	
	if($rank < $data['allow_colors']){
		$color = ", bccolor = '', bcbold = ''";
	}
	else if($rank < $data['allow_grad'] && preg_match('/^bgrad[0-9]{1,2}$/', $user['bccolor'])){
		$color = ", bccolor = ''";
	}
	else if($rank < $data['allow_neon'] && preg_match('/^bneon[0-9]{1,2}$/', $user['bccolor'])){
		$color = ", bccolor = ''";
	}
	if($rank < $data['allow_font'] && preg_match('/^bfont[0-9]{1,2}$/', $user['bcfont'])){
		$tfont = ", bcfont = ''";
	}
	if($rank < $data['allow_name_color']){
		$name = ", user_color = 'user'";
	}
	else if($rank < $data['allow_name_grad'] && preg_match('/^bgrad[0-9]{1,2}$/', $user['user_color'])){
		$name = ", user_color = 'user'";
	}
	else if($rank < $data['allow_name_neon'] && preg_match('/^bneon[0-9]{1,2}$/', $user['user_color'])){
		$name = ", user_color = 'user'";
	}
	if($rank < $data['allow_name_font'] && preg_match('/^bnfont[0-9]{1,2}$/', $user['user_font'])){
		$font = ", user_font = ''";
	}
	if($rank < $data['allow_mood']){
		$mood = ", user_mood = ''";
	}
	if($rank < $data['allow_theme']){
		$theme = ", user_theme = 'system'";
	}
	if($rank < $data['allow_cover']){
		$cover = ", user_cover = ''";
		unlinkCover($user['user_cover']);
	}
	if($user['user_rank'] > $rank && !isVisible($user)){
		$visible = ", user_status = 1";
	}
	clearNotifyAction($user['user_id'], 'rank_change');
	$mysqli->query("UPDATE boom_users SET user_rank = '$rank', user_action = user_action + 1, pcount = pcount + 1, naction = naction + 1 $color $tfont $name $font $mood $theme $cover $visible WHERE user_id = '{$user['user_id']}'");
	
	if($rank < $data['allow_room']){
		$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_creator = '{$user['user_id']}' AND room_system = 0");
		if($get_room->num_rows > 0){
			while($room = $get_room->fetch_assoc()){
				deleteRoom($room['room_id']);
			}
		}
	}
}
function getMood($user){
	global $lang;
	if($user['user_mood'] == ''){
		return $lang['unset_mood'];
	}
	else {
		return $user['user_mood'];
	}
}
function ignore($id){
	global $mysqli, $data;
	$count_ignore = $mysqli->query("SELECT * FROM boom_ignore WHERE ignored = '$id' AND ignorer = '{$data['user_id']}'");
	if($count_ignore->num_rows < 1){
		$user = userDetails($id);
		if(empty($user)){
			return 3;
		}
		if(canIgnore($user)){
			$mysqli->query("INSERT INTO boom_ignore (ignorer, ignored, ignore_date) VALUES ('{$data['user_id']}', '$id', '" . time() . "')");
			$mysqli->query("DELETE FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = '$id' OR hunter = '$id' AND target = '{$data['user_id']}'");
			createIgnore();
			return 1;
		}
		else {
			return 0;
		}
	}
	else {
		return 2;
	}
}
function removeIgnore($id){
	global $mysqli, $data;
	$mysqli->query("DELETE FROM boom_ignore WHERE ignorer = '{$data['user_id']}' AND ignored = '$id'");
	createIgnore();
	return 1;
}
function muteAccount($id, $delay, $reason = ''){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canMuteUser($user)){
		return 0;
	}
	if(isMuted($user) || isRegmute($user)){
		return 2;
	}
	systemMute($user, $delay, $reason);
	boomNotify('mute', array('target'=> $user['user_id'], 'source'=> 'mute', 'reason'=> $reason, 'delay'=> $delay));
	boomHistory('mute', array('target'=> $user['user_id'], 'delay'=> $delay, 'reason'=> $reason));
	boomConsole('mute', array('target'=> $user['user_id'], 'reason'=>$reason, 'delay'=> $delay));
	return 1;
}
function unmuteAccount($id){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canMuteUser($user)){
		return 0;
	}
	if(!isMuted($user) && !isRegmute($user)){
		return 2;
	}
	systemUnmute($user);
	boomNotify('unmute', array('target'=> $user['user_id'], 'source'=> 'mute'));
	boomConsole('unmute', array('target'=> $user['user_id']));
	return 1;
}
function kickAccount($id, $delay, $reason = ''){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canKickUser($user)){
		return 0;
	}
	if(isKicked($user)){
		return 2;
	}
	if(!validKick($delay)){
		return 0;
	}
	systemKick($user, $delay, $reason);
	boomConsole('kick', array('target'=> $user['user_id'], 'reason'=>$reason, 'delay'=> $delay));
	boomHistory('kick', array('target'=> $user['user_id'], 'delay'=> $delay, 'reason'=> $reason));
	return 1;
}
function unkickAccount($id){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canKickUser($user)){
		return 0;
	}
	if(!isKicked($user)){
		return 2;
	}
	systemUnkick($user);
	boomConsole('unkick', array('target'=> $user['user_id']));
	return 1;
}
function validKick($val){
	$valid = array(2,5,10,15,30,60,1440,2880,4320,5760,7200,8640,10080,20160,43200);
	if(in_array($val, $valid)){
		return true;
	}
}
function validMute($val){
	$valid = array(2,5,10,15,30,60,1440,2880,4320,5760,7200,8640,10080,20160,43200);
	if(in_array($val, $valid)){
		return true;
	}
}
function banAccount($id, $reason = ''){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(!canBanUser($user)){
		return 0;
	}
	if(isBanned($user)){
		return 2;
	}
	systemBan($user, $reason);
	boomConsole('ban', array('target'=> $user['user_id'], 'custom'=>$user['user_ip'], 'reason'=> $reason));
	boomHistory('ban', array('target'=> $user['user_id'], 'reason'=> $reason));
	return 1;
}
function systemBan($user, $reason = ''){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_banned = '" . time() . "', ban_msg = '$reason', user_action = user_action + 1, user_roomid = '0' WHERE user_id = '{$user['user_id']}'");
	if(!boomDuplicateIp($user['user_ip'])){
		$mysqli->query("INSERT INTO boom_banned (ip, ban_user) VALUES ('{$user['user_ip']}', '{$user['user_id']}')");
	}
	banLog($user);
}
function systemUnban($user){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_banned = 0, ban_msg = '', user_action = user_action + 1 WHERE user_id = '{$user['user_id']}'");
	$mysqli->query("DELETE FROM boom_banned WHERE ip = '{$user['user_ip']}' OR ban_user = '{$user['user_id']}'");
}
function systemMute($user, $delay, $reason = ''){
	global $mysqli;
	$mute_end = max($user['user_mute'], calMinutesUp($delay));
	$mysqli->query("UPDATE boom_users SET user_mute = '$mute_end', mute_msg = '$reason', user_regmute = 0 WHERE user_id = '{$user['user_id']}'");
	clearNotifyAction($user['user_id'], 'mute');
	muteLog($user);
}
function systemUnmute($user){
	global $mysqli;
	clearNotifyAction($user['user_id'], 'mute');
	$mysqli->query("UPDATE boom_users SET user_mute = 0, mute_msg = '', user_regmute = 0 WHERE user_id = '{$user['user_id']}'");
}
function systemKick($user, $delay, $reason = ''){
	global $mysqli;
	$this_delay = max($user['user_kick'], calMinutesUp($delay));
	$mysqli->query("UPDATE boom_users SET user_kick = '$this_delay', kick_msg = '$reason', user_action = user_action + 1 WHERE user_id = '{$user['user_id']}'");
	kickLog($user);
}
function systemUnkick($user){
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_kick = '0', kick_msg = '', user_action = user_action + 1 WHERE user_id = '{$user['user_id']}'");
}
function systemFloodMute($user){
	global $mysqli, $data, $lang, $cody;
	if(isMuted($user) || isRegmute($user)){
		return false;
	}
	systemMute($user, $cody['flood_delay'], 'flood');
	boomNotify('flood_mute', array('target'=> $user['user_id'], 'source'=> 'mute', 'delay'=> $cody['flood_delay']));
	boomHistory('flood_mute', array('hunter'=> $data['system_id'], 'target'=> $user['user_id'], 'delay'=> $cody['flood_delay']));
	boomConsole('flood_mute', array('hunter'=>$data['system_id'], 'target'=> $user['user_id'], 'delay'=> $cody['flood_delay']));
	$_SESSION[BOOM_PREFIX . 'last'] = time();
	$_SESSION[BOOM_PREFIX . 'flood'] = 0;
}
function systemSpamMute($user, $custom = ''){
	global $mysqli, $data, $lang, $cody;
	if(isMuted($user) || isRegmute($user)){
		return false;
	}
	if(!isStaff($user['user_rank']) && !isBot($user)){
		systemMute($user, $data['spam_delay'], 'spam');
		boomNotify('spam_mute', array('target'=> $user['user_id'], 'source'=> 'mute', 'delay'=> $data['spam_delay']));
		boomHistory('spam_mute', array('hunter'=> $data['system_id'], 'target'=> $user['user_id'], 'delay'=> $data['spam_delay'], 'reason'=> $custom));
		boomConsole('spam_mute', array('hunter'=>$data['system_id'], 'target'=> $user['user_id'], 'reason'=> $custom, 'delay'=> $data['spam_delay']));
	}
}
function systemSpamBan($user, $custom = ''){
	global $mysqli, $data, $lang;
	if(isBanned($user)){
		return false;
	}
	if(!isStaff($user['user_rank']) && !isBot($user)){
		systemBan($user, 'spam');
		boomHistory('spam_ban', array('hunter'=> $data['system_id'], 'target'=> $user['user_id'], 'reason'=> $custom));
		boomConsole('spam_ban', array('hunter'=>$data['system_id'], 'target'=> $user['user_id'], 'reason'=>$custom));
	}
}
function systemWordKick($user, $custom = ''){
	global $mysqli, $data, $lang;
	if(isKicked($user)){
		return false;
	}
	if(!isStaff($user['user_rank']) && !isBot($user)){
		systemKick($user, $data['word_delay'], 'badword');
		boomHistory('word_kick', array('hunter'=> $data['system_id'], 'target'=> $user['user_id'], 'delay'=> $data['word_delay'], 'reason'=> $custom));
		boomConsole('word_kick', array('hunter'=>$data['system_id'], 'target'=> $user['user_id'], 'reason'=>$custom, 'delay'=> $data['word_delay']));
	}
}
function systemWordMute($user, $custom = ''){
	global $data, $mysqli, $lang;
	if(isMuted($user) || isRegmute($user)){
		return false;
	}
	if(!isStaff($user['user_rank']) && !isBot($user)){
		systemMute($user, $data['word_delay'], 'badword');
		boomNotify('word_mute', array('target'=> $user['user_id'], 'source'=> 'mute', 'delay'=> $data['word_delay']));
		boomHistory('word_mute', array('hunter'=> $data['system_id'], 'target'=> $user['user_id'], 'delay'=> $data['word_delay'], 'reason'=> $custom));
		boomConsole('word_mute', array('hunter'=>$data['system_id'], 'target'=> $user['user_id'], 'reason'=>$custom, 'delay'=> $data['word_delay']));
	}
}
function unbanAccount($id){
	global $mysqli, $data, $cody;
	$user = userDetails($id);
	if(!canBanUser($user)){
		return 0;
	}
	if(!isBanned($user)){
		return 2;
	}
	systemUnban($user);
	boomConsole('unban', array('target'=> $user['user_id'], 'custom'=> $user['user_ip']));
	return 1;
}
function boomUserInfo($id){
	global $mysqli, $data;
	$user = array();
	$getuser = $mysqli->query("SELECT *,
	(SELECT fstatus FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = '$id') as friendship,
	(SELECT count(ignore_id) FROM boom_ignore WHERE ignorer = '{$data['user_id']}' AND ignored = '$id' OR ignorer = '$id' AND ignored = '{$data['user_id']}' ) as ignored
	FROM boom_users WHERE `user_id` = '$id'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
		$user['friendship'] = boomNull($user['friendship']);
	}
	return $user;
}
function userRoomDetails($id){
	global $mysqli, $data;
	$user = array();
	$getuser = $mysqli->query("SELECT *,
	(SELECT room_rank FROM boom_room_staff WHERE room_staff = '$id' AND room_id = '{$data['user_roomid']}') as room_ranking,
	(SELECT count(*) FROM boom_room_action WHERE action_muted = '1' AND action_user = '$id' AND action_room = '{$data['user_roomid']}') as is_muted,
	(SELECT count(*) FROM boom_room_action WHERE action_blocked = '1' AND action_user = '$id' AND action_room = '{$data['user_roomid']}') as is_blocked
	FROM boom_users WHERE user_id = '$id'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
		$user['room_ranking'] = boomNull($user['room_ranking']);
	}
	return $user;
}
function blockRoom($id){
	global $mysqli, $data;
	$user = userRoomDetails($id);
	if(empty($user)){
		return 3;
	}
	if(mainRoom()){
		return 0;
	}
	if(!canRoomAction($user, 5, 2)){
		return 0;
	}
	else{
		$mysqli->query("UPDATE boom_users SET user_action = user_action + 1, user_roomid = '0' WHERE user_id = '$id' AND user_roomid = '{$data['user_roomid']}'");
		$checkroom = $mysqli->query("SELECT * FROM boom_room_action WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id'");
		if($checkroom->num_rows > 0){
			$mysqli->query("UPDATE boom_room_action SET action_blocked = '1' WHERE action_user = '$id' AND action_room = '{$data['user_roomid']}'");
		}
		else {
			$mysqli->query("INSERT INTO boom_room_action ( action_room , action_user, action_blocked ) VALUES ('{$data['user_roomid']}', '$id', '1')");
		}
		boomConsole('room_block', array('target'=> $user['user_id']));
		return 1;
	}
}
function vCheck($val){
	if(preg_match('/^[0-9a-z\-]{36}$/', $val)){
		return true;
	}
}
function muteRoom($id){
	global $mysqli, $data;
	$user = userRoomDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canRoomAction($user, 4, 2)){
		return 0;
	}
	else {
		$mysqli->query("UPDATE boom_users SET room_mute = 1 WHERE user_id = '$id' AND user_roomid = '{$data['user_roomid']}'");
		$checkroom = $mysqli->query("SELECT * FROM boom_room_action WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id'");
		if($checkroom->num_rows > 0){
			$mysqli->query("UPDATE boom_room_action SET action_muted = '1' WHERE action_user = '$id' AND action_room = '{$data['user_roomid']}'");
		}
		else {
			$mysqli->query("INSERT INTO boom_room_action ( action_room , action_user, action_muted ) VALUES ('{$data['user_roomid']}', '$id', '1')");
		}
		boomConsole('room_mute', array('target'=> $user['user_id']));
		return 1;
	}
}
function unmuteRoom($id){
	global $mysqli, $data;
	$user = userRoomDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canRoomAction($user, 4, 2)){
		return 0;
	}
	else{
		$mysqli->query("UPDATE boom_users SET room_mute = 0 WHERE user_id = '$id' AND user_roomid = '{$data['user_roomid']}'");
		$mysqli->query("DELETE FROM boom_room_action WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id' AND action_muted = '1' AND action_blocked = '0'");
		$mysqli->query("UPDATE boom_room_action SET action_muted = '0' WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id' AND action_muted = '1'");
		boomConsole('room_unmute', array('target'=> $user['user_id']));
		return 1;
	}
}
function removeRoomStaff($target){
	global $mysqli, $data, $lang;
	$user = userRoomDetails($target);
	if(!canEditRoom()){
		return 0;
	}
	if(!betterRole($user['room_ranking']) && !boomAllow(9)){
		return 0;
	}
	$mysqli->query("DELETE FROM boom_room_staff WHERE room_staff = '{$user['user_id']}' AND room_id = '{$data['user_roomid']}'");
	$mysqli->query("UPDATE boom_users SET user_role = 0 WHERE user_id = '{$user['user_id']}' AND user_roomid = '{$data['user_roomid']}'");
	boomConsole('change_room_rank', array('target'=> $user['user_id'], 'rank'=>0));
	return 1;
}
function unblockRoom($id){
	global $mysqli, $data;
	$user = userRoomDetails($id);
	if(empty($user)){
		return 3;
	}
	if(!canRoomAction($user, 5, 2)){
		return 0;
	}
	else {
		$mysqli->query("DELETE FROM boom_room_action WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id' AND action_blocked = '1' AND action_muted = '0'");
		$mysqli->query("UPDATE boom_room_action SET action_blocked = '0' WHERE action_room = '{$data['user_roomid']}' AND action_user = '$id' AND action_blocked = '1'");
		boomConsole('room_unblock', array('target'=> $user['user_id']));
		return 1;
	}
}
function reportInfo($id){
	global $mysqli, $data, $cody;
	$rep = array();
	$get_report = $mysqli->query("SELECT * FROM boom_report WHERE report_id = '$id'");
	if($get_report->num_rows > 0){
		$rep = $get_report->fetch_assoc();
	}
	return $rep;
}
function canSendReport(){
	global $mysqli, $data, $cody;
	if(!canReport()){
		return false;
	}
	$get_report = $mysqli->query("SELECT report_id FROM boom_report WHERE report_user = '{$data['user_id']}'");
	if($get_report->num_rows < $cody['max_report']){
		return true;
	}
}
function canRoomAction($user, $role, $type = 1){
	global $mysqli, $data;
	if(empty($user)){
		return false;
	}
	if(mySelf($user['user_id'])){
		return false;
	}
	if(!boomRole($role) && !boomAllow(9)){
		return false;
	}
	if(isStaff($user['user_rank']) || isBot($user)){
		return false;
	}
	if(!betterRole($user['room_ranking']) && !boomAllow(9)){
		return false;
	}
	if($type == 2 && userRoomStaff($user['room_ranking'])){
		return false;
	}
	return true;
}
function ignored($user){
	if($user['ignored'] > 0){
		return true;
	}
}
function haveFriendship($user){
	if($user['friendship'] == 3){
		return true;
	}
}
function canFriend($user){
	if($user['friendship'] < 2){
		return true;
	}
}
function canIgnore($user){
	if(!isStaff($user['user_rank'])&& !isBot($user) && !mySelf($user['user_id'])){
		return true;
	}
}
function boomDat($val, $res = 0){
	if($val != '' || !empty($val)){
		$res = 1;
	}
	return $res;
}
function betterRole($rank){
	global $data;
	if($data['user_role'] > $rank || boomAllow(9)){
		return true;
	}
}
function checkMod($id){
	global $data, $mysqli;
	$checkmod = $mysqli->query("SELECT * FROM boom_room_staff WHERE room_id = '{$data['user_roomid']}' AND room_staff = '$id'");
	if($checkmod->num_rows < 1){
		return true;
	}
}
function addonsLang($name){
	global $data;
	$load_lang = BOOM_PATH . '/addons/' . $name . '/language/' . $data['user_language'] . '.php';
	if(file_exists($load_lang)){
		return $load_lang;
	}
	else {
		return BOOM_PATH . '/addons/' . $name . '/language/Default.php';
	}
}
function addonsLangCron($name){
	global $data;
	$load_lang = BOOM_PATH . '/addons/' . $name . '/language/' . $data['language'] . '.php';
	if(file_exists($load_lang)){
		return $load_lang;
	}
	else {
		return BOOM_PATH . '/addons/' . $name . '/language/Default.php';
	}
}
function addonsData($this_addons){
	global $mysqli;
	$get_settings = $mysqli->query("SELECT * FROM boom_addons WHERE addons = '$this_addons'");
	if($get_settings->num_rows > 0){
		$table_data = $get_settings->fetch_assoc();
	}
	return $table_data;
}
function randomPass(){
	$text = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890++--@@@___';
	$text = substr(str_shuffle($text), 0, 10);
	return encrypt($text);
}
function alphaClear($s){
	return preg_replace('@[a-zA-Z-]@', '', $s);
}
function numsClear($s){
	return preg_replace('@[0-9-]@', '', $s);
}
function isMainRoom(){
	global $data;
	if($data['user_roomid'] == 1){
		return true;
	}
}
function elementTitle($title, $backcall = ''){
	$top_it = array(
		'title'=> $title,
		'backcall'=> $backcall
	);
	return boomTemplate('element/page_top', $top_it);
}
function boxTitle($icon, $title){
	$top_it = array(
		'icon'=> $icon,
		'title'=> $title
	);
	return boomTemplate('element/box_title', $top_it);
}
function findFriend($user){
	global $mysqli, $lang;
	$friend_list = '';
	$find_friend = $mysqli->query("SELECT boom_users.user_name, boom_users.user_id, boom_users.user_tumb, boom_users.user_color, boom_users.last_action, boom_users.user_status, boom_users.user_rank, boom_friends.* FROM boom_users, boom_friends 
	WHERE hunter = '{$user['user_id']}' AND fstatus = '3' AND target = boom_users.user_id ORDER BY last_action DESC, user_name ASC LIMIT 36");
	if($find_friend->num_rows > 0){
		while($find = $find_friend->fetch_assoc()){
			if(isVisible($find)){
				$friend_list .= boomTemplate('element/user_square', $find);
			}
		}
	}
	if($friend_list == ''){
		$friend_list = emptyZone($lang['no_data']);
	}
	return $friend_list;
}
function myFriendList(){
	global $mysqli, $lang, $data;
	$friend_list = '';
	$find_friend = $mysqli->query("SELECT boom_users.user_name, boom_users.user_id, boom_users.user_tumb, boom_users.user_color, boom_users.last_action, boom_users.user_rank, boom_friends.* FROM boom_users, boom_friends 
	WHERE hunter = '{$data['user_id']}' AND fstatus > 1 AND target = boom_users.user_id ORDER BY fstatus DESC, user_name ASC");
	if($find_friend->num_rows > 0){
		while($find = $find_friend->fetch_assoc()){
			$friend_list .= boomTemplate('element/friend_element', $find);
		}
	}
	else {
		$friend_list .= emptyZone($lang['no_friend']);
	}
	return $friend_list;
}
function myIgnore(){
	global $data, $mysqli, $lang;
	$ignore_list = '';
	$find_ignore = $mysqli->query("SELECT boom_users.user_name, boom_users.user_id, boom_users.user_tumb, boom_users.user_color, boom_users.last_action, boom_users.user_rank, boom_ignore.* FROM boom_users, boom_ignore 
	WHERE ignorer = '{$data['user_id']}' AND ignored = boom_users.user_id ORDER BY boom_users.user_name ASC");
	if($find_ignore->num_rows > 0){
		while($find = $find_ignore->fetch_assoc()){
		$ignore_list .= boomTemplate('element/ignore_element', $find);
		}
	}
	else {
		$ignore_list .= emptyZone($lang['no_ignore']);
	}
	return $ignore_list;
}
function canPostAction($id){
	global $mysqli, $data;
	$get_post = $mysqli->query("
		SELECT boom_post.post_user,
		(SELECT fstatus FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = boom_post.post_user) as friendship
		FROM boom_post WHERE boom_post.post_id = '$id'
	");
	if($get_post->num_rows < 1){
		return false;
	}
	$result = $get_post->fetch_assoc();
	if(haveFriendship($result) || mySelf($result['post_user'])){
		return true;
	}
}
function showPost($postid, $type = 0){
	global $data, $mysqli, $lang;
	$wall_content = '';	
	$wall_post = $mysqli->query("SELECT boom_post.*, boom_users.*,
	(SELECT count( parent_id ) FROM boom_post_reply WHERE parent_id = boom_post.post_id ) as reply_count,
	(SELECT like_type FROM boom_post_like WHERE uid = '{$data['user_id']}' AND like_post = boom_post.post_id) as liked
	FROM  boom_post, boom_users 
	WHERE (boom_post.post_user = boom_users.user_id AND post_id = '$postid')
	ORDER BY boom_post.post_actual DESC LIMIT 1");

	if($wall_post->num_rows > 0){
		while ($wall = $wall_post->fetch_assoc()){
			if($type == 1){
				$wall_content .= boomTemplate('element/wall_post_report',$wall);
			}
			else {
				$wall_content .= boomTemplate('element/wall_post',$wall);
			}
		}
	}
	else { 
		$wall_content .= emptyZone($lang['wall_empty']);
	}
	return $wall_content;
}
function showNews($id){
	global $mysqli, $lang, $data;
	$news_content = '';
	$get_news = $mysqli->query("SELECT boom_news.*, boom_users.*,
	(SELECT count( parent_id ) FROM boom_news_reply WHERE parent_id = boom_news.id ) as reply_count,
	(SELECT like_type FROM boom_news_like WHERE uid = '{$data['user_id']}' AND like_post = boom_news.id) as liked
	FROM boom_news, boom_users
	WHERE boom_news.news_poster = boom_users.user_id AND boom_news.id = '$id'
	ORDER BY news_date DESC LIMIT 1");
	while ($news = $get_news->fetch_assoc()){
		$news_content .= boomTemplate('element/news', $news);
	}
	return $news_content;
}
function wordFilter($text, $type = 0){
	global $mysqli, $data, $cody, $lang;
	$text2 = trimContent($text);
	$text = trimContent($text);
	$text_trim = mb_strtolower(str_replace(array(' '), '', $text));
	$take_action = 0;
	$spam_action = 0;
	$reason = '';
	if(!boomAllow($cody['can_word_filter'])){
		$words = $mysqli->query("SELECT * FROM `boom_filter` WHERE word_type = 'word' OR word_type = 'spam'");
		if ($words->num_rows > 0){
			while($filter = $words->fetch_assoc()){
				if($filter['word_type'] == 'word'){
					if(stripos($text, $filter['word']) !== false){
						$text = str_ireplace($filter['word'], '****',$text);
						$text2 = processFilterReason($filter['word'], $text2);
						$take_action++;
					}
				}
				else if($filter['word_type'] == 'spam'){
					if(stripos($text_trim, $filter['word']) !== false){
						$text2 = processFilterReason($filter['word'], $text2);
						$spam_action++;
					}
				}
			}
		}
		if($take_action > 0 && $type == 1 && $spam_action == 0){
			switch($data['word_action']){
				case 2:
					systemWordMute($data, $text2);
					break;
				case 3:
					systemWordKick($data, $text2);
					break;
			}
		}
		if($spam_action > 0){
			$text = boomTemplate('element/spam_text');
			switch($data['spam_action']){
				case 1:
					systemSpamMute($data, $text2);
					break;
				case 2:
					systemSpamBan($data, $text2);
					break;
			}
		}
	}
	return $text;
}
function processFilterReason($word, $text){
	$rep = preg_quote($word, '/');
	return preg_replace("/($rep)/i", '$1', $text);
}
function isBadText($text){
	global $mysqli, $data;
	$text = trimContent($text);
	$text_trim = mb_strtolower(str_replace(array(' '), '', $text));
	if(!boomAllow(10)){
		$words = $mysqli->query("SELECT * FROM `boom_filter` WHERE word_type = 'word' OR word_type = 'spam'");
		if ($words->num_rows > 0){
			while($filter = $words->fetch_assoc()){
				if($filter['word_type'] == 'word'){
					if(stripos($text, $filter['word']) !== false){
						return true;
					}
				}
				else if($filter['word_type'] == 'spam'){
					if(stripos($text_trim, $filter['word']) !== false){
						return true;
					}
				}
			}
		}
	}
}
function isTooLong($text, $max){
	if(mb_strlen($text, 'UTF-8') > $max){
		return true;
	}
}
function introActive($amount){
	global $mysqli;
	$find_last = $mysqli->query("SELECT user_tumb, user_name FROM boom_users WHERE user_bot = 0 AND user_rank > 0 ORDER BY last_action DESC LIMIT $amount");
	$active = '';
	if($find_last->num_rows > 0){
		while ($last = $find_last->fetch_assoc()){
			$active .= boomTemplate('element/active_intro', $last);
		}
	}
	return $active;
}
function embedActive($amount){
	global $mysqli;
	$find_last = $mysqli->query("SELECT user_tumb, user_name FROM boom_users WHERE user_bot = 0 AND user_rank > 0 ORDER BY last_action DESC LIMIT $amount");
	$active = '';
	if($find_last->num_rows > 0){
		while ($last = $find_last->fetch_assoc()){
			$active .= boomTemplate('element/active_embed', $last);
		}
	}
	return $active;
}
function getFileExtension(){
	return 'gif,jpeg,jpg,JPG,PNG,png,x-png,pjpeg,zip,pdf,ZIP,PDF,mp3,webp';
}
function isImage($ext){
	$ext = strtolower($ext);
	$img = array( 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/JPG', 'image/webp' );
	$img_ext = array( 'gif', 'jpeg', 'jpg', 'JPG', 'PNG', 'png', 'x-png', 'pjpeg', 'webp' );
	if( in_array($_FILES["file"]["type"], $img) && in_array($ext, $img_ext)){
		return true;
	}
}
function isFile($ext){
	$ext = strtolower($ext);
	$f = array( 'application/zip', 'application/x-zip-compressed', 'application/pdf', 'application/octet-stream', 'application/x-zip-compressed' );
	$f_ext = array( 'zip', 'pdf', 'ZIP', 'PDF' );
	if( in_array($_FILES["file"]["type"], $f) && in_array($ext, $f_ext)){
		return true;
	}
}
function isMusic($ext){
	$ext = strtolower($ext);
	$f = array( 'audio/mpeg', 'audio/mp3', 'audio/x-mpeg', 'audio/x-mp3', 'audio/mpeg3',
	'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio' );
	$f_ext = array( 'mp3' );
	if( in_array($_FILES["file"]["type"], $f) && in_array($ext, $f_ext)){
		return true;
	}
}
function isCoverImage($ext){
	$ext = strtolower($ext);
	$img = array( 'image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/JPG', 'image/webp' );
	$img_ext = array( 'gif', 'jpeg', 'jpg', 'JPG', 'PNG', 'png', 'x-png', 'pjpeg', 'webp' );
	if( in_array($_FILES["file"]["type"], $img) && in_array($ext, $img_ext)){
		return true;
	}
}
function fileError($type = 1){
	global $data;
	$size = $data['file_weight'];
	if($type == 2){
		$size = $data['max_avatar'];
	}
	else if($type == 3){
		$size = $data['max_cover'];
	}
	if($_FILES["file"]["error"] > 0 || (($_FILES["file"]["size"] / 1024)/1024) > $size ){
		return true;
	}
}
function boomIndexing($tab, $key){
	global $mysqli, $data;
	$get_index = $mysqli->query("SHOW INDEX FROM $tab WHERE Column_name = '$key'");
	if($get_index->num_rows < 1){
		$mysqli->query("ALTER TABLE `$tab` ADD INDEX($key)");
	}
}
function boomRemoveIndex($tab, $key){
	global $mysqli, $data;
	$get_index = $mysqli->query("SHOW INDEX FROM $tab WHERE Column_name = '$key'");
	if($get_index->num_rows > 0){
		$mysqli->query("ALTER TABLE `$tab` DROP INDEX `$key`");
	}
}
function targetExist($id){
	global $data, $mysqli;
	$get_target = $mysqli->query("SELECT user_id FROM boom_users WHERE user_id = '$id'");
	if($get_target->num_rows > 0){
		return true;
	}
}
function removeRelatedFile($id, $zone){
	global $mysqli;
	$get_file = $mysqli->query("SELECT * FROM boom_upload WHERE relative_post = '$id' AND file_zone = '$zone'");
	if($get_file->num_rows > 0){
		while ($file = $get_file->fetch_assoc()){
			unlinkUpload($zone, $file['file_name']);
		}
		$mysqli->query("DELETE FROM boom_upload WHERE relative_post = '$id' AND file_zone = '$zone'");
	}	
}
function getRoomMuted($r){
	global $mysqli, $lang;
	$muted_list = '';
	$get_muted = $mysqli->query("SELECT boom_room_action.*, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_id
				FROM boom_room_action
				LEFT JOIN boom_users
				ON boom_room_action.action_user = boom_users.user_id
				WHERE action_room = '$r' AND action_muted > 0
				ORDER BY  boom_users.user_name ASC");
	if($get_muted->num_rows > 0){
		while($muted = $get_muted->fetch_assoc()){
			$muted['action'] = 'room_unmute';
			$muted_list .= boomTemplate('element/room_user', $muted);
		}
	}
	else{
		$muted_list .= emptyZone($lang['no_data']);
	}
	return $muted_list;
}
function getRoomBlocked($r){
	global $mysqli, $lang;
	$blocked_list = '';
	$get_blocked = $mysqli->query("SELECT boom_room_action.*, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_id
				FROM boom_room_action
				LEFT JOIN boom_users
				ON boom_room_action.action_user = boom_users.user_id
				WHERE action_room = '$r' AND action_blocked > 0
				ORDER BY  boom_users.user_name ASC");
	if($get_blocked->num_rows > 0){
		while($blocked = $get_blocked->fetch_assoc()){
			$blocked['action'] = 'room_unblock';
			$blocked_list .= boomTemplate('element/room_user', $blocked);
		}
	}
	else{
		$blocked_list .= emptyZone($lang['no_data']);
	}
	return $blocked_list;
}
function getRoomStaff($r, $rank){
	global $mysqli, $lang;
	$staff_list = '';
	$get_staff = $mysqli->query("SELECT boom_room_staff.*, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_id
					FROM boom_room_staff
					LEFT JOIN boom_users
					ON boom_room_staff.room_staff = boom_users.user_id
					WHERE room_id = '$r' AND room_rank = $rank
					ORDER BY  boom_users.user_name ASC");
	if($get_staff->num_rows > 0){
		while($staff = $get_staff->fetch_assoc()){
			$staff_list .= boomTemplate('element/room_staff', $staff);
		}
	}
	return $staff_list;
}
function sendEmail($type, $to, $item = ''){
	global $data;
	require BOOM_PATH . '/system/mailer/autoload.php';
	$mail = new PHPMailer\PHPMailer\PHPMailer;
	if(empty($type) || empty($to)){ 
		return 0;
	}
	if(!isEmail($to['user_email'])){
		return 0;
	}
	require BOOM_PATH . '/system/language/' . $to['user_language'] . '/mail.php';
	$email['signature'] = nl2br(str_replace('%site%', $data['title'], $bmail['signature']));
	$email['content'] = nl2br(str_replace(array('%user%', '%data%', '%link%'), array($to['user_name'], $item, '<a target="_BLANK" href="' . $item . '">' . $item . '</a>'), $bmail[$type . '_content']));
	$template = boomTemplate('element/mail_template', $email);

	if($data['mail_type'] == 'smtp'){
		$mail->isSMTP();
		$mail->Host = $data['smtp_host'];
		$mail->SMTPAuth = true;
		$mail->Username = $data['smtp_username'];
		$mail->Password = $data['smtp_password'];
		$mail->SMTPSecure = $data['smtp_type'];
		$mail->Port = $data['smtp_port'];
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
	}
	else {
		$mail->IsMail();
	}
	$mail->setFrom($data['site_email'], $data['email_from']);
	$mail->addAddress($to['user_email']);
	$mail->isHTML(true);
	$mail->CharSet = 'utf-8';
	$mail->Subject = $bmail[$type . '_title'];
	$mail->MsgHTML($template);
	if(!$mail->send()) {
	   return 0;
	} 
	else {
		return 1;
	}
}
function resetUserPass($user){
	global $mysqli;
	$temp_pass = tempPass();
	$temp_encrypt = encrypt($temp_pass);
	if(!canSendMail($user, 'recovery', 4)){
		return 0;
	}
	$test_reset = sendEmail('recovery', $user, $temp_pass);
	if($test_reset == 1){
		$mysqli->query("UPDATE boom_users SET temp_pass = '$temp_encrypt', temp_date = '" . time() . "' WHERE user_id = '{$user['user_id']}'");
		insertMail($user, 'recovery');
	}
	return $test_reset;
}
function sendActivation($user){
	global $mysqli, $data;
	$key = $user['valid_key'];
	if(!is_numeric($user['valid_key']) || $user['valid_key'] == ''){
		$key = genCode();
	}
	$send_mail = sendEmail('resend_activation', $user, $key);
	if($send_mail == 1){
		$mysqli->query("UPDATE boom_users SET valid_key = '$key' WHERE user_id = '{$user['user_id']}'");
		insertMail($user, 'verify');
	}
	return $send_mail;
}
function okVerify(){
	global $data, $cody;
	if(canSendMail($data, 'verify', $cody['max_verify'])){
		return true;
	}
}
function getCritera($c){
	switch($c){
		case 1:
			return "user_rank = '0' AND user_bot = 0";
		case 2:
			return "user_rank = '1' AND user_bot = 0";
		case 3:
			return "user_rank = '2' AND user_bot = 0";
		case 4:
			return "user_rank = '8' AND user_bot = 0";
		case 5:
			return "user_rank = '9' AND user_bot = 0";
		case 6:
			return "user_bot > 0";
		case 7:
			return "user_mute > " . time();
		case 8:
			return "user_kick > " . time();
		case 9:
			return "user_banned > 0";
		case 10:
			return "user_rank = '10' AND user_bot = 0";
		case 11:
			return "user_status = 6 AND user_bot = 0";
		default:
			return "user_rank < 0";
	}	
}
function cleanSearch($search){
	return str_replace('%', '|', $search);
}
function nameDetails($name){
	global $mysqli, $data;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_name = '$name'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function boomUsername($name){
	global $mysqli, $cody;
	$user = nameDetails($name);
	if(empty($user)){
		return true;
	}
	else {
		if(isGuest($user) && $user['last_action'] < calMinutes($cody['guest_delay'])){
			softGuestDelete($user);
			return true;
		}
	}
}
function checkFlood(){
	global $cody, $data;
	if(boomAllow($cody['can_flood'])){
		return false;
	}
	if(isset($_SESSION[BOOM_PREFIX . 'last'], $_SESSION[BOOM_PREFIX . 'flood'])){
		if($_SESSION[BOOM_PREFIX . 'last'] >= time() - 2){
			$_SESSION[BOOM_PREFIX . 'last'] = time();
			$_SESSION[BOOM_PREFIX . 'flood'] = $_SESSION[BOOM_PREFIX . 'flood'] + 1;
			if($_SESSION[BOOM_PREFIX . 'flood'] >= $cody['flood_limit']){
				systemFloodMute($data);
				return true;
			}
			else {
				return false;
			}
		}
		else {
			$_SESSION[BOOM_PREFIX . 'last'] = time();
			$_SESSION[BOOM_PREFIX . 'flood'] = 0;
			return false;
		}
	}
	else {
		$_SESSION[BOOM_PREFIX . 'last'] = time();
		$_SESSION[BOOM_PREFIX . 'flood'] = 0;
		return false;
	}
}
function boomUseSocial(){
	global $data;
	if($data['facebook_login'] == 1 || $data['google_login'] == 1 || $data['twitter_login'] == 1){
		return true;
	}
}
function boomSocial($type){
	global $data;
	if($data[$type] == 1){
		return true;
	}
}
function registration(){
	global $data;
	if($data['registration'] == 1){
		return true;
	}
}
function roomSelect($r){
	global $mysqli;
	$menu = '';
	$get_rooms = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id > 0");
	while($room = $get_rooms->fetch_assoc()){
		$menu .= '<option value="' . $room['room_id'] . '" ' . selCurrent($r, $room['room_id']) . '>' . $room['room_name'] . '</option>';
	}
	return $menu;
}
function getChatPath(){
	return basename(dirname(__DIR__));
}
function deleteFiles($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK);
        foreach($files as $file){
            deleteFiles($file);      
        }
        rmdir( $target );
    } 
	elseif(is_file($target)){
        unlink($target);  
    }
}
function boomEmbed(){
	if(isset($_GET['embed'])){
		return true;
	}
}
function boomInsertUser($pro, $type = 0){
	global $mysqli, $data, $cody;
	$user = array();
	if(!isset($pro['name'], $pro['password'], $pro['email'])){
		return $user;
	}
	$def = array(
		'gender' => 3,
		'age' => 0,
		'ip' => '0.0.0.0',
		'language' => $data['language'],
		'avatar' => 'default_avatar.png',
		'color' => 'user',
		'rank' => 1,
		'verified' => 0,
		'verify' => 0,
		'cookie' => 1,
		'email' => '',
	);
	$u = array_merge($def, $pro);
	$u['smail'] = smailProcess($u['email']);
	$mysqli->query("INSERT INTO `boom_users` 
	( user_name, user_password, user_ip, user_email, user_smail, user_rank, user_roomid, user_theme,
	user_join, last_action, user_language, user_timezone, verified, user_verify, user_color,
	user_sex, user_age, user_news, user_tumb)
	VALUES 
	('{$u['name']}', '{$u['password']}', '{$u['ip']}', '{$u['email']}', '{$u['smail']}', '{$u['rank']}', '0', 'system',
	'" . time() . "', '" . time() . "', '{$u['language']}', '{$data['timezone']}', '{$u['verified']}', '{$u['verify']}', '{$u['color']}',
	'{$u['gender']}', '{$u['age']}', '" . time() . "', '{$u['avatar']}')");
	
	$user = userDetails($mysqli->insert_id);
	if($u['cookie'] == 1 && !empty($user)){
		setBoomCookie($user['user_id'], $user['user_password']);
		if($data['regmute'] > 0){
			$regdelay = calMinutesUp($data['regmute']);
			$mysqli->query("UPDATE boom_users SET user_regmute = '$regdelay' WHERE user_id = '{$user['user_id']}'");
		}
	}
	if($u['verify'] == 1 && !empty($user)){
		$send_mail = sendActivation($user);
	}
	return $user;
}
function checkGeo(){
	global $data, $cody;
	if($data['country'] == '' && $cody['use_geo'] == 1){
		return true;
	}
}
function textFilter($c){
	global $data;
	if(canDirect()){
		$c = linking($c);
	}
	else {
		$c = linkingReg($c);
	}
	if(canEmo()){
		$c = emoticon(emoprocess($c));
	}
	else {
		$c = regEmoticon(emoprocess($c));
	}
	return $c;
}
function roomDetails($type = 0){
	global $data, $mysqli;
	$muted = 0;
	$status = 0;
	$get_room = $mysqli->query("SELECT *,
	(SELECT count(id) FROM boom_room_action WHERE action_room = '{$data['user_roomid']}' AND action_user = '{$data['user_id']}' AND action_muted = 1) as is_muted,
	(SELECT room_rank FROM boom_room_staff WHERE room_staff = '{$data['user_id']}' AND room_id = '${data['user_roomid']}') as room_status
	FROM boom_rooms
	WHERE room_id = '{$data['user_roomid']}'");
	if($get_room->num_rows > 0){
		$room = $get_room->fetch_assoc();
		if($type == 1){
			if($room['is_muted'] > 0){
				$muted = 1;
			}
			if(!is_null($room['room_status'])){
				$status = $room['room_status'];
			}
			$mysqli->query("UPDATE boom_users SET room_mute = '$muted', user_role = '$status' WHERE user_id = '{$data['user_id']}'");			
		}
	}
	else {
		$room = array();
	}
	return $room;
}
function roomInfo($id){
	global $data, $mysqli;
	$room = array();
	$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = '$id'");
	if($get_room->num_rows > 0){
		$room = $get_room->fetch_assoc();
	}
	return $room;
}
function logInfo($id){
	global $data, $mysqli;
	$log = array();
	$get_log = $mysqli->query("SELECT * FROM boom_chat WHERE post_id = '$id'");
	if($get_log->num_rows > 0){
		$log = $get_log->fetch_assoc();
	}
	return $log;
}
function getRole($room){
	global $data, $mysqli;
	$getrole = $mysqli->query("SELECT * FROM boom_room_staff WHERE room_id = '$room' AND room_staff = '{$data['user_id']}'");
	if($getrole->num_rows > 0){
		$role = $getrole->fetch_assoc();
		return $role['room_rank'];
	}
	else {
		return 0;
	}
}
function emptyZone($text, $icon = ''){
	$zone['text'] = $text;
	$zone['icon'] = 'nodata.svg';
	if($icon != ''){
		$zone['icon'] = $icon;
	}
	return boomTemplate('element/empty_zone', $zone);	
}
function tempPass(){
	$temp_pass = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+0123456789'), 0, 10);
	return $temp_pass;
}
function useWall(){
	global $data;
	if($data['use_wall'] == 1){
		return true;
	}
}
function boomValidPassword($pass){
	if(strlen($pass) > 3){
		return true;
	}
}
function validRoomName($name){
	global $data, $cody;
	if(strlen($name) <= $cody['max_room_name'] && strlen($name) >= 4 && preg_match("/^[a-zA-Z0-9 _\-\p{Arabic}\p{Cyrillic}\p{Latin}\p{Han}\p{Katakana}\p{Hiragana}\p{Hebrew}]{4,}$/ui", $name)){
		return true;
	}
}
function areFriend($id){
	global $mysqli, $data;
	$check_friend = $mysqli->query("SELECT * FROM boom_friends WHERE target = '{$data['user_id']}' AND hunter = '$id'");
	if($check_friend->num_rows > 0){
		return true;
	}
}
function clearBreak($text){
	$text = preg_replace("/[\r\n]{2,}/", "\n\n", $text);
	return $text;
}
function removeBreak($text){
	$text = preg_replace( "/(\r|\n)/", " ", $text );
	return $text;
}
function emoItem($type){
	switch($type){
		case 1:
			$emoclass = 'emo_menu_item';
			break;
		case 2:
			$emoclass = 'emo_menu_item_priv';
			break;
	}
	$emo = '';
	$dir = glob('emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$emoitem = str_replace('emoticon/', '', $dirnew);
		$emo .= '<div data="' . $emoitem . '" class="emo_menu ' . $emoclass . '"><img class="emo_select" src="emoticon_icon/' . $emoitem . '.png"/></div>';
	}
	return $emo;
}
function userHaveEmail($user){
	if(isEmail($user['user_email'])){
		return true;
	}
}
function isEmail($email){
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && !strstr($email, '+')){
		return true;
	}
}
function validEmail($email){
	global $data, $mysqli;
	if(!isEmail($email)){
		return false;
	}
	if($data['email_filter'] == 1){
		$get_end = explode('@', $email);
		$get_domain = explode('.', $get_end[1]);
		$allowed = $get_domain[0];
		$get_email = $mysqli->query("SELECT word FROM boom_filter WHERE word_type = 'email' AND word = '$allowed'");
		if($get_email->num_rows < 1){
			return false;
		}
	}
	return true;
}
function userPassword($pass){
	global $data;
	if(encrypt($pass) == $data['user_password']){
		return true;
	}
}
function userDelete($user){
	if($user['user_delete'] > 0){
		return true;
	}
}
function canEditUser($user, $rank, $type = 0){
	global $data;
	if($type == 1 && isBot($user)){
		return false;
	}
	if(mySelf($user['user_id'])){
		return false;
	}
	if(boomAllow($rank) && isGreater($user['user_rank']) && !isBot($user)){
		return true;
	}
	if(boomAllow(11) && !isOwner($user)){
		return true;
	}
}
function validAge($age){
	global $data;
	if($age == ''){
		return false;
	}
	if($age == 0){
		return true;
	}
	if($age >= $data['min_age'] && $age != "" && $age < 100){
		return true;
	}
}
function validCountry($country){
	require BOOM_PATH . '/system/location/country_list.php';
	if(array_key_exists($country, $country_list) || $country == 'ZZ'){
		return true;
	}
}
function getLanguage(){
	global $mysqli, $data, $cody;
	$l = $data['language'];
	if(boomLogged()){
		if(file_exists(BOOM_PATH . '/system/language/' . $data['user_language'] . '/language.php')){
			$l = $data['user_language'];
		}
		else {
			$mysqli->query("UPDATE boom_users SET user_language = '{$data['language']}' WHERE user_id = '{$data['user_id']}'");
		}
	}
	else {
		if(isset($_COOKIE[BOOM_PREFIX . 'lang'])){
			$lang = boomSanitize($_COOKIE[BOOM_PREFIX . 'lang']);
			if(file_exists(BOOM_PATH . '/system/language/' . $lang . '/language.php')){
				$l = $lang;
			}
		}
	}
	return $l;
}
function isRtl($l){
	$rtl_list = array('Arabic','Persian','Farsi','Aramaic','Azeri','Hebrew','Dhivehi','Maldivian','Kurdish','Sorani','Urdu');
	if(in_array($l, $rtl_list)){
		return true;
	}
}
function getTheme(){
	global $mysqli, $data;
	$t = $data['default_theme'];
	if(boomLogged()){
		if(canTheme() && $data['user_theme'] != 'system'){
			if(file_exists(BOOM_PATH . '/css/themes/' . $data['user_theme'] . '/' . $data['user_theme'] . '.css')){
				$t = $data['user_theme'];
			}
			else {
				$mysqli->query("UPDATE boom_users SET user_theme = 'system' WHERE user_id = '{$data['user_id']}'");
			}
		}
	}
	return $t . '/' . $t . '.css';
}
function getLoginPage(){
	global $data;
	return $data['login_page'];
}
function getLogo(){
	global $mysqli, $data;
	$logo = $data['domain'] . '/default_images/logo.png';
	if(boomLogged()){
		if(canTheme() && $data['user_theme'] != 'system'){
			if(file_exists(BOOM_PATH . '/css/themes/' . $data['user_theme'] . '/images/logo.png')){
				$logo = $data['domain'] . '/css/themes/' . $data['user_theme'] . '/images/logo.png';
			}
		}
	}
	else {
		if(file_exists(BOOM_PATH . '/css/themes/' . $data['default_theme'] . '/images/logo.png')){
			$logo = $data['domain'] . '/css/themes/' . $data['default_theme'] . '/images/logo.png';
		}
	}
	return $logo . boomFileVersion();
}
function emoticon($emoticon){
	$supported = smiliesType();
	$folder = BOOM_PATH . '/emoticon';
	if ($dir = opendir($folder)) {
		while (false !== ($file = readdir($dir))){
			if ($file != "." && $file != ".."){
				$select = preg_replace('/\.[^.]*$/', '', $file);
				foreach($supported as $sup){
					if(strpos($file, $sup)){
						$emoticon = str_replace(':' . $select . ':', '<img  data="' . $select . '" class="emocc emo_chat" src="emoticon/' . $select . $sup . '"> ', $emoticon);
					}
				}
			}
		}
		closedir($dir);
	}
	$list = getEmo();
	foreach ($list as $value) {
		$type = 'emo_chat';
		if(stripos($value, 'sticker') !== false){
			$type = 'sticker_chat';
		}
		if(stripos($value, 'custom') !== false){
			$type = 'custom_chat';
		}
		if ($dir = opendir($folder . '/' . $value)){
			while (false !== ($file = readdir($dir))){
				if ($file != "." && $file != ".."){
					$select = preg_replace('/\.[^.]*$/', '', $file);
					foreach($supported as $sup){
						if(strpos($file, $sup)){
							$emoticon = str_replace(':' . $select . ':', '<img  data="' . $select . '" class="emocc ' . $type . '" src="emoticon/' . $value . '/' . $select . $sup . '"> ', $emoticon);
						}
					}
				}
			}
			closedir($dir);
		}
	}
	return $emoticon;
}
function regEmoticon($emoticon){
	global $data;
	$supported = smiliesType();
	$folder = BOOM_PATH . '/emoticon';
	if ($dir = opendir($folder)){
		while (false !== ($file = readdir($dir))){
			if ($file != "." && $file != ".."){
				$select = preg_replace('/\.[^.]*$/', '', $file);
				foreach($supported as $sup){
					if(strpos($file, $sup)){
						$emoticon = str_replace(':' . $select . ':', '<img  data="' . $select . '" class="emocc emo_chat" src="emoticon/' . $select . $sup . '"> ', $emoticon);
					}
				}
			}
		}
		closedir($dir);
	}
	return $emoticon;
}
function getEmo(){
	$emo = array();
	$dir = glob(BOOM_PATH . '/emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		array_push($emo, str_replace(BOOM_PATH . '/emoticon/', '', $dirnew));
	}
	return $emo;
}
function boomPostIt($user, $content, $type = 1) {
	$content = systemReplace($content);
	if(userCanDirect($user)){
		$content = postLinking($content);
	}
	else {
		$content = linkingReg($content);
	}
	if($type == 1){
		return nl2br($content);
	}
	else {
		return $content;
	}
}
function boomPostFile($content) {
	global $data;
	if($content == ''){
		return '';
	}
	$content = $data['domain'] . $content;
	return '<div class="post_image"><a href="' . $content . '" class="fancybox"><img src="' . $content . '"/></a></div>';
}
function tumbLinking($img, $tumb) {
	return '<a href="' . $img .'" class="fancybox"><img class="chat_image"src="' . $tumb . '"/></a> ';
}
function linking($content) {
	if(!badWord($content)){
		$source = $content;
		$regex = '\w/_\.\%\+#\-\?:\=\&\;\(\)';
		if(normalise($content, 1)){
			$content = str_replace('youtu.be/','youtube.com/watch?v=',$content);
			$content = preg_replace('@https?:\/\/(www\.)?youtube.com/watch\?v=([\w_-]*)([' . $regex . ']*)?@ui', '<div class="chat_video_container"><div class="chat_video"><iframe src="https://www.youtube.com/embed/$2" frameborder="0" allowfullscreen></iframe></div><div data="https://www.youtube.com/embed/$2" value="youtube" class="boom_youtube open_player hide_mobile"><i class="fa fa-external-link-square"></i></div></div>', $content);
			$content = preg_replace('@https?:\/\/([-\w\.]+[-\w])+(:\d+)?\/[' . $regex . ']+\.(png|gif|jpg|jpeg|webp)((\?\S+)?[^\.\s])?@ui', ' <a href="$0" class="fancybox"><img class="chat_image"src="$0"/></a> ', $content);
			if(preg_last_error()) {
				$content = $source;
			}
			$content = preg_replace('@([^=][^"])(https?://([-\w\.]+[-\w])+(:\d+)?(/([' . $regex . ']*(\?\S+)?[^\.\s])?)?)@ui', '$1<a href="$2" target="_blank">$2</a>', $content);
			$content = preg_replace('@^(https?://([-\w\.]+[-\w])+(:\d+)?(/([' . $regex . ']*(\?\S+)?[^\.\s])?)?)@ui', '<a href="$1" target="_blank">$1</a>', $content);
		}
	}
	return $content;
}
function linkingReg($content){
	global $cody;
	if($cody['strip_direct'] > 0){
		$content = stripLinking($content);
	}
	return $content;
}
function stripLinking($t){
	$list = arrayThisList(
	'www.,https://,http://,.com,.org,.net,.us,.co,.biz,.info,.mobi,.name,.ly,
	.tel,.email,.tech,.xyz,.codes,.bid,.expert,.ca,.cn,.fr,.ch,.au,.in,.de,
	.jp,.nl,.uk,.mx,.no,.ru,.br,.se,.es,.bg,.png,.xpng,.jpeg,.jpg,.gif,.webp,
	.mp3,.mp4,.html,.php,.xml,.zip,.rar,.pdf,.txt
	');
	$t = str_ireplace($list,'',$t);
	return $t;
}
function postLinking($content, $n = 2) {
	if(!badWord($content)){
		$source = $content;
		$regex = '\w/_\.\%\+#\-\?:\=\&\;\(\)';
		if(normalise($content, $n)){
			$content = str_replace('youtu.be/','youtube.com/watch?v=',$content);
			$content = preg_replace('@https?:\/\/(www\.)?youtube.com/watch\?v=([\w_-]*)([' . $regex . ']*)?@ui', '<div class="video_container"><iframe src="https://www.youtube.com/embed/$2" frameborder="0" allowfullscreen></iframe></div>', $content);
			$content = preg_replace('@https?:\/\/([-\w\.]+[-\w])+(:\d+)?\/[' . $regex . ']+\.(png|gif|jpg|jpeg|webp)((\?\S+)?[^\.\s])?@i', '<div class="post_image"> <a href="$0" class="fancybox"><img src="$0"/></a> </div>', $content);
			if(preg_last_error()) {
				$content = $source;
			}
			$content = preg_replace('@([^=][^"])(https?://([-\w\.]+[-\w])+(:\d+)?(/([' . $regex . ']*(\?\S+)?[^\.\s])?)?)@ui', '$1<a href="$2" target="_blank">$2</a>', $content);
			$content = preg_replace('@^(https?://([-\w\.]+[-\w])+(:\d+)?(/([' . $regex . ']*(\?\S+)?[^\.\s])?)?)@ui', '<a href="$1" target="_blank">$1</a>', $content);
		}
	}
	return $content;
}
function stripUrl($u){
	$u = str_replace(array('www.','https://','http://'), '', $u);
	$u = rtrim($u,"/");
	$e = explode('/', $u);
	$u = $e[0];
	$p = explode('.', $u);
	if(count($p) > 2){
		$u = str_replace($p[0] . '.', '', $u);
	}
	return $u;
}
function customChatImg($source, $tumb = ''){
	if(empty($tumb)){
		$tumb = $source;
	}
	return '<a href="' . $source . '" class="fancybox"><img class="chat_image"src="' . $tumb . '"/></a>';
}
function fileProcess($f, $r){
	$file = array(
		'file'=> $f,
		'title'=> $r
	);
	return boomTemplate('element/file', $file);
}
function musicProcess($f, $r){
	$file = array(
		'file'=> $f,
		'title'=> $r
	);
	return boomTemplate('element/audio', $file);
}
function cleanBoomName($name){
	return str_replace(array(' ', "'", '"', '<', '>', ","), array('_', '', '', '', '', ''), $name);
}
function filterOrigin($origin){
	if(strlen($origin) > 55){
		$origin = mb_substr($origin, 0, 55);
	}
	return str_replace(array(' ', '.', '-'), '_', $origin);
}
function badWord($content){
	$regex = '\w/_\.\%\+#\-\?:\=\&\;\(\)';
	if(preg_match('@https?:\/\/(www\.)?([' . $regex . ']*)?([\*]{4}){1,}([' . $regex . ']*)?@ui', $content)){
		return true;
	}
}
function clearUserData($u){
	global $mysqli;
	if(empty($u)){
		return false;
	}
	$id = $u['user_id'];
	$av = $u['user_tumb'];
	$cv = $u['user_cover'];
	$mysqli->query("DELETE FROM boom_chat WHERE user_id = '$id'");
	$mysqli->query("DELETE FROM boom_room_action WHERE action_user = '$id'");
	$mysqli->query("DELETE FROM boom_private WHERE target = '$id' OR hunter = '$id'");
	$mysqli->query("DELETE FROM boom_post WHERE post_user = '$id'");
	$mysqli->query("DELETE FROM boom_post_reply WHERE reply_user = '$id' OR reply_uid = '$id'");
	$mysqli->query("DELETE FROM boom_news_reply WHERE reply_user = '$id' OR reply_uid = '$id'");
	$mysqli->query("DELETE FROM boom_post_like WHERE uid = '$id' OR liked_uid = '$id'");
	$mysqli->query("DELETE FROM boom_news_like WHERE uid = '$id' OR liked_uid = '$id'");
	$mysqli->query("DELETE FROM boom_room_staff WHERE room_staff = '$id'");
	$mysqli->query("DELETE FROM boom_friends WHERE hunter = '$id' OR target = '$id'");
	$mysqli->query("DELETE FROM boom_notification WHERE notifier = '$id' OR notified = '$id'");
	$mysqli->query("DELETE FROM boom_users WHERE user_id = '$id'");
	$mysqli->query("DELETE FROM boom_report WHERE report_user = '$id' OR report_target = '$id'");
	$mysqli->query("DELETE FROM boom_ignore WHERE ignorer  = '$id' OR ignored = '$id'");
	$mysqli->query("DELETE FROM boom_console WHERE target = '$id' OR hunter = '$id'");
	$mysqli->query("DELETE FROM boom_history WHERE target = '$id' OR hunter = '$id'");
	$del_av = unlinkAvatar($av);
	$del_cv = unlinkCover($cv);
}
function cleanList($type, $rank = 0){
	global $mysqli, $data;
	$user = array();
	$av = array();
	$ac = array();
	$find_query = cleanListQuery($type);
	if(empty($find_query) || !boomAllow($rank) || $find_query == ''){
		return false;
	}
	$find_list = $mysqli->query("SELECT user_id, user_tumb, user_cover FROM boom_users WHERE $find_query");
	if($find_list->num_rows > 0){
		while($user_list = $find_list->fetch_assoc()){
			array_push($user, $user_list['user_id']);
			array_push($av, $user_list['user_tumb']);
			array_push($ac, $user_list['user_cover']);
		}
		if(!empty($user)){
			$list = implode(", ", $user);
			$mysqli->query("DELETE FROM boom_chat WHERE user_id IN ($list)");
			$mysqli->query("DELETE FROM boom_users WHERE user_id IN ($list) AND $find_query");
			$mysqli->query("DELETE FROM boom_private WHERE hunter  IN ($list) OR target  IN ($list)");
			$mysqli->query("DELETE FROM boom_room_action WHERE action_user  IN ($list)");
			$mysqli->query("DELETE FROM boom_ignore WHERE ignorer  IN ($list) OR ignored  IN ($list)");
			$mysqli->query("DELETE FROM boom_report WHERE report_user IN ($list) OR report_target IN ($list)");
			$mysqli->query("DELETE FROM boom_notification WHERE notifier IN ($list) OR notified IN ($list)");
			$mysqli->query("DELETE FROM boom_post WHERE post_user IN ($list)");
			$mysqli->query("DELETE FROM boom_post_reply WHERE reply_user IN ($list) OR reply_uid IN ($list)");
			$mysqli->query("DELETE FROM boom_news_reply WHERE reply_user IN ($list) OR reply_uid IN ($list)");
			$mysqli->query("DELETE FROM boom_post_like WHERE uid IN ($list) OR liked_uid IN ($list)");
			$mysqli->query("DELETE FROM boom_news_like WHERE uid IN ($list) OR liked_uid IN ($list)");
			$mysqli->query("DELETE FROM boom_room_staff WHERE room_staff IN ($list)");
			$mysqli->query("DELETE FROM boom_friends WHERE hunter IN ($list) OR target IN ($list)");
			$mysqli->query("DELETE FROM boom_console WHERE hunter IN ($list) OR target IN ($list)");
			$mysqli->query("DELETE FROM boom_history WHERE hunter IN ($list) OR target IN ($list)");
		}
		if(!empty($av)){
			foreach($av as $del_av){
				unlinkAvatar($del_av);
			}
			foreach($ac as $del_ac){
				unlinkCover($del_ac);
			}
		}
	}	
}
function deleteRoom($room, $type = 0){
	global $mysqli, $data;
	if($type == 1 && !boomAllow(10)){
		return 0;
	}
	if($room == 1){
		return 0;
	}
	if($type == 1){
		$rinfo = roomInfo($room);
		if(!empty($rinfo)){
			boomConsole('delete_room', array('custom'=>$rinfo['room_name']));
		}
	}
	$mysqli->query("DELETE FROM boom_rooms WHERE room_id = '$room'");
	$mysqli->query("DELETE FROM boom_chat WHERE post_roomid = '$room'");
	$mysqli->query("DELETE FROM boom_room_action WHERE action_room = '$room'");
	$mysqli->query("DELETE FROM boom_console WHERE room = '$room'");
	$mysqli->query("UPDATE boom_users SET user_roomid = '0', user_action = user_action + 1, user_role = '0' WHERE user_roomid = '$room'");
	return 1;
}
function cleanRoomList($list){
	global $mysqli, $data, $cody;
	$mysqli->query("DELETE FROM boom_rooms WHERE room_id IN ($list)");
	$mysqli->query("DELETE FROM boom_chat WHERE post_roomid IN ($list)");
	$mysqli->query("DELETE FROM boom_room_action WHERE action_room IN ($list)");
	$mysqli->query("DELETE FROM boom_console WHERE room IN ($list)");
	$mysqli->query("UPDATE boom_users SET user_roomid = '0', user_action = user_action + 1, user_role = '0' WHERE user_roomid IN ($list)");
}
function cleanListQuery($type){
	global $data;
	$chat_delay = calMinutes($data['chat_delete']);
	$innactive_delay = calMinutes($data['member_delete']);
	$delete_delay = time() - 1;
	switch($type){
		case 'guest':
			return "user_rank = 0";
		case 'innactive_guest':
			return "user_rank = 0 AND last_action <= '$chat_delay' LIMIT 1000";
		case 'innactive_member':
			return "user_rank < 2 AND user_bot = 0 AND last_action <= '$innactive_delay' LIMIT 500";
		case 'account_delete':
			return "user_rank < 11 AND user_bot = 0 AND user_delete > 0 AND user_delete < '$delete_delay' LIMIT 500";
		default:
			return "";
	}
}
function softGuestDelete($u){
	global $mysqli, $cody, $data;
	$id = $u['user_id'];
	if(!isGuest($u)){
		return false;
	}
	$new_pass = randomPass();
	$new_name = '@' . $u['user_name'] . '-' . $id;
	$mysqli->query("DELETE FROM boom_room_action WHERE action_user = '$id'");
	$mysqli->query("DELETE FROM boom_private WHERE target = '$id' OR hunter = '$id'");
	$mysqli->query("DELETE FROM boom_room_staff WHERE room_staff = '$id'");
	$mysqli->query("DELETE FROM boom_friends WHERE hunter = '$id' OR target = '$id'");
	$mysqli->query("DELETE FROM boom_notification WHERE notifier = '$id' OR notified = '$id'");
	$mysqli->query("UPDATE boom_users SET user_name = '$new_name', user_password = '$new_pass' WHERE user_id = '$id'");
}
function clearRoom($id){
	global $data, $mysqli, $lang;
	$clearmessage = str_ireplace('%user%', $data['user_name'], $lang['room_clear']);
	$mysqli->query("DELETE FROM `boom_chat` WHERE `post_roomid` = '$id' ");
	systemPostChat($data['user_roomid'], $clearmessage, array('type'=> 'system__clear'));
	chatAction($id);
	$mysqli->query("DELETE FROM boom_report WHERE report_room = '$id'");
	if($mysqli->affected_rows > 0){
		updateStaffNotify();
	}
	boomConsole('clear_logs');
	return true;
}
function changeTopic($topic, $id){
	global $mysqli, $data;
	$topic = preg_replace('/(^|[^"])(((f|ht){1}tp:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="\\2" target="_blank">\\2</a>', $topic);
	$mysqli->query("UPDATE `boom_rooms` SET `topic` = '$topic' WHERE `room_id` = '$id'");
	boomConsole('change_topic', array('reason'=> $topic));
	return true;
}
function userSeen($name){
	global $lang, $data, $mysqli;
	$seen = array();
	$user = nameDetails($name);
	if(!empty($user)){
		$seen = roomInfo($user['user_roomid']);
	}
	if(empty($user) || !isVisible($user) || isBot($user)){
		return str_replace('%userseen%', '<b>' . $name . '</b>', $lang['not_seen']);
	}
	if($user['user_roomid'] == 0 || empty($seen)){
		return str_replace(array('%userseen%', '%seentime%'), array('<b>' . $user['user_name'] . '</b>', '<b>' . displayDate($user['last_action']) . '</b>'), $lang['seen_lobby']);
	}
	return str_replace(array('%userseen%', '%seentime%', '%seenroom%'), array('<b>' . $user['user_name'] . '</b>', '<b>' . displayDate($user['last_action']) . '</b>', '<b>' . $seen['room_name'] . '</b>'), $lang['seen']);
}
function getRoomList($type){
	global $mysqli, $data, $lang;
	$check_action = getDelay();
	$rooms = $mysqli->query(" SELECT *, 
	( SELECT Count(boom_users.user_id) FROM boom_users  Where boom_users.user_roomid = boom_rooms.room_id AND last_action > '$check_action' AND user_status != 6 ) as room_count
	FROM  boom_rooms 
	ORDER BY room_count DESC, room_action DESC");
	$sroom = 0;
	$room_list = '';
	while ($room = $rooms->fetch_assoc()){
		switch($type){
			case 'list':
				$room_list .= boomTemplate('element/room_item', $room);
				break;
			case 'box':
				$room_list .= boomTemplate('element/room_box', $room);
				break;
		}
	}
	return $room_list;
}
function loadAddonsJs($type = 'chat'){
	global $mysqli, $data, $lang;
	$load_addons = $mysqli->query("SELECT * FROM boom_addons ORDER BY addons_load ASC");
	if($load_addons->num_rows > 0){
		while ($addons = $load_addons->fetch_assoc()){
			include BOOM_PATH . '/addons/' . $addons['addons'] . '/files/' . $addons['addons'] . '.php';
		}
	}
}
function getAddons(){
	global $mysqli;
	$load_addons = $mysqli->query("SELECT * FROM boom_addons ORDER BY addons_load ASC");
	return $load_addons;
}
function getPageData($page_data = array()){
	global $data;
	$page_default = array(
		'page'=> '',
		'page_load'=> '',
		'page_menu'=> 0,
		'page_rank'=> 0,
		'page_room'=> 1,
		'page_out'=> 0,
		'page_title'=> $data['title'],
		'page_keyword'=> $data['site_keyword'],
		'page_description'=> $data['site_description'],
		'page_rtl'=> 1,
		'page_nohome'=> 0,
	);
	$page = array_merge($page_default, $page_data);
	return $page;
}
function lastRecordedId(){
	global $mysqli;
	$getid = $mysqli->query("SELECT MAX(user_id) AS last_id FROM boom_users");
	$id = $getid->fetch_assoc();
	return $id['last_id'] + 1;
}
function listThisArray($a){
	return implode(", ", $a);
}
function listWordArray($a){
	return "'" . implode("','", $a) . "'";
}
function arrayThisList($l){
	return explode(',', $l);
}
function sameAccount($u){
	global $mysqli, $lang;
	$getsame = $mysqli->query("SELECT user_name FROM boom_users WHERE user_ip = '{$u['user_ip']}' AND user_id != '{$u['user_id']}' AND user_bot = 0 ORDER BY user_id DESC LIMIT 50");
	$same = array();
	if($getsame->num_rows > 0){
		while($usame = $getsame->fetch_assoc()){
			array_push($same, $usame['user_name']);
		}
	}
	else {
		array_push($same, $lang['none']);
	}
	return listThisArray($same);
}
function getRoomId(){
	global $mysqli, $data;
	if(boomLogged()){
		if($data['user_roomid'] == 0 && !isBanned($data) && !mustVerify()){
			if(!useLobby()){
				$mysqli->query("UPDATE boom_users SET user_roomid = '1' WHERE user_id = '{$data['user_id']}'");
				return 1;
			}
		}
		else {
			return $data['user_roomid'];
		}
	}
	return 0;
}
function boomCookieLaw(){
	global $data, $cody;
	if(!isset($_COOKIE[BOOM_PREFIX . "claw"]) && $data['cookie_law'] == 1){
		return true;
	}
}
function getActionList($type){
	global $data, $mysqli, $lang;
	$action_list = '';
	$action_info = getActionCritera($type);
	$getaction = $mysqli->query("SELECT * FROM boom_users WHERE $action_info");
	if($getaction->num_rows > 0){
		while($action = $getaction->fetch_assoc()){
			$action['type'] = $type;
			$action_list .= boomTemplate('element/admin_action_user', $action);
		}
	}
	else {
		$action_list .= emptyZone($lang['empty']);
	}
	return $action_list;
}
function getActionTimer($type, $action){
	switch($type){
		case 'muted':
			return boomTimeLeft($action['user_mute']);
		case 'kicked':
			return boomTimeLeft($action['user_kick']);
		default:
			return '';
	}
}
function getActionCritera($c){
	switch($c){
		case 'muted':
			return "user_mute > " . time() . " ORDER BY user_mute ASC";
		case 'kicked':
			return "user_kick > " . time() . " ORDER BY user_mute ASC";
		case 'banned':
			return "user_banned > 0 ORDER BY last_action DESC";
		default:
			return "user_id = 0";
	}	
}
function loadPageData($page){
	global $mysqli;
	$page_data = '';
	$get_page = $mysqli->query("SELECT * FROM boom_page WHERE page_name = '$page' LIMIT 1");
	if($get_page->num_rows > 0){
		$pdata = $get_page->fetch_assoc();
		$page_data = $pdata['page_content'];
	}
	return $page_data;
}
function boomFooterMenu(){
	global $data, $lang;
	include BOOM_PATH . '/control/footer_menu.php';
}
function boomRemoveFriend($id){
	global $mysqli, $data;
	if(!isMember($data)){
		return 1;
	}
	$list = array();
	$mysqli->query("DELETE FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = '$id' OR hunter = '$id' AND target = '{$data['user_id']}'");
	$mysqli->query("DELETE FROM boom_notification WHERE notifier = '$id' AND notified = '{$data['user_id']}' OR notifier = '{$data['user_id']}' AND notified = '$id'");
	updateListNotify(array($id, $data['user_id']));
	return 1;
}
function boomIgnored($hunter, $target){
	global $mysqli;
	$get_ignore = $mysqli->query("SELECT * FROM boom_ignore WHERE ignorer = '$hunter' AND ignored = '$target' OR ignorer = '$target' AND ignored = '$hunter'");
	if($get_ignore->num_rows > 0){
		return true;
	}
}
function canSendMail($user, $type, $max){
	global $mysqli, $data;
	$delayed = calHour(24);
	$count = $mysqli->query("SELECT * FROM boom_mail WHERE mail_user = '{$user['user_id']}' AND mail_type = '$type' AND mail_date >= '$delayed'");
	if($count->num_rows < $max){
		return true;
	}
}
function insertMail($user, $type){
	global $mysqli, $data;
	$delay = calHour(48);
	$mysqli->query("INSERT INTO boom_mail (mail_user, mail_date, mail_type) VALUES ('{$user['user_id']}', '" . time() . "', '$type')");
	$mysqli->query("DELETE FROM boom_mail WHERE mail_date < '$delay'");
}
function canSendPrivate($id){
	global $mysqli, $data;
	$user = boomUserInfo($id);
	if(empty($user)){
		return false;
	}
	if(isStaff($data['user_rank'])){
		return true;
	}
	if($user['user_private'] == 0){
		return false;
	}
	if($data['user_private'] == 0 && !isStaff($data['user_rank'])){
		return false;
	}
	if($user['user_private'] == 2 && !haveFriendship($user)){
		return false;
	}
	if($data['user_private'] == 2 && !haveFriendship($user)){
		return false;
	}
	if($user['user_private'] == 3 && $data['user_rank'] < 1){
		return false;
	}
	if($user['ignored'] > 0){
		return false;
	}
	return true;
}
function boomCheckRecaptcha(){
	global $data;
	if(!boomRecaptcha()){
		return true;
	}
	if(!isset($_POST['recaptcha'])){
		return false;
	}
	$recapt = escape($_POST['recaptcha']);
	if(empty($recapt)){
		return false;
	}
	$response = doCurl('https://www.google.com/recaptcha/api/siteverify?secret=' . $data['recapt_secret'] . '&response=' . $recapt);
	$recheck = json_decode($response);
	if($recheck->success == true){
		return true;
	}
}
function createSwitch($id, $val, $ccall = 'noAction'){
	switch($val){
		case 0:
			return '<div id="' . $id . '" class="btable bswitch offswitch" data="0" data-c="' . $ccall . '">
						<div class="bball_wrap"><div class="bball offball"></div></div>
					</div>';
		case 1:
			return '<div id="' . $id . '" class="btable bswitch onswitch" data="1" data-c="' . $ccall . '">
						<div class="bball_wrap"><div class="bball onball"></div></div>
					</div>';
		default:
			return false;
	}
}
function soundCode($sound, $val){
	if($val > 0){
		switch($sound){
			case 'chat':
				return '1';
			case 'private':
				return '2';
			case 'notify':
				return '3';
			case 'name':
				return '4';
			default:
				return '';
		}
	}
	else {
		return '';
	}
}
function soundStatus($val){
	global $data;
	if(preg_match('@[' . $val . ']@i', $data['user_sound'])){
		return 1;
	}
	else {
		return 0;
	}
}
function getLikes($post, $liked, $type){
	global $mysqli, $data, $cody, $lang;
	$result = array(
		'like_post'=> $post,
		'like_count'=> 0,
		'dislike_count'=> 0,
		'love_count'=> 0,
		'fun_count'=> 0,
		'liked'=> '',
		'disliked'=> '',
		'loved'=> '',
		'funned'=> '',
	);
	if($type == 'wall'){
		$get_like = $mysqli->query("SELECT like_type FROM boom_post_like WHERE like_post = '$post'");
	}
	else if($type == 'news'){
		$get_like = $mysqli->query("SELECT like_type FROM boom_news_like WHERE like_post = '$post'");
	}
	else {
		return '';
	}
	switch($liked){
		case 1:
			$result['liked'] = ' liked';
			break;
		case 2:
			$result['disliked'] = ' liked';
			break;
		case 3:
			$result['loved'] = ' liked';
			break;
		case 4:
			$result['funned'] = ' liked';
			break;
		default:
			break;
	}
	if($get_like->num_rows > 0){
		while($like = $get_like->fetch_assoc()){
			if($like['like_type'] == 1){
				$result['like_count']++;
			}
			else if($like['like_type'] == 2){
				$result['dislike_count']++;
			}
			else if($like['like_type'] == 3){
				$result['love_count']++;
			}
			else if($like['like_type'] == 4){
				$result['fun_count']++;
			}
		}
	}
	if($type == 'wall'){
		return 	boomTemplate('element/likes', $result);
	}
	else if($type == 'news'){
		return boomTemplate('element/likes_news', $result);
	}
	else {
		return '';
	}
}
function likeType($type, $c){
	switch($type){
		case 1:
			return '<img class="' . $c . '" src="default_images/reaction/like.svg">';
		case 2:
			return '<img class="' . $c . '" src="default_images/reaction/dislike.svg">';
		case 3:
			return '<img class="' . $c . '" src="default_images/reaction/love.svg">';
		case 4:
			return '<img class="' . $c . '" src="default_images/reaction/funny.svg">';
		default: 
			return 'liked';
	}
}
function listReport(){
	global $lang;
	$rep = '';
	$rep .= '<option value="0">' . $lang['report_select'] . '</option>';
	$rep .= '<option value="1">' . $lang['report_language'] . '</option>';
	$rep .= '<option value="2">' . $lang['report_content'] . '</option>';
	$rep .= '<option value="3">' . $lang['report_fraud'] . '</option>';
	return $rep;
}
function validReport($r){
	$valid = array(1,2,3);
	if(in_array($r, $valid)){
		return true;
	}
}
function renderReport($r){
	global $lang;
	switch($r){
		case 1:
			return $lang['report_language'];
		case 2:
			return $lang['report_content'];
		case 3:
			return $lang['report_fraud'];
		default:
			return 'N/A';
	}
}
?>