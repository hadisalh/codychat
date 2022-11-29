<?php
if(boomAllow($addons['addons_access'])){
	require(addonsLang('commandos'));
}
?>
<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">

$(document).ready(function(){
	
	$('#main_input').submit(function(event){
		var commandos = $('#content').val();
		if(commandos.match("^<?php echo $addons['custom1']; ?>") ){
			chatInput();
			$.post('addons/commandos/system/action.php', {
				commandos: commandos,
				token: utk,
				}, function(response) {
					if(response == 1){
						return false;
					}
					else if(response == 2){
						callSaved(system.invalidCommand, 3);
					}
					else if(response == 3){
						callSaved(system.noUser, 3);
					}
					else if(response == 4){
						callSaved('<?php echo $lang['commandos_require_name']; ?>', 3);
					}
					else{
						callSaved(system.error, 3);
					}
			});
			event.stopImmediatePropagation();
			return false;
		}
	});

});

</script>
<?php } ?>