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
require_once('config_session.php');

if(!canUploadPrivate() || muted()){ 
	die();
}
if(checkFlood()){
	die();
}
if(!isset($_POST['target'])){
	die();
}
$target = escape($_POST['target']);
if(!canSendPrivate($target)){
	echo 88;
	die();
}
if (isset($_FILES["file"])){
	$info = pathinfo($_FILES["file"]["name"]);
	$extension = $info['extension'];
	$origin = escape(filterOrigin($info['filename']) . '.' . $extension);
	if ( fileError() ){
		echo 1;
		die();
	}
	$file_name = encodeFile($extension);	
	if (isImage($extension)){
		$imginfo = getimagesize($_FILES["file"]["tmp_name"]);
		if ($imginfo !== false) {
			boomMoveFile('upload/private/' . $file_name);
			$myimage = linking( $data['domain'] . "/upload/private/" . $file_name );
			userPostPrivateFile($myimage, $target, $file_name, 'image');
			echo 5;
			die();
		}
		else {
			echo 1;
			die();
		}
	}
	else if (isFile($extension)){
		boomMoveFile('upload/private/' . $file_name);
		$myfile = $data['domain'] . "/upload/private/" . $file_name;
		$myfile =  fileProcess($myfile, $origin);
		userPostPrivateFile($myfile, $target, $file_name, 'file');
		echo 5;
		die();
	}
	else if (isMusic($extension)){
		boomMoveFile('upload/private/' . $file_name);
		$myfile = $data['domain'] . "/upload/private/" . $file_name;
		$myfile =  musicProcess($myfile, $origin);
		userPostPrivateFile($myfile, $target, $file_name, 'music');
		echo 5;
		die();
	}
	else {
		echo 1;
		die();
	}
}
else {
	echo 1;
	die();
}
?>