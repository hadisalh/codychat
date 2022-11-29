<div class="out_page_container back_dark">
	<div class="out_page_content">
		<div class="out_page_box">
			<div class="pad_box">
				<p class="bmargin15"><i class="fa fa-wrench warn text_ultra"></i><i class="fa fa-cog fa-spin text_jumbo"></i></p>
				<p class="text_med"><?php echo $lang['maint_text']; ?></p>
				<div class="vpad10">
					<p class="theme_color text_small"><?php echo $lang['auto_refresh']; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script data-cfasync="false">
maintCheck = function(){
	$.post('system/action.php', {
		check_maintenance: 1,
		token: utk,
		}, function(response) {
			if(response == 1){
				location.reload();
			}
			else {
				return false;
			}
	});	
}
$(document).ready(function(){
	boomCheckMaint = setInterval(maintCheck, 30000);
	maintCheck();
});
</script>

