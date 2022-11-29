<?php
require('config.php');
if(!checkToken()){
	echo 0;
}
else {
	echo 1;
}
?>