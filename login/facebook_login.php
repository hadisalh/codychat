<?php
require('../system/config_bridge.php');

session_start();
require_once __DIR__ . '/Facebook/autoload.php';

if($bdata['facebook_login'] < 1){
	die();
}
$fb = new Facebook\Facebook([ 'app_id' => $bdata['facebook_id'], 'app_secret' => $bdata['facebook_secret'], 'default_graph_version' => 'v2.4', ]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
if(isset($_GET['error'])){
	$ferror = bridgeEscape($_GET['error']);
	if($ferror == 'access_denied'){
		header("Location: " . $bdata['domain']);
		exit;
	}
}
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}	
try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken($bdata['domain'] . '/login/facebook_login.php');
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }
if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		$oAuth2Client = $fb->getOAuth2Client();
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	if (isset($_GET['code'])) {
		header("Location: " . $bdata['domain']);
	}
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		session_destroy();
		header("Location: " . $bdata['domain']);
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	$social_user = array(
		'id'=> $profile['id'],
		'name'=> $profile['first_name'],
		'avatar'=> 'http://graph.facebook.com/' . $profile['id'] . '/picture?type=large'
	);
	
	$user = createBridgeUser('facebook', $social_user);
	header("Location: " . $bdata['domain']);

} 
else {
	$loginUrl = $helper->getLoginUrl($bdata['domain'] . '/login/facebook_login.php', $permissions);
	header("Location: ".$loginUrl);
}