<?php
session_start();
require_once('../system/config_bridge.php');
require 'Twitter/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

if($bdata['twitter_login'] == 0){
	die();
}

define('CONSUMER_KEY', $bdata['twitter_id']);
define('CONSUMER_SECRET', $bdata['twitter_secret']);
define('OAUTH_CALLBACK', $bdata['domain'] . '/login/twitter_login.php');

if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {
	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
	$_SESSION['access_token'] = $access_token;
	header("Location: " . OAUTH_CALLBACK);
}
else if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	header("location: " . $url);
} 
else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");
	
	$social_user = array(
		"id"=> $user->id,
		"name"=> $user->screen_name,
		"avatar"=> $user->profile_image_url
	);
	
	$user = createBridgeUser('Twitter', $social_user);
	header("Location: " . $bdata['domain']);
}
?>