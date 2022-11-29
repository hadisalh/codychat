<?php
require('../config_session.php');
if(!isMember($data)){
	echo 0;
	die();
}
?>
<div class="pad15 ulist_container">
	<?php echo myFriendList(); ?>
</div>