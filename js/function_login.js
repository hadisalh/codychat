var waitReply = 0;

$(document).ready(function(){

	selectIt();
	bcCookie();
	
	$(document).keypress(function(e) {
		if(e.which == 13) {
			if($('#login_form_box:visible').length){
				sendLogin();
			}
			else if($('#registration_form_box:visible').length){
				sendRegistration();
			}
			else if($('#guest_form_box:visible').length){
				sendGuestLogin();
			}
			else {
				return false;
			}
		}
	});

});

bcCookie = function(){
	var checkCookie = navigator.cookieEnabled;
	if(checkCookie == false){
		alert("you need to enable cookie for the site to be able to log in");
	}
}
getLogin = function(){
	$.post('system/box/login.php', {
		}, function(response) {
			if(response != 0){
				showModal(response);
			}
			else {
				return false;
			}
	});
}
getGuestLogin = function(){
	$.post('system/box/guest_login.php', {
		}, function(response) {
			if(response != 0){
				showModal(response);
				renderRecaptcha();
			}
			else {
				return false;
			}
	});
}
getRegistration = function(){
	$.post('system/box/registration.php', {
		}, function(response) {
			if(response != 0){
				showModal(response);
				renderRecaptcha();
			}
			else {
				return false;
			}
	});
}
moreLogin = function(){
	$.post('system/box/more_login.php', {
		}, function(response) {
			if(response != 0){
				showModal(response, 300);
			}
			else {
				return false;
			}
	});
}
getRecovery = function(){
	$.post('system/box/pass_recovery.php', {
		}, function(response) {
			if(response != 0){
				showModal(response);
			}
			else {
				return false;
			}
	});
}
hideArrow = function(d){
	if($("#last_active .last_10 .active_user").length <= d){
		$("#last_active .left-arrow, #last_active .right-arrow").hide();
	}
	else {
		$("#last_active .left-arrow, #last_active .right-arrow").show();	
	}
}
sendLogin = function(){
	var upass = $('#user_password').val();
	var uuser = $('#user_username').val();
	if(upass == '' || uuser == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#user_password').val())){
		callSaved(system.emptyField, 3);
		$('#user_password').val("");
		return false;
	}
	else if (/^\s+$/.test($('#user_username').val())){
		callSaved(system.emptyField, 3);
		$('#user_username').val("");
		return false;
	}
	else {
		if(waitReply == 0){
			waitReply = 1;
			$.post('system/encoded/login.php', {
				password: upass, 
				username: uuser
				}, function(response) {
					if(response == 1){
						callSaved(system.badLogin, 3);
						$('#user_password').val("");
					}
					else if (response == 2){
						callSaved(system.badLogin, 3);
						$('#user_password').val("");
					}
					else if (response == 3){
						location.reload();
					}
					waitReply = 0;
			});
		}
		else {
			return false;
		}
	}
}
sendRegistration = function() {
	var upass = $('#reg_password').val();
	var uuser = $('#reg_username').val();
	var uemail = $('#reg_email').val();
	var ugender = $('#login_select_gender').val();
	var uage = $('#login_select_age').val();
	var regRecapt = getRecapt();
	if(upass == '' || uuser == '' || uemail == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#reg_username').val())){
		callSaved(system.emptyField, 3);
		$('#reg_username').val("");
		return false;
	}
	else if (/^\s+$/.test($('#reg_password').val())){
		callSaved(system.emptyField, 3);
		$('#reg_password').val("");
		return false;
	}
	else if (/^\s+$/.test($('#reg_email').val())){
		callSaved(system.emptyField, 3);
		$('#reg_email').val("");
		return false;
	}
	else if(recapt > 0 && regRecapt == ''){
		callSaved(system.missingRecaptcha, 3);
		return false;
	}
	else {
		if(waitReply == 0){
			waitReply = 1;
			$.post('system/encoded/registration.php', {
				password: upass,
				username: uuser,
				email: uemail,
				age: uage,
				gender: ugender,
				recaptcha: regRecapt,
				}, function(response) {
					if(response != 1){
						resetRecaptcha();
					}
					if(response == 2){
						callSaved(system.error, 3);
						$('#reg_password').val("");
						$('#reg_username').val("");
						$('#reg_email').val("");	
					}
					else if (response == 3){
						callSaved(system.error, 3);
						$('#reg_password').val("");
						$('#reg_username').val("");
						$('#reg_email').val("");
					}
					else if (response == 4){
						callSaved(system.invalidUsername, 3);
						$('#reg_username').val("");
					}
					else if (response == 5){
						callSaved(system.usernameExist, 3);
						$('#reg_username').val("");
					}
					else if (response == 6){
						callSaved(system.invalidEmail, 3);
						$('#reg_email').val("");
					}
					else if (response == 7){
						callSaved(system.missingRecaptcha, 3);
					}
					else if (response == 10){
						callSaved(system.emailExist, 3);
						$('#reg_email').val("");
					}
					else if (response == 13){
						callSaved(system.selAge, 3);
					}
					else if (response == 14){
						callSaved(system.error, 3);
					}
					else if (response == 16){
						callSaved(system.maxReg, 3);
					}
					else if (response == 17){
						callSaved(system.shortPass, 3);
						$('#reg_password').val("");
					}
					else if (response == 1){
						location.reload();
					}
					else if(response == 0){
						callSaved(system.registerClose, 3);
					}
					else {
						waitReply = 0;
						return false;
					}
					waitReply = 0;
			});
		}
		else{
			return false;
		}
	}
}
sendGuestLogin = function(){
	var gname = $('#guest_username').val();
	var ggender = $('#guest_gender').val();
	var gage = $('#guest_age').val();
	var guestRecapt = getRecapt();
	if(gname == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#guest_username').val())){
		callSaved(system.emptyField, 3);
		$('#guest_username').val("");
		return false;
	}
	else if(recapt > 0 && guestRecapt == ''){
		callSaved(system.missingRecaptcha, 3);
		return false;
	}
	else {
		if(waitReply == 0){
			waitReply = 1;
			$.post('system/encoded/login.php', {
				guest_name: gname,
				guest_gender: ggender,
				guest_age: gage,
				recaptcha: guestRecapt,
				}, function(response) {
					if(response != 1){
						resetRecaptcha();
					}
					if (response == 4){
						callSaved(system.invalidUsername, 3);
						$('#guest_username').val("");
					}
					else if (response == 5){
						callSaved(system.usernameExist, 3);
						$('#guest_username').val("");
					}
					else if (response == 6){
						callSaved(system.missingRecaptcha, 3);
					}
					else if (response == 16){
						callSaved(system.maxReg, 3);
					}
					else if (response == 13){
						callSaved(system.selAge, 3);
					}
					else if (response == 14){
						callSaved(system.error, 3);
					}
					else if (response == 1){
						location.reload();
					}
					else {
						callSaved(system.error, 3);
					}
					waitReply = 0;
			});
		}
		else {
			return false;
		}
	}
}
sendRecovery = function() {
	var rEmail = $('#recovery_email').val();
	if(rEmail == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#recovery_username').val())){
		callSaved(system.emptyField, 3);
		$('#recovery_username').val("");
		return false;
	}
	else if (/^\s+$/.test($('#recovery_email').val())){
		callSaved(system.emptyField, 3);
		$('#recovery_email').val("");
		return false;
	}
	else {
		if(waitReply == 0){
			waitReply = 1;
			$.post('system/recovery.php', {
				remail: rEmail,
				}, function(response) {
					if (response == 1){
						$('#recovery_email').val("");
						hideModal();
						callSaved(system.recoverySent, 1);
					}
					else if (response == 2){
						$('#recovery_email').val("");
						callSaved(system.noUser, 3);
					}
					else if (response == 3){
						$('#recovery_email').val("");
						callSaved(system.invalidEmail, 3);
					}
					else {
						hideModal();
						callSaved(system.error, 3);
					}
					waitReply = 0;
			});
		}
		else {
			return false;
		}
	}
}
bridgeLogin = function(path){
	if(waitReply == 0){
		waitReply = 1;
		$.post('../boom_bridge.php', {
			path: path,
			special_login: 1,
			}, function(response) {
				if (response == 1){
					location.reload();
				}
				else {
					callSaved(system.siteConnect, 3);
				}
				waitReply = 0;
		});
	}
}
hideCookieBar = function(){
	$.post('system/cookie_law.php', {
		cookie_law: 1,
		}, function(response) {
			$('.cookie_wrap').fadeOut(400);
	});
}
resetRecaptcha = function(){
	if(recapt > 0){
		grecaptcha.reset();
	}
}
renderRecaptcha = function(){
	if(recapt > 0){
		grecaptcha.render("boom_recaptcha", { 'sitekey': recaptKey, });
	}
}
getRecapt = function(){
	if(recapt > 0){
		return grecaptcha.getResponse();
	}
	else {
		return 'disabled';
	}
}