<?php if(!boomAllow(2)){ ?>
<script data-cfasync="false">
openVip = function(){
	$.post('addons/vip/system/vip_box.php', { 
		token: utk,
		}, function(response) {
			showModal(response, 460);
	});
}
vipRecover = function(){
	$.post('addons/vip/system/vip_recover.php', { 
		vip_recover: 1,
		token: utk,
		}, function(response) {
	});
}
$(document).ready(function(){
	boomAddCss('addons/vip/files/vip.css');
	<?php if($addons['custom6'] > 0 ){ ?>
	appLeftMenu('diamond', '<?php echo $lang['vip']; ?>', 'openVip();');
	<?php } ?>
	<?php if($data['vip_end'] > time() && boomAllow(1) && !boomAllow(2)){ ?>
	vipRecover();
	<?php } ?>
});
</script>
<?php } ?>

<?php if(boomAllow(2)){ ?>
<script data-cfasync="false">
vipClean = function(){
	if(user_rank > 1){
		$.post('addons/vip/system/vip_clean.php', { 
			clean_vip: 1,
			token: utk,
			}, function(response) {
		});
	}
}
$(document).ready(function(){
	cleanVip = setInterval(vipClean, 1200000);
	vipClean();
});
</script>
<?php } ?>