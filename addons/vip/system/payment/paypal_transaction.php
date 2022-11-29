<?php
session_start();
$load_addons = 'vip';
$boom_access = 0;
$time = time();

$ref = $_SESSION['paypal_ref'];

require("../../../../system/database.php");
require("../../../../system/variable.php");
require("../../../../system/function.php");
require("../../../../system/function_2.php");
if(!isset($_COOKIE[BOOM_PREFIX . 'userid']) || !isset($_COOKIE[BOOM_PREFIX . 'utk'])){
	die();
}
require("../addons_function.php");
$mysqli = @new mysqli(BOOM_DHOST, BOOM_DUSER, BOOM_DPASS, BOOM_DNAME);
if (mysqli_connect_errno()){
	die();
}
$pass = escape($_COOKIE[BOOM_PREFIX . 'utk']);
$ident = escape($_COOKIE[BOOM_PREFIX . 'userid']);
$get_data = $mysqli->query("SELECT boom_setting.*, boom_users.*, boom_addons.* FROM boom_users, boom_setting, boom_addons WHERE boom_users.user_id = '$ident' AND boom_users.user_password = '$pass' AND boom_setting.id = '1' AND boom_addons.addons = '$load_addons'");	
if($get_data->num_rows > 0){
	$data = $get_data->fetch_assoc();
	$boom_access = 1;
}
else {
	die();
}
require(addonsLang($load_addons));
date_default_timezone_set($data['user_timezone']);

if(!boomLogged()){
	die();
}
if(!isset($_GET['paymentId'], $_GET['PayerID'])){
	die();
}
	
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

$payment_id = escape($_GET['paymentId']);
$payer_id = escape($_GET['PayerID']);

require_once __DIR__ . '/Paypal/autoload.php';
require('paypal_setting.php');

$payment = Payment::get($payment_id, $paypal);

$execution = new PaymentExecution();
$execution->setPayerId($payer_id);

try {
	$result = $payment->execute($execution, $paypal);
	try {
		$payment = Payment::get($payment_id, $paypal);
	}
	catch (Exception $ex) {
		echo 'there is an exeption';
		die();
	}
} 
catch (Exception $ex) {
	echo 'there is an exeption';
	die();
}

$related = $payment->transactions[0]->related_resources[0]->sale;
$invoice = $payment->transactions[0]->invoice_number;
$email = $payment->payer->payer_info->email;
$status = $related->state;
$currency = $related->amount->currency;
$price = $related->amount->total;
$order_id = $related->id;

$items = $payment->transactions[0]->item_list->items;

$prev = $mysqli->query("SELECT * FROM vip_transaction WHERE order_id = '$order_id'");
if($prev->num_rows > 0){
	echo 'Sorry there was an error processing this transaction';
	die();
}

foreach($items as $item){
	$sku = $item->sku;
}
if($status == 'completed'){
	$insert_product = recordVip($sku);
}
else {
	$send_fail = vipFail($sku);
}

$sale = array(
	'user'=> $data['user_id'],
	'userp'=> '',
	'plan'=> $sku,
	'price'=> $price,
	'currency'=> $currency,
	'gateway'=> 'paypal',
	'invoice'=> $invoice,
	'order_id'=> $order_id,
	'email'=> $email,
	'vdate'=> time(),
	'status'=> $status,
);

$record = vipTransaction($sale);

header('location: ' . $ref);
?>