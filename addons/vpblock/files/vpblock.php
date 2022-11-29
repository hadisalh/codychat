<?php
function vpblockExemptOut($addons){
	global $data;
	if(boomAllow(8)){
		return false;
	}
	if($addons['custom1'] == 0){
		return true;
	}
	if($data['user_rank'] > 1){
		return true;
	}
	if($data['user_vpblock'] < 1){
		return true;
	}
	if($addons['custom8'] > 0 && $data['user_join'] < calMinutes($addons['custom8'])){
		return true;
	}
}
?>
<?php if(!vpblockExemptOut($addons)){ ?>
<script data-cfasync="false" type="text/javascript">
vpBlock = function(){
	$.post('addons/vpblock/system/action.php', { 
		vpblock: 1,
		token: utk,
		}, function(response) {
			if(response == 1){
				location.reload(true);
			}
	});
}
$(document).ready(function(){
	vpBlock();
});
</script>
<?php } ?>