$(document).ready(function(){
	
	systemLoad();
	modalPending();
	setTimeout(cleanData, 5000)
	runModal = setInterval(modalPending, 1500);
	runClean = setInterval(cleanData, 300000);

	$(document).on('click', '.get_info', function(){
		var profile = $(this).attr('data');
		closeTrigger();
		getProfile(profile);
	});
	$(document).on('click', '.get_actions', function(){
		var id = $(this).attr('data');
		closeTrigger();
		getActions(id);
	});
	$(document).on('click', '.get_room_actions', function(){
		var id = $(this).attr('data');
		closeTrigger();
		getRoomActions(id);
	});

	$(document).on('click', '.name_choice, .choice', function() {	
		var curColor = $(this).attr('data');
		if($('.user_color').attr('data') == curColor){
			$('.bccheck').remove();
			$('.user_color').attr('data', 'user');
		}
		else {
			$('.bccheck').remove();
			$(this).append('<i class="fa fa-check bccheck"></i>');
			$('.user_color').attr('data', curColor);
		}
		previewName();
	});
	
	$(document).on('change', '#fontitname', function(){		
		previewName();
	});
	
	$(document).on('keydown', function(event) {
		if( event.which === 8 && event.ctrlKey && event.altKey ) {
			getConsole();
		}
	});
});

previewName = function(c){
	var n = $('.user_color').attr('data');
	var f = $('#fontitname').val();
	$('#preview_name').removeClass();
	$('#preview_name').addClass(n+' '+f);
}

var modalList = [];
var logList = [];
scanPending = function(v){
	if('pending' in v){
		var m = v.pending;
		for (var i = 0; i < m.length; i++){
			registerPending(m[i]);
		}
	}
}
registerPending = function(t){
	if(t.length >= 2){
		if(t[0] == 'modal'){
			var pendItem = [t[1], t[2], t[3]];
			modalList.push(pendItem);
		}
		else if(t[0] == 'log'){
			var pendItem = [t[1]];
			logList.push(pendItem);
		}
	}
}
modalPending = function(){
	if(checkModal()){
		var ra = modalList.shift();
		var mc = ra[0];
		var mt = ra[1];
		var ms = ra[2];
		if(mt == 'modal'){
			showModal(mc, ms);
		}
		else if(mt == 'empty'){
			showEmptyModal(mc, ms);
		}
		else if(mt == 'log'){
			$("#show_chat ul").append(mc);
		}
	}
}
checkModal = function(){
	if(curPage == 'chat' && systemLoaded == 0){
		return false;
	}
	else if(modalList.length === 0){
		return false;
	}
	else if($('.modal_back:visible').length){
		return false;
	}
	else {
		return true;
	}
}
logPending = function(){
	if(checkLog()){
		var ra = logList.shift();
		var mc = ra[0];
		$("#show_chat ul").append(mc);
		beautyLogs();
	}
}
checkLog = function(){
	if(curPage != 'chat' || systemLoaded == 0){
		return false;
	}
	else if(logList.length === 0){
		return false;
	}
	else {
		return true;
	}
}

