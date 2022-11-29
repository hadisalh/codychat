<?php
session_start();
require_once('../system/config_bridge.php');

//Include Google client library 
include_once 'Google/Google_Client.php';
include_once 'Google/contrib/Google_Oauth2Service.php';

if($bdata['google_login'] == 0){
	die();
}

/*
 * Configuration and setup Google API
 */
$clientId = $bdata['google_id'];
$clientSecret = $bdata['google_secret'];
$redirectURL = $bdata['domain'] . '/login/google_login.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName($bdata['title']);
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);
$gClient->setScopes(array('email','profile'));

$google_oauthV2 = new Google_Oauth2Service($gClient);

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}
if ($gClient->getAccessToken()) {

	$user = $google_oauthV2->userinfo->get();
	
	$social_user = array(
		'id'=> $user['id'],
		'name'=> $user['given_name'],
		'avatar'=> $user['picture']
	);
	
	$google_user = createBridgeUser('Google', $social_user);
	unset($_SESSION['token']);
	$gClient->revokeToken();

	// Return Auth Station Page
	header("Location: " . $bdata['domain']);
	
} else {
	$authUrl = $gClient->createAuthUrl();
	header("Location: $authUrl");
}