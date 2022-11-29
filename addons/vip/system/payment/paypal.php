<?php
$load_addons = 'vip';
require('../../../../system/config_addons.php');

if(!isset($_POST['plan'])){
	echo 0;
	die();
}

$plan = escape($_POST['plan']);
$_SESSION['paypal_ref'] = escape($_SERVER["HTTP_REFERER"]);

if(boomAllow(2)){
	echo 0;
	die();
}
if(isGuest($data)){
	echo 0;
	die();
}
if($data['custom6'] == 'off'){
	echo 0;
	die();
}

$total = vipPrice($plan);
$name = vipPlanName($plan);

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require_once __DIR__ . '/Paypal/autoload.php';
require('paypal_setting.php');

if($name == ''){
	echo 0;
	die();
}
if($total > 0){
	$item = new Item();
	$item->setName($name)
		->setCurrency($data['custom7'])
		->setQuantity(1)
		->setPrice($total)
		->setSku($plan);
}
else {
	echo 0;
	die();
}


$payer = new payer();
$payer->setPaymentMethod('paypal');

$itemlist = new ItemList();
$itemlist->setItems(array($item));

$details = new Details();
$details->setSubtotal($total);

$amount = new Amount();
$amount->setCurrency($data['custom7'])
	->setTotal($total)
	->setDetails($details);
	
$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemlist)
	->setDescription($lang['vip_order'])
	->setInvoiceNumber(uniqid());
	
$redirecturls = new RedirectUrls();
$redirecturls->setReturnUrl($data['domain'] . '/addons/vip/system/payment/paypal_transaction.php')
	->setCancelUrl($data['domain'] . '/addons/vip/system/payment/cancel.php');
	
$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirecturls)
	->setTransactions([$transaction]);
	
try {
	$payment->create($paypal);
}
catch (Exeption $e){
	echo 0;
	die();
}
echo $payment->getApprovalLink();

	

?>