var waitAvatar = 0;
uploadAvatar = function(){
	var file_data = $("#avatar_image").prop("files")[0];
	var filez = ($("#avatar_image")[0].files[0].size / 1024 / 1024).toFixed(2);
	if( filez > avw ){
		callSaved(system.fileBig, 3);
	}
	else if($("#avatar_image").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(waitAvatar == 0){
			waitAvatar = 1;
			uploadIcon('avat_icon', 1);
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("self", 1)
			form_data.append("token", utk)
			$.ajax({
				url: "system/encoded/avatar.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code == 1){
						callSaved(system.wrongFile, 3);
					}
					else if(response.code == 5){
						$('.avatar_profile').attr('src', response.data);
						$('.avatar_profile').attr('href', response.data);
						$('.glob_av').attr('src', response.data);
					}
					else {
						callSaved(system.error, 3);
					}
					uploadIcon('avat_icon', 2);
					waitAvatar = 0;
				},
				error: function(){
					callSaved(system.error, 3);
					uploadIcon('avat_icon', 2);
					waitAvatar = 0;
				}
			})
		}
		else {
			return false;
		}
	}
}
var waitAdminAvatar = 0;
adminUploadAvatar = function(id){
	var file_data = $("#admin_avatar_image").prop("files")[0];
	var filez = ($("#admin_avatar_image")[0].files[0].size / 1024 / 1024).toFixed(2);
	if( filez > avw ){
		callSaved(system.fileBig, 3);
	}
	else if($("#admin_avatar_image").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(waitAdminAvatar == 0){
			waitAdminAvatar = 1;
			uploadIcon('avat_admin', 1);
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("target", id)
			form_data.append("token", utk)
			$.ajax({
				url: "system/encoded/avatar.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code == 1){
						callSaved(system.wrongFile, 3);
					}
					else if(response.code == 5){
						$('.avatar_profile').attr('src', response.data);
						$('.avatar_profile').attr('href', response.data);
					}
					else {
						callSaved(system.error, 3);
					}
					uploadIcon('avat_admin', 2);
					waitAdminAvatar = 0;
				},
				error: function(){
					callSaved(system.error, 3);
					uploadIcon('avat_admin', 2);
					waitAdminAvatar = 0;
				}
			})
		}
		else {
			return false;
		}
	}
}
var waitGuest = 0;
registerGuest = function() {
	var gname = $('#new_guest_name').val();
	var gpass = $('#new_guest_password').val();
	var gemail = $('#new_guest_email').val();
	if(gname == '' || gpass == '' || gemail == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#new_guest_name').val())){
		callSaved(system.emptyField, 3);
		$('#new_guest_name').val("");
		return false;
	}
	else if (/^\s+$/.test($('#new_guest_password').val())){
		callSaved(system.emptyField, 3);
		$('#new_guest_password').val("");
		return false;
	}
	else if (/^\s+$/.test($('#new_guest_email').val())){
		callSaved(system.emptyField, 3);
		$('#new_guest_email').val("");
		return false;
	}
	else {
		if(waitGuest == 0){
			waitGuest = 1;
			$.post('system/encoded/action_guest.php', {
				new_guest_name: gname,
				new_guest_password: gpass,
				new_guest_email: gemail,
				token: utk
				}, function(response) {
					if (response == 1){
						location.reload();
					}
					else if(response == 99){
						callSaved(system.error, 3);
						$('#new_guest_password').val("");
						$('#new_guest_name').val("");
						$('#new_guest_email').val("");	
					}
					else if (response == 4){
						callSaved(system.invalidUsername, 3);
						$('#new_guest_name').val("");
					}
					else if (response == 5){
						callSaved(system.usernameExist, 3);
						$('#new_guest_name').val("");
					}
					else if (response == 6){
						callSaved(system.invalidEmail, 3);
						$('#new_guest_email').val("");
					}
					else if (response == 10){
						callSaved(system.emailExist, 3);
						$('#new_guest_email').val("");
					}
					else if (response == 16){
						callSaved(system.maxReg, 3);
					}
					else if (response == 17){
						callSaved(system.shortPass, 3);
						$('#new_guest_password').val("");
					}
					else if(response == 0){
						callSaved(system.registerClose, 3);
					}
					else {
						waitGuest = 0;
						return false;
					}
					waitGuest = 0;
			});
		}
		else{
			return false;
		}
	}
}
var waitCover = 0;
uploadCover = function(){
	var file_data = $("#cover_file").prop("files")[0];
	var filez = ($("#cover_file")[0].files[0].size / 1024 / 1024).toFixed(2);
	if( filez > cvw ){
		callSaved(system.fileBig, 3);
	}
	else if($("#cover_file").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(waitCover == 0){
			waitCover = 1;
			uploadIcon('cover_icon', 1);
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("self", 1)
			form_data.append("token", utk)
			$.ajax({
				url: "system/encoded/cover.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code == 1){
						callSaved(system.wrongFile, 3);
					}
					else if(response.code == 5){
						addCover(response.data);
					}
					else {
						callSaved(system.error, 3);
					}
					uploadIcon('cover_icon', 2);
					waitCover = 0;
				},
				error: function(){
					callSaved(system.error, 3);
					uploadIcon('cover_icon', 2);
					waitCover = 0;
				}
			})
		}
		else {
			return false;
		}
	}
}
var adminWaitCover = 0;
adminUploadCover = function(id){
	var file_data = $("#admin_cover_file").prop("files")[0];
	var filez = ($("#admin_cover_file")[0].files[0].size / 1024 / 1024).toFixed(2);
	if( filez > cvw ){
		callSaved(system.fileBig, 3);
	}
	else if($("#admin_cover_file").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(adminWaitCover == 0){
			adminWaitCover = 1;
			uploadIcon('admin_cover_icon', 1);
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("target", id)
			form_data.append("token", utk)
			$.ajax({
				url: "system/encoded/cover.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code == 1){
						callSaved(system.wrongFile, 3);
					}
					else if(response.code == 5){
						addCover(response.data);
					}
					else {
						callSaved(system.error, 3);
					}
					uploadIcon('admin_cover_icon', 2);
					adminWaitCover = 0;
				},
				error: function(){
					callSaved(system.error, 3);
					uploadIcon('admin_cover_icon', 2);
					adminWaitCover = 0;
				}
			})
		}
		else {
			return false;
		}
	}
}
var waitSecure = 0;
secureAccount = function() {
	var sname = $('#secure_name').val();
	var spass = $('#secure_password').val();
	var semail = $('#secure_email').val();
	if(sname == '' || spass == '' || semail == ''){
		callSaved(system.emptyField, 3);
		return false;
	}
	else if (/^\s+$/.test($('#secure_name').val())){
		callSaved(system.emptyField, 3);
		$('#secure_name').val("");
		return false;
	}
	else if (/^\s+$/.test($('#secure_password').val())){
		callSaved(system.emptyField, 3);
		$('#secure_password').val("");
		return false;
	}
	else if (/^\s+$/.test($('#secure_email').val())){
		callSaved(system.emptyField, 3);
		$('#secure_email').val("");
		return false;
	}
	else {
		if(waitSecure == 0){
			waitSecure = 1;
			$.post('system/encoded/action_secure.php', {
				secure_name: sname,
				secure_password: spass,
				secure_email: semail,
				token: utk
				}, function(response) {
					if (response == 1){
						location.reload();
					}
					else if(response == 99){
						callSaved(system.error, 3);
						$('#secure_password').val("");
						$('#secure_name').val("");
						$('#secure_email').val("");	
					}
					else if (response == 4){
						callSaved(system.invalidUsername, 3);
						$('#secure_name').val("");
					}
					else if (response == 5){
						callSaved(system.usernameExist, 3);
						$('#secure_name').val("");
					}
					else if (response == 6){
						callSaved(system.invalidEmail, 3);
						$('#secure_email').val("");
					}
					else if (response == 10){
						callSaved(system.emailExist, 3);
						$('#secure_email').val("");
					}
					else if (response == 16){
						callSaved(system.maxReg, 3);
					}
					else if (response == 17){
						callSaved(system.shortPass, 3);
						$('#secure_password').val("");
					}
					else if(response == 0){
						callSaved(system.registerClose, 3);
					}
					else {
						waitSecure = 0;
						return false;
					}
					waitSecure = 0;
			});
		}
		else{
			return false;
		}
	}
}
verifyAccount = function(type){
	if(type == 2){
		$('.resend_hide').hide();
	}
	$.post('system/encoded/action_verify.php', {
		verify: 1,
		send_verification: 1,
		token: utk,
		}, function(response){	
		if(response == 1){
			if(type == 1){
				toggleVerify();
			}
			callSaved(system.emailSent, 1);
		}
		else if(response == 3){
			callSaved(system.somethingWrong, 3);
			hideOver();
		}
		else {
			callSaved(system.oops, 3);
			hideOver();
		}
	});
}
boomSound = function(snd){
	if(uSound.match(snd)){
		return true;
	}
}
resetVerify = function(){
	$('#verify_one').show();
	$('#verify_two').hide();
}
toggleVerify = function(){
	$('#verify_one').hide();
	$('#verify_two').show();
}
validCode = function(type){
	var vCode = $('#boom_code').val();
	if (/^\s+$/.test(vCode) || vCode == ''){
		callSaved(system.emptyField, 3);
	}
	else {
		$.post('system/encoded/action_verify.php', {
			valid_code: vCode,
			verify_code:1,
			token: utk,
			}, function(response) {	
			if(response == 0){
				callSaved(system.invalidCode, 3);
			}
			else if(response == 1){
				if(type == 1){
					location.reload();
				}
				if(type == 2){
					$('#not_verify').remove();
					$('#verify_hide').remove();
					$('#now_verify').show();
				}
			}
			else {
				callSaved(system.somethingWrong, 3);
			}
			$('#boom_code').val('');
		});
	}
}
editProfile = function(){
	$.post('system/box/edit_profile.php', {
		token: utk,
		}, function(response) {
			showEmptyModal(response, 580);
	});
}
storeArray = function(key, value) {
	localStorage.setItem(key, JSON.stringify(value));
}

getArray = function(key) {
	var stored = localStorage.getItem(key);
	if(stored != null) {
		return JSON.parse(stored);
	}
	else {
		return [];
	}
}
setArray = function(key, value){
	var arr = getArray(key);
	arr.push(value);
	storeArray(key, arr);
}

setUserTheme = function(item){
	var theme = $(item).val();
	$.ajax({
		url: "system/encoded/system_action.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: { 
			set_user_theme: theme,
			token: utk
		},
		success: function(response){
			$("#actual_theme").attr("href", "css/themes/" + response.theme + "/" + response.theme + ".css"+bbfv);
			$('#main_logo').attr('src', response.logo);
		},
	});
}
saveUserSound = function(){
	boomDelay(function() {
		$.ajax({
			url: "system/action_profile.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: { 
				change_sound: 1,
				chat_sound: $('#set_chat_sound').attr('data'),
				private_sound: $('#set_private_sound').attr('data'),
				notify_sound: $('#set_notification_sound').attr('data'),
				name_sound: $('#set_username_sound').attr('data'),
				token: utk
			},
			success: function(response){
				if(response.code == 1) {
					uSound = response.data;
				}
				else {
					return false;
				}
			},
			error: function(){
				return false;
			}
		});
	}, 500);
}
systemLoad = function(){
	$.ajax({
		url: "system/encoded/system_load.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: {
			page: curPage,
			token: utk
		},
		success: function(response){
			scanPending(response);
		},
		error: function(){
		}
	});
}
savePrivateSettings = function(){
	$.post('system/action_profile.php', {
		set_private_mode: $('#set_private_mode').val(),
		token: utk,
		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
			}
	});
}
logoutToPage = function(l){
	$.post('system/logout.php', {
		logout_from_system: 1,
		token: utk,
		}, function(response) {
			if(response == 1){
				window.location.href = l;
			}
	});
}
openLogout = function(){
	$.post('system/box/logout.php', { 
		token: utk,
		}, function(response) {
				showModal(response);
	});
}
logOut = function(){
	$.post('system/logout.php', { 
		logout_from_system: 1,
		token: utk,
		}, function(response) {
			if(response == 1){
				location.reload();
			}
	});
}
deleteAvatar = function(){
	$.ajax({
		url: "system/encoded/avatar.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: { 
			delete_avatar: 1,
			token: utk
		},
		success: function(response) {
			$('.avatar_profile').attr('src', response.data);
			$('.avatar_profile').attr('href', response.data);
			$('.glob_av').attr('src', response.data);
		},
		error: function(){
			callSaved(system.error, 3);
		}
	});
}
addCover = function(cover){
	$('.profile_background').css('background-image', 'url('+cover+')');
	$('.profile_background').addClass('cover_size');
}
delCover = function(cover){
	$('.profile_background').css('background-image', '');
	$('.profile_background').removeClass('cover_size');
}
deleteCover = function(){
	$.post('system/encoded/cover.php', { 
		delete_cover: 1,
		token: utk
		}, function(response) {
			delCover();
	});
}
adminRemoveCover = function(id){
	$.post('system/encoded/cover.php', {
		remove_cover: id,
		token: utk,
		}, function(response) {
			if(response == 1){
				delCover();
			}
			else {
				callSaved(system.cantModifyUser, 3);
			}
	});	
}
saveMood = function(){
	$.post('system/action_profile.php', { 
		save_mood: $('#set_mood').val(),
		token: utk
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.restrictedContent, 3);
			}
			else {
				$('#pro_mood').html(response);
				hideOver();
			}
	});	
}
saveInfo = function(){
	$.ajax({
		url: "system/action_profile.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: { 
			save_info: 1,
			age: $('#set_profile_age').val(),
			gender: $('#set_profile_gender').val(),
			token: utk
		},
		success: function(response) {
			if(response.code == 1){
				$('.avatar_profile').attr('src', response.av);
				$('.avatar_profile').attr('href', response.av);
				$('.glob_av').attr('src', response.av);
				callSaved(system.saved, 1);
				hideOver();
			}
			else {
				callSaved(system.error, 3);	
			}
		},
		error: function(){
			callSaved(system.error, 3);
		}
	});
}
saveAbout = function(){
	$.post('system/action_profile.php', { 
		save_about: '1',
		about: $('#set_user_about').val(),
		token: utk
		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.restrictedContent, 3);
			}
			else if(response == 0){
				callSaved(system.error, 3);
			}
			else {
				return false;
			}
	});	
}
saveEmail = function(){
	$.post('system/encoded/action_secure.php', { 
		save_email: '1',
		email: $('#set_profile_email').val(),
		password: $('#email_password').val(),
		token: utk
		}, function(response) {
			if(response == 2){
				callSaved(system.invalidEmail, 3);
			}
			else if(response == 3){
				callSaved(system.wrongPass, 3);
				$('#email_password').val('');
			}
			else if(response == 4){
				callSaved(system.emailExist, 3);
			}
			else if(response == 1){
				callSaved(system.saved, 1);
				hideOver();
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
changePassword = function(){
	var actual = $('#set_actual_pass').val();
	var newPass = $('#set_new_pass').val();
	var newRepeat = $('#set_repeat_pass').val();
	$.post('system/encoded/action_secure.php', { 
		actual_pass: actual,
		new_pass: newPass,
		repeat_pass: newRepeat,
		change_password: 1,
		token: utk,
		}, function(response) {
			if(response == 2){
				callSaved(system.emptyField, 3);
			}
			else if(response == 3){
				callSaved(system.notMatch, 3);
			}
			else if(response == 4){
				callSaved(system.shortPass, 3);
			}
			else if(response == 5){
				callSaved(system.badActual, 3);
			}
			else if(response == 1){
				callSaved(system.saved, 1);
				hideOver();
			}
			else {
				callSaved(system.error, 3);
				hideOver();
			}
	});
}
deleteMyAccount = function(){
	$.post('system/encoded/action_secure.php', { 
		delete_my_account: '1',
		delete_account_password: $('#delete_account_password').val(),
		token: utk
		}, function(response) {
			if(response == 2){
				callSaved(system.wrongPass, 3);
				$('#delete_account_password').val('');
			}
			else if(response == 1){
				callSaved(system.saved, 1);
				$('#del_account_btn').remove();
				hideOver();
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
cancelDelete = function(){
	$.post('system/encoded/action_secure.php', { 
		cancel_delete_account: '1',
		token: utk
		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
				$('#delete_warn').remove();
			}
	});	
}
saveLocation = function(){
	$.post('system/encoded/action_users.php', {
		user_timezone: $('#set_profile_timezone').val(),
		user_language: $('#set_profile_language').val(),
		user_country: $('#set_profile_country').val(),
		token: utk,
		}, function(response) {
			if(response == 1){
				location.reload();
			}
			else {
				callSaved(system.saved, 1);
			}
	});
}
getProfile = function(profile){
	$.post('system/box/profile.php', {
		get_profile: profile,
		cp: curPage,
		token: utk,
		}, function(response) {
			if(response == 1){
				return false;
			}
			if(response == 2){
				callSaved(system.noUser, 3);
			}
			else {
				showEmptyModal(response,580);
			}
	});
}
getActions = function(id){
	$.post('system/box/action_main.php', {
		id: id,
		cp: curPage,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
			}
			else {
				overEmptyModal(response,400);
			}
	});
}
getRoomActions = function(id){
	$.post('system/box/action_room.php', {
		id: id,
		cp: curPage,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else {
				overEmptyModal(response,400);
			}
	});
}
getPassword = function(){
	$.post('system/box/edit_password.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
getFriends = function(){
	$.post('system/box/manage_friends.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 460);
			}
	});
}
getIgnore = function(){
	$.post('system/box/manage_ignore.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 460);
			}
	});
}
getLocation = function(){
	$.post('system/box/location.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 460);
			}
	});
}
getPrivateSettings = function(){
	$.post('system/box/private_settings.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 460);
			}
	});
}
getSoundSetting = function(){
	$.post('system/box/sound.php', {
		token: utk,
		}, function(response) {
			overModal(response, 380);
	});
}
getDisplaySetting = function(){
	$.post('system/box/display.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 460);
			}
	});
}
getVerify = function(){
	$.post('system/box/verify_account.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 500);
			}
	});
}
getEmail = function(){
	$.post('system/box/edit_email.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
getDeleteAccount = function(){
	$.post('system/box/user_delete.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 500);
			}
	});
}
editUser = function(id){
	$.post('system/box/admin_user.php', {
		edit_user: id,
		token: utk,
		}, function(response) {
			if(response == 99){
				callSaved(system.cantModifyUser, 3);
			}
			else {
				showEmptyModal(response, 580);
			}
	});	
}
adminSaveEmail = function(id){
	$.post('system/encoded/action_users.php', { 
		set_user_id: id,
		set_user_email: $('#set_user_email').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			if(response == 1){
				callSaved(system.saved, 1);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.emailExist, 3);
			}
			else if(response == 3){
				callSaved(system.invalidEmail, 3);
			}
			else {
				callSaved(system.error, 3);
			}
	});		
}
adminSaveAbout = function(id){
	$.post('system/encoded/action_users.php', { 
		target_about: id,
		set_user_about: $('#admin_user_about').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			if(response == 1){
				callSaved(system.saved, 1);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.restrictedContent, 3);
			}
			else {
				callSaved(system.error, 3);
			}
	});		
}
adminRemoveAvatar = function(id){
	$.ajax({
		url: "system/encoded/avatar.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: { 
			remove_avatar: id,
			token: utk
		},
		success: function(response){
			if(response.code == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response.code == 1) {
				$('.avatar_profile').attr('src', response.data);
				$('.avatar_profile').attr('href', response.data);
			}
			else {
				callSaved(system.error, 3);
			}
		},
		error: function(){
			callSaved(system.error, 3);
		}
	});
}
resetProMenu = function(){
	$('#pro_menu').html('');
}
loadProMenu = function(id){
	var proCheck = $('#pro_menu').html();
	if($('#pro_menu:visible').length){
		showMenu('pro_menu');
	}
	else {
		if(proCheck != ''){
			showMenu('pro_menu');
		}
		else {
			$.ajax({
				url: "system/box/pro_menu.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: { 
					page: curPage,
					target: id,
					token: utk
				},
				success: function(response){
					if(response.code == 1){
						if(response.data == ''){
							$('#promenu').remove();
						}
						else {
							$('#pro_menu').html(response.data);
							showMenu('pro_menu');
						}
					}
					else {
						hideModal();
						callSaved(system.error, 3);
					}
				},
				error: function(){
					hideModal();
					callSaved(system.error, 3);
				}
			});
		}
	}
}
acceptFriend = function(t, friend){
	$.post("system/encoded/system_action.php", { 
		accept_friend: friend,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(t).parent().remove();
				if($('.friend_request').length < 1){
					hideModal();
				}
			}
			else {
				$(t).parent().remove();
			}
	});
}
declineFriend = function(t, id){
	$.post("system/encoded/system_action.php", {
		remove_friend: id,
		token: utk,
		}, function(response) {
			$(t).parent().remove();
			if($('.friend_request').length < 1){
				hideModal();
			}
	});
}
removeFriend = function(t, id){
	$.post('system/encoded/system_action.php', { 
		remove_friend: id,
		token: utk,
		}, function(response) {
			$(t).parent().remove();
	});
}
removeIgnore = function(t, id){
	$.post('system/encoded/system_action.php', { 
		remove_ignore: id,
		token: utk,
		}, function(response) {
			$(t).parent().remove();
	});
}
addFriend = function(id){
	$.post("system/encoded/system_action.php", {
		add_friend: id,
		token: utk,
		}, function(response) {
			if(response != 3){
				callSaved(system.actionComplete, 1);
			}
			else {
				hideModal();
				callSaved(system.error, 3);
			}
			resetProMenu();
	});
}
unFriend = function(id){
	$.post('system/encoded/system_action.php', { 
		unfriend: id,
		token: utk,
		}, function(response) {
			callSaved(system.actionComplete, 1);
			resetProMenu();
	});
}
ignoreUser = function(id){
	$.post('system/encoded/system_action.php', { 
		add_ignore: id,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.actionComplete, 1);
			}
			else if(response == 2){
				callSaved(system.actionComplete, 1);
			}
			else {
				callSaved(system.error, 3);
			}
			resetProMenu();
	});
}
unIgnore = function(id){
	$.post('system/encoded/system_action.php', { 
		unignore: id,
		token: utk,
		}, function(response) {
			callSaved(system.actionComplete, 1);
			resetProMenu();
	});
}
ignoreThisUser = function(){
	var ign = $('#get_private').attr('value');
	ignoreUser(ign);
}
changeUsername = function(){
	$.post('system/box/edit_name.php', { 
		token: utk,
		}, function(response) {
			overModal(response);
	});
}
changeInfo = function(){
	$.post('system/box/edit_info.php', { 
		token: utk,
		}, function(response) {
			overModal(response);
	});
}
changeAbout = function(){
	$.post('system/box/edit_about.php', { 
		token: utk,
		}, function(response) {
			overModal(response, 500);
	});
}
changeColor = function(){
	$.post('system/box/edit_color.php', { 
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
openSecure = function(){
	$.post('system/box/secure_account.php', { 
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
openGuestRegister = function(){
	$.post('system/box/guest_register.php', { 
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
changeMood = function(){
	$.post('system/box/edit_mood.php', { 
		token: utk,
		}, function(response) {
			overModal(response);
	});
}
adminChangeName = function(u){
	$.post('system/box/admin_edit_name.php', { 
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
			}
			else {
				overModal(response);
			}
	});
}
adminChangeMood = function(u){
	$.post('system/box/admin_edit_mood.php', { 
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
			}
			else {
				overModal(response);
			}
	});
}
changeMyUsername = function(){
	var myNewName = $('#my_new_username').val();
	$.post('system/action_profile.php', { 
		edit_username: 1,
		new_name: myNewName,
		token: utk,
		}, function(response) {
			if(response == 1){
				$('#pro_name').text(myNewName);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.invalidUsername, 3);
				$('#my_new_username').val('');
			}
			else if(response == 3){
				callSaved(system.usernameExist, 3);
				$('#my_new_username').val();
			}
			else {
				callSaved(system.error, 3);
				hideOver();
			}
	});
}
adminSaveName = function(u){
	var myNewName = $('#new_user_username').val();
	$.post('system/encoded/action_users.php', { 
		target_id: u,
		user_new_name: myNewName,
		token: utk,
		}, function(response) {
			if(response == 1){
				$('#pro_admin_name').text(myNewName);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.invalidUsername, 3);
				$('#new_user_username').val('');
			}
			else if(response == 3){
				callSaved(system.usernameExist, 3);
				$('#new_user_username').val();
			}
			else {
				callSaved(system.error, 3);
				hideOver();
			}
	});
}
adminSaveMood = function(u){
	$.post('system/encoded/action_users.php', { 
		target_id: u,
		user_new_mood: $('#new_user_mood').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.restrictedContent, 3);
			}
			else {
				$('#pro_admin_mood').html(response);
				hideOver();
			}
	});
}
adminSavePassword = function(u){
	$.post('system/encoded/action_users.php', { 
		target_id: u,
		user_new_password: $('#new_user_password').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
				hideOver();
			}
			else if(response == 2){
				callSaved(system.shortPass, 3);
			}
			else {
				callSaved(system.actionComplete, 1);
				hideOver();
			}
	});
}
adminGetEmail = function(u){
	$.post('system/box/admin_edit_email.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
adminGetRank = function(u){
	$.post('system/box/admin_edit_rank.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
adminUserColor = function(u){
	$.post('system/box/admin_edit_color.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
adminUserAbout = function(u){
	$.post('system/box/admin_edit_about.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 500);
			}
	});
}
adminUserPassword = function(u){
	$.post('system/box/admin_edit_password.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 500);
			}
	});
}
adminUserVerify = function(u){
	$.post('system/box/admin_edit_verify.php', {
		target: u,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response);
			}
	});
}
saveNameColor = function(){
	$.post('system/action_profile.php', {
		my_username_color: $('.user_color').attr('data'),
		my_username_font: $('#fontitname').val(),
		token: utk,
		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
			}
			else {
				callSaved(system.error, 3);
			}
	});
}
saveUserColor = function(u){
	$.post('system/encoded/action_users.php', {
		user_color: $('.user_color').attr('data'),
		user_font: $('#fontitname').val(),
		user: u,
		token: utk,
		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
openAddRoom = function(){
	$.post('system/box/create_room.php', {
		token: utk,
		}, function(response) {
			showModal(response);
	});
}
changeRank = function(t, target){
	$.post('system/encoded/action_users.php', {
		change_rank: $(t).val(),
		target: target,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.saved, 1);
				if($('#mprofilemenu:visible').length){
					getProfile(target);
				}
			}
			else {
				callSaved(system.error, 3);
			}
			hideOver();
	});
}
changeUserVerify = function(t, target){
	$.post('system/encoded/action_users.php', {
		account_status: $(t).val(),
		target: target,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.saved, 1);
			}
			else {
				callSaved(system.error, 3);
			}
			hideOver();
	});
}
banBox = function(id){
	$.post('system/box/ban.php', {
		ban: id,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else {
				overEmptyModal(response);
			}
	});
}
kickBox = function(id){
	$.post('system/box/kick.php', {
		kick: id,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else {
				overEmptyModal(response);
			}
	});
}
muteBox = function(id){
	$.post('system/box/mute.php', {
		mute: id,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else {
				overEmptyModal(response);
			}
	});
}
actionHistory = function(id){
	$.post('system/encoded/history.php', {
		get_history:id,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				$('#history_list').html(response);
			}
	});
}
removeHistory = function(target, id){
	$.post('system/encoded/history.php', {
		remove_history: id,
		target: target,
		token: utk,
		}, function(response) {
			if(response == 1){
				$('.hist'+id).remove();
			}
			else {
				callSaved(system.error, 3);
			}
	});
}
kickUser = function(target){
	$.post('system/action.php', {
		kick: target,
		delay: $('#kick_delay').val(),
		reason: $('#kick_reason').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.actionComplete, 1);
			}
			else if (response == 2){
				callSaved(system.alreadyAction, 3);
			}
			else if (response == 3){
				callSaved(system.noUser, 3);
			}
			else {
				callSaved(system.error, 3);
			}
			hideOver();
	});
}
banUser = function(target){
	$.post('system/action.php', {
		ban: target,
		reason: $('#ban_reason').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.actionComplete, 1);
			}
			else if (response == 2){
				callSaved(system.alreadyAction, 3);
			}
			else if (response == 3){
				callSaved(system.noUser, 3);
			}
			else {
				callSaved(system.error, 3);
			}
			hideOver();
	});
}
muteUser = function(target){
	$.post('system/action.php', {
		mute: target,
		delay: $('#mute_delay').val(),
		reason: $('#mute_reason').val(),
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 1){
				callSaved(system.actionComplete, 1);
			}
			else if (response == 2){
				callSaved(system.alreadyAction, 3);
			}
			else if (response == 3){
				callSaved(system.noUser, 3);
			}
			else {
				callSaved(system.error, 3);
			}
			hideOver();
	});
}
eraseAccount = function(target){
	$.post('system/box/delete_account.php', {
		account: target,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
			}
			else {
				overEmptyModal(response);
			}
	});
}
confirmDelete = function(target){
	$.post('system/encoded/action_users.php', {
		delete_user_account: target,
		token: utk,
		}, function(response) {
			hideOver();
			hideModal();
			if(response == 1){
				callSaved(system.actionComplete, 1);
				$('#found'+target).remove();
			}
			else {
				callSaved(system.cannotUser, 3);
			}
	});
}
listAction = function(target, act){
	closeTrigger();
	if(act == 'ban'){
		banBox(target);
	}
	else if(act == 'kick'){
		kickBox(target);
	}
	else if(act == 'mute'){
		muteBox(target);
	}
	else if(act == 'change_rank'){
		adminGetRank(target);
	}
	else if(act == 'delete_account'){
		eraseAccount(target);
	}
	else {
		$.post('system/action.php', {
			take_action: act,
			target: target,
			token: utk,
			}, function(response) {
				if(response == 0){
					callSaved(system.cannotUser, 3);
				}
				else if(response == 1){
					hideOver();
					callSaved(system.actionComplete, 1);
					processAction(act);
				}
				else if(response == 2){
					callSaved(system.alreadyAction, 3);
				}
				else {
					callSaved(system.error, 3);
				}
		});
	}
}
uploadIcon = function(target, type){
	var upIcon = $(target).attr('data');
	if(type == 2){
		$('#'+target).removeClass('fa-spinner fa-spin fa-fw').addClass(upIcon);
	}
	else {
		$('#'+target).removeClass(upIcon).addClass('fa-spinner fa-spin fa-fw');
	}
}
uploadStatus = function(target, type){
	if(type == 2){
		$("#"+target).prop('disabled', true);
	}
	else {
		$("#"+target).prop('disabled', false);
	}
}
processAction = function(act){
	if(act == 'unmute'){
		$('.im_muted').remove();
	}
	else if(act == 'unban'){
		$('.im_banned').remove();
	}
}
removeSystemAction = function(elem, u, t){
	$.post('system/action.php', {
		target: u,
		take_action: t,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.cannotUser, 3);
			}
			else {
				$(elem).parent().remove();
			}
	});	
}
removeRoomAction = function(elem, action, target){
	$.post('system/action.php', {
		take_action: action,
		target: target,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(elem).parent().remove();
			}
			else {
				callSaved(system.error, 3);
			}
	});
}
appLeftMenu = function(aIcon, aText, aCall, optMenu){
	var qmenu = '';
	if(!optMenu){
		optMenu = '';
	}
	qmenu += '<div class="left_list left_item" onclick="'+aCall+'">';
	qmenu += '<div class="left_item_icon"><i class="fa fa-'+aIcon+' menui"></i></div>';
	qmenu += '<div class="left_item_text">'+aText+'</div>';
	if(optMenu != ''){
		qmenu += '<div class="left_item_notify">';
		qmenu += '<span id="'+optMenu+'" class="notif_left bnotify"></span>';
		qmenu += '</div>';
	}
	qmenu += '</div>';
	$(qmenu).insertAfter('#end_left_menu');
}
appPanelMenu = function(icon, text, pCall){
	var panMenu = '<div title="'+text+'" class="panel_option" onclick="'+pCall+'"><i class="fa fa-'+icon+'"></i></div>';
	$('#right_panel_bar').append(panMenu);
}
appMoreMenu = function(mText, mCall){
	var mmenu = '';
	mmenu += '<div class="left_drop_item more_left" onclick="'+mCall+'">';
	mmenu += '<div class="left_drop_text">'+mText+'</div>';
	mmenu += '</div>';
	$(mmenu).insertBefore('#chat_help_menu');
}
openMoreMenu = function(){
	$('#more_menu_list').toggle();
}
appInputMenu = function(mIcon, mCall){
	var inpMenu = '<div class="sub_options" onclick="'+mCall+'"><img src="'+mIcon+'"/></div>';
	$('#main_input_extra').append(inpMenu);
}
appPrivInputMenu = function(mIcon, mCall){
	var privInpMenu = '<div class="psub_options" onclick="'+mCall+'"><img src="'+mIcon+'"/></div>';
	$('#priv_input_extra').append(privInpMenu);
}
noDataTemplate = function(){
	return '<div class="pad_box"><p class="centered_element text_med sub_text">'+system.noResult+'</p></div>';
}
cleanData = function(){
	if(boomAllow(8)){
		$.ajax({
			url: "system/encoded/system_clean.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: { 
				clean_data: 1,
				token: utk
			},
			success: function(response){
				return false;
			},
			error: function(){
				return false;
			}
			
		});
	}
}
showHelp = function(){
	$.post('system/box/help.php', {
			token: utk,
		}, function(response) {
			showModal(response, 500);
	});
}
isStaff = function(urank){
	if(urank >= 8){
		return true;
	}
}
betterRank = function(urank){
	if(user_rank > urank){
		return true;
	}
}

var newsWait = 0;
uploadNews = function(){
	var file_data = $("#news_file").prop("files")[0];
	var filez = ($("#news_file")[0].files[0].size / 1024 / 1024).toFixed(2);
	if( filez > fmw ){
		callSaved(system.fileBig, 3);
	}
	else if($("#news_file").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(newsWait == 0){
			newsWait = 1;
			postIcon(1);
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("token", utk)
			$.ajax({
				url: "system/file_news.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code > 0){
						if(response.code == 1){
							callSaved(system.wrongFile, 3);
						}
						postIcon(2);
					}
					else {
						$('#post_file_data').attr('data-key', response.key);
						$('#post_file_data').html(response.file);
					}
					newsWait = 0;
				}
			})
		}
		else {
			return false;
		}
	}
}
getConsole = function(){
	$.post('system/box/console.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				showEmptyModal(response, 500);
			}
	});
}
sendConsole = function(){
	var console = $('#console_content').val();
	$.post('system/encoded/console.php', {
		run_console: console,
		token: utk,
		}, function(response) {
			if(response == 1){
				callSaved(system.confirmedCommand, 1);
			}
			else if(response == 2){
				callSaved(system.invalidCommand, 3);
			}
			else if(response == 3){
				callSaved(system.error, 3);
			}
			else if(response == 4){
				callSaved(system.noUser, 3);
			}
			else if(response == 5){
				callSaved(system.cannotUser, 3);
			}
			else if(response == 6){
				location.reload();
			}
			else {
				callSaved(system.invalidCommand, 3);
			}
			$('#console_content').val('');
	});
}
removeRoomStaff = function(elem, target){
	$.post('system/action.php', {
		remove_room_staff: 1,
		target: target,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(elem).parent().remove();
			}
			else {
				callSaved(system.error, 3);
			}
	});
}
openContact = function(){
	$.post('system/box/contact.php', {
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});
}
sendSupport = function(){
	var semail = $('#support_email').val();
	var smessage = $('#support_message').val();
	var ssubject = $('#support_subject').val();
	if(semail == '' || smessage == ''){
		callSaved(system.emptyField, 3);
		event.preventDefault();
	}
	else if (/^\s+$/.test(semail) || /^\s+$/.test(smessage)){
		callSaved(system.emptyField, 3);
		event.preventDefault();
	}
	else {
		$('#support_form').hide();
		$('#support_sending').show();
		$.post('system/send_support.php', { 
			email: semail,
			message: smessage,
			subject: ssubject,
			token: utk,
			}, function(response) {
				if(response == 1){
					$('#support_form').remove();
					$('#support_sending').hide();
					$('#support_sent').show();
				}
				else if(response == 2){
					$('#support_sending').hide();
					$('#support_form').show();
					$('#support_email').val('');
					callSaved(system.invalidEmail, 3);
				}
				else {
					hideModal();
					callSaved(system.error, 3);
					return false;
				}
		});
	}
}
openPlayer = function(){
	$('#player_box').toggle();
}
accessRoom = function(rt, rank){
	if(boomAllow(rank)){
		$.ajax({
			url: "system/action_room.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: { 
				pass: $('#pass_input').val(),
				room: rt,
				get_in_room: 1,
				token: utk
			},
			success: function(response){
				if(response.code == 10){
					if(curPage == 'chat'){
						resetRoom(response.id, response.name);
						hideOver();
					}
					else {
						location.reload();
					}
				}
				else if(response.code == 5){
					callSaved(system.wrongPass, 3);
					$('#pass_input').val('');
				}
				else if(response.code == 1){
					callSaved(system.error, 3);
				}
				else if(response.code == 2){
					callSaved(system.accessRequirement, 3);
				}
				else if(response.code == 4){
					callSaved(system.error, 3);
				}
				else if(response.code == 99){
					callSaved(system.roomBlock, 3);
				}
				else {
					callSaved(system.error, 3);
				}
			},
			error: function(){
				callSaved(system.error, 3);	
			}
		});
	}
	else {
		callSaved(system.accessRequirement, 3);
	}
}
var waitJoin = 0;
switchRoom = function(room, pass, rank){
	if(curPage == 'chat'){
		if(room == user_room){
			return false;
		}
	}
	if(waitJoin == 0){
		waitJoin = 1;
		if(boomAllow(rank)){
			if(pass == 1){
				$.post('system/box/pass_room.php', {
					room_rank: rank,
					room_id: room,
					token: utk
					}, function(response) {
						overModal(response);
						waitJoin = 0;
				});
			}
			else {
				$.ajax({
					url: "system/action_room.php",
					type: "post",
					cache: false,
					dataType: 'json',
					data: { 
						room: room,
						get_in_room: 1,
						token: utk
					},
					success: function(response){
						if(response.code == 10){
							if(curPage == 'chat'){
								resetRoom(response.id, response.name);
							}
							else {
								location.reload();
							}
						}
						else if(response.code == 99){
							callSaved(system.roomBlock, 3);
							waitJoin = 0;
						}
						else if(response.code == 3){
							callSaved(system.roomFull, 3);
							waitJoin = 0;
						}
						else {
							waitJoin = 0;
							return false;
						}
					},
					error: function(){
						callSaved(system.error, 3);	
					}
				});			
			}
		}
		else {
			callSaved(system.accessRequirement, 3);
			waitJoin = 0;
		}
	}
	else {
		return false;
	}
}
var waitRoom = 0;
addRoom = function(){
	var rrname = $('#set_room_name').val();
	if (/^\s+$/.test(rrname) || rrname == ''){
		callSaved(system.emptyField, 3);
	}
	else {
		if(waitRoom == 0){
			waitRoom = 1;
			$.ajax({
				url: "system/action_room.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: { 
					set_name: $("#set_room_name").val(),
					set_type: $("#set_room_type").val(),
					set_pass: $("#set_room_password").val(),
					set_description: $("#set_room_description").val(),
					token: utk
				},
				success: function(response){
					if(response.code == 1){
						callSaved(system.error, 3);
					}
					else if (response.code == 2){
						callSaved(system.roomName, 3);
					}
					else if (response.code == 5){
						hideModal();
						callSaved(system.maxRoom, 3);
					}
					else if (response.code == 6){
						callSaved(system.roomExist, 3);
					}
					else if(response.code == 7){
						if(curPage == 'chat'){
							hideModal();
							resetRoom(response.id, response.name);
						}
						else {
							location.reload();
						}
					}
					else {
						waitRoom = 0;
						return false;
					}
					waitRoom = 0;
				},
				error: function(){
					callSaved(system.error, 3);	
				}
			});
		}
		else {
			return false;
		}	
	}
}