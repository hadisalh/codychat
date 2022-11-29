<?php
function vpblockSwitch($user, $id, $val){
	switch($val){
		case 0:
			return '<div onclick="vpblockUser(' . $user['user_id']. ',this);" id="' . $id . '" class="btable bswitch offswitch" data="0" data-c="noAction">
						<div class="bball_wrap"><div class="bball offball"></div></div>
					</div>';
		case 1:
			return '<div onclick="vpblockUser(' . $user['user_id']. ',this);" id="' . $id . '" class="btable bswitch onswitch" data="1" data-c="noAction">
						<div class="bball_wrap"><div class="bball onball"></div></div>
					</div>';
		default:
			return false;
	}
}
?>