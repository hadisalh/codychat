<?php
function isPaidVip($user){
	if($user['user_rank'] == 2 && $user['vip_end'] > 0){
		return true;
	}
}
function paypalMode(){
	global $data;
	switch($data['custom6']){
		case 0:
			return 'off';
		case 1:
			return 'sandbox';
		case 2:
			return 'live';
		default:
			return 'off';
	}
}
function vipSymbol($cur){
	$list = array(
		'AUD'=> '$',
		'CAD'=> '$',
		'CZK'=> 'Kč',
		'DKK'=> 'kr',
		'EUR'=> '€',
		'HKD'=> '$',
		'HUF'=> 'Ft',
		'ILS'=> '₪',
		'JPY'=> '¥',
		'MXN'=> '$',
		'NOK'=> 'kr',
		'NZD'=> '$',
		'PHP'=> '₱',
		'PLN'=> 'zł',
		'GBP'=> '£',
		'SGD'=> '$',
		'SEK'=> 'kr',
		'CHF'=> 'CHF',
		'TWD'=> 'NT$',
		'THB'=> '฿',
		'USD'=> '$',
	);
	return $list[$cur];
}
function listVipCurrency($current){
	global $data, $lang;
	$curlist = '';
	$list = array(
		'AUD',
		'CAD',
		'CZK',
		'DKK',
		'EUR',
		'HKD',
		'HUF',
		'ILS',
		'JPY',
		'MXN',
		'NOK',
		'NZD',
		'PHP',
		'PLN',
		'GBP',
		'SGD',
		'SEK',
		'CHF',
		'TWD',
		'THB',
		'USD',
	);
	foreach($list as $cur){
		$curlist .= '<option ' . selCurrent($current, $cur) . ' value="' . $cur . '">' . $cur . '</option>';
	}
	return $curlist;
}
function vipFormat($amount, $cur){
	switch($cur){
		case 'HUF':
		case 'JPY':
		case 'TWD':
			return round($amount);
		default:
			return number_format($amount, 2, '.', '');
	}
}
function vipValidPlan($plan){
	switch($plan){
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
			return true;
		default:
			return false;
	}
}
function vipPrice($plan){
	global $data;
	switch($plan){
		case 1:
			return $data['custom1'];
		case 2:
			return $data['custom2'];
		case 3:
			return $data['custom3'];
		case 4:
			return $data['custom4'];
		case 5:
			return $data['custom5'];
		default:
			return 0;
	}
}
function vipPlanName($plan){
	global $lang;
	switch($plan){
		case 1:
			return $lang['vip_plan_name1'];
		case 2:
			return $lang['vip_plan_name2'];
		case 3:
			return $lang['vip_plan_name3'];
		case 4:
			return $lang['vip_plan_name4'];
		case 5:
			return $lang['vip_plan_name5'];
		default:
			return '';
	}
}
function vipNewTime($plan, $user){
	if($plan == 1){
		$time1 = strtotime('+7 day', time());
	}
	else if($plan == 2){
		$time1 = strtotime('+1 month', time());
	}
	else if($plan == 3){
		$time1 = strtotime('+3 month', time());
	}
	else if($plan == 4){
		$time1 = strtotime('+12 month', time());
	}
	else if($plan == 5){
		$time1 = 2147483647;
	}
	else {
		$time1 = $user['vip_end'];
	}
	return $time1;
}
function vipEndingDate($val){
	global $lang;
	if($val == 2147483647){
		return $lang['vip_life'];
	}
	else {
		return '<i class="fa fa-clock-o"></i> ' . vipDate($val);
	}
}
function recordVip($plan){
	global $mysqli, $data, $lang;
	if(!vipValidPlan($plan)){
		return false;
	}
	$new_time = vipNewTime($plan, $data);
	if($plan == 5){
		$message = escape($lang['vip_thanks2']);
	}
	else{
		$message = str_replace('%vipdate%', longDate($new_time), escape($lang['vip_thanks']));
	}
	$mysqli->query("UPDATE boom_users SET user_rank = 2, vip_end = '$new_time', user_action = user_action + 1 WHERE user_id = '{$data['user_id']}'");
	clearNotifyAction($data['user_id'], 'rank_change');
	postPrivate($data['system_id'], $data['user_id'], $message);
	boomNotify('rank_change', array('target'=> $data['user_id'], 'source'=> 'rank_change', 'rank'=> 2));
}
function vipFail(){
	global $mysqli, $data, $lang;
	$message = $lang['vip_fail'];
	postPrivate($data['system_id'], $data['user_id'], $message);
}
function vipTransaction($sale){
	global $mysqli, $data;
	$mysqli->query("
	INSERT INTO vip_transaction
	(userid, userp, plan, price, currency, gateaway, invoice, order_id, email, vdate, status)
	VALUES
	('{$sale['user']}', '{$sale['userp']}', '{$sale['plan']}', '{$sale['price']}', '{$sale['currency']}', '{$sale['gateway']}', '{$sale['invoice']}', '{$sale['order_id']}', '{$sale['email']}', '{$sale['vdate']}', '{$sale['status']}')
	");
}
function vipDate($date){
	return date("Y-m-d", $date);
}
function vipLang($user){
	global $data;
	$load_lang = __DIR__ . '/../language/' . $user['user_language'] . '.php';
	$system_lang = __DIR__ . '/../language/' . $data['language'] . '.php';
	if(file_exists($load_lang)){
		return $load_lang;
	}
	else if(file_exists($system_lang)){
		return $system_lang;
	}
	else {
		return __DIR__ . '/../language/Default.php';
	}
}
function vipOff(){
	global $data;
	if($data['custom6'] == 'off'){
		return true;
	}
}
function vipLoadList(){
	global $mysqli, $data, $lang;
	$list = '';
	$t = time();
	$get_vip = $mysqli->query("SELECT * FROM boom_users WHERE vip_end > '$t' ORDER BY last_action ASC LIMIT 100");
	if($get_vip->num_rows > 0){
		while($vip = $get_vip->fetch_assoc()){
			$list .= boomTemplate('../addons/vip/system/template/vip_user', $vip);
		}
		return $list;
	}
	else {
		return emptyZone($lang['empty']);
	}
}
function vipLoadTransaction(){
	global $mysqli, $data, $lang;

	$list = '';
	$get_transaction = $mysqli->query("SELECT * FROM vip_transaction ORDER BY id DESC LIMIT 100");
	if($get_transaction->num_rows > 0){
		while($result = $get_transaction->fetch_assoc()){
			$list .= boomTemplate('../addons/vip/system/template/vip_transaction', $result);
		}
		return $list;
	}
	else {
		return emptyZone($lang['empty']);
	}
}
?>