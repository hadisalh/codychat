<?php
$paypal = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
	$data['custom9'],
	$data['custom10']
  )
);

$paypal->setConfig(
    array(
      'mode' => paypalMode($data['custom6'])
    )
);
?>
