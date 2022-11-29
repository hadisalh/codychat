var waitInstall = 0;
var inKey = '';
var inMail = '';

startInstall = function(){
	if($('.install_accept').attr('value') == 1){
		checkPermission();
	}
	else {
		callSaved('You must accept condition to start intallation', 3);
	}
}
acceptCondition = function(item){
	var ac = $(this);
	if($(item).attr('value') == 1){
		$(item).attr('value', 0);
		$(item).removeClass('fa-check-circle').addClass('fa-circle');
	}
	else {
		$(item).attr('value', 1);
		$(item).removeClass('fa-circle').addClass('fa-check-circle');	
	}
}
runInstaller = function(){
	if(waitInstall == 0){
		$('#install_component').hide();
		$('#wait_install').show();
		waitInstall = 1;
		$.ajax({
			url: "builder/component.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: { 
				db_host: $('#install_db_host').val(),
				db_name: $('#install_db_name').val(),
				db_user: $('#install_db_user').val(),
				db_pass: $('#install_db_password').val(),
				title: $('#install_title').val(),
				domain: $('#install_domain').val(),
				username: $('#install_username').val(),
				email: $('#install_email').val(),
				password: $('#install_password').val(),
				repeat: $('#install_repeat').val(),
				language: $('#install_language').val(),
				purchase: $('#install_purchase').val()
			},
			success: function(response){
				if(response.code == 1) {
					getEnding();
				}
				else {
					callSaved(response.error, 3);
					waitInstall = 0;
					$('#wait_install').hide();
					$('#install_component').show();
				}
			},
			error: function(){
				waitInstall = 0;
				$('#wait_install').hide();
				$('#install_component').show();
				return false;
			}
		});
	}
	else {
		return false;
	}
}
endInstall = function(){
	window.location.reload();
}
checkPermission = function(){
	$.post('builder/permission.php', { 
		check: 1,
		}, function(response) {
			if(response == 1){
				getComponent();
			}
			else{
				$('#install_content').html(response);
				callSaved('Please correct following errors', 3);
			}
	});	
}
getComponent = function(){
	$.post('builder/element.php', { 
		check: 1,
		}, function(response) {
				$('#install_content').html(response);
				selectIt();
	});	
	
}
getEnding = function(){
	$.post('builder/ending.php', { 
		check: 1,
		}, function(response) {
				$('#install_content').html(response);
	});	
	
}
callSaved = function(text, type){
	if(type == 1){
		$('.saved_data').removeClass('saved_warn saved_error').addClass('saved_ok');
	}
	if(type == 2){
		$('.saved_data').removeClass('saved_ok saved_error').addClass('saved_warn');
	}
	if(type == 3){
		$('.saved_data').removeClass('saved_warn saved_ok').addClass('saved_error');
	}
	$('.saved_span').text(text);
	$('.saved_data').fadeIn(300).delay(3000).fadeOut();
}
selectIt = function(){
	$("select:visible").selectBoxIt({ 
		autoWidth: false,
		hideEffect: 'fadeOut',
		hideEffectSpeed: 100
	});
}