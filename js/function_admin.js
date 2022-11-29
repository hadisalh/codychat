$(document).ready(function(){
	
	reloadSystemConsole();
	reloadConsoleLogs = setInterval(reloadSystemConsole, 4500);
	
	$(document).on('click', '.save_admin', function(){
		var saveAdmin = $(this).attr('data');
		saveSettings(saveAdmin);
	});

	$(document).on('click', '#admin_save_room', function(){
		saveRoomAdmin();
	});
	
	$(document).on('click', '#search_member', function(){
		validSearch = $('#member_to_find').val().length;
		if(validSearch >= 1){
			$.post('system/encoded/action_search.php', {
				search_member: $('#member_to_find').val(),
				token: utk,
				}, function(response) {
					$('#member_list').html(response);
			});
		}
		else {
			callSaved(system.tooShort, 3);
		}
	});

	$(document).on('change', '#member_critera', function(){
		var checkCritera = $(this).val();
		if(checkCritera == 0){
			return false;
		}
		else {
			$.post('system/encoded/action_search.php', {
				search_critera: $(this).val(),
				token: utk,
				}, function(response) {
					$('#member_list').html(response);
			});
		}
	});

	$(document).on('click', '.delete_ip', function(){
		$.post('system/encoded/action_filter.php', {
			delete_ip: $(this).attr('data'),
			token: utk,
			}, function(response) {
				if(response == 1){
					loadLob('admin/setting_ip.php');
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	});

	$(document).on('change, paste, keyup', '#search_ip', function(){
		var searchIp = $(this).val().toLowerCase();
		if(searchIp == ''){
			$(".ip_box").each(function(){
				$(this).show();
			});	
		}
		else {
			$(".ip_box").each(function(){
				var ipData = $(this).text().toLowerCase();
				if(ipData.indexOf(searchIp) < 0){
					$(this).hide();
				}
				else if(ipData.indexOf(searchIp) > 0){
					$(this).show();
				}
			});
		}
	});

	var addonsReply = 1;
	$(document).on('click', '.activate_addons', function(){
		$(this).hide();
		$(this).prev('.work_button').show();
		if(addonsReply == 1){
			addonsReply = 0;
			$.ajax({
				url: "system/encoded/system_addons.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: { 
					activate_addons: 1,
					addons: $(this).attr('data'),
					token: utk,
				},
				success: function(response){
					if(response.code != 1){
						callSaved(response.error, 3);
					}
					loadLob('admin/setting_addons.php');
					addonsReply = 1;
				},
				error: function(){
					loadLob('admin/setting_addons.php');
					addonsReply = 1;
				}
			});
	
		}
		else {
			return false;
		}
	});
	$(document).on('change, paste, keyup', '#search_admin_room', function(){
		var searchRoom = $(this).val().toLowerCase();
		if(searchRoom == ''){
			$(".box_room").each(function(){
				$(this).show();
			});	
		}
		else {
			$(".box_room").each(function(){
				var roomData = $(this).text().toLowerCase();
				if(roomData.indexOf(searchRoom) < 0){
					$(this).hide();
				}
				else if(roomData.indexOf(searchRoom) > 0){
					$(this).show();
				}
			});
		}
	});
	
	var waitUpdate = 1;
	$(document).on('click', '.update_system', function(){
		if(waitUpdate == 1){
			waitUpdate = 0;
			$(this).hide();
			$(this).prev('.work_button').show();
			$.ajax({
				url: "system/encoded/system_update.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: { 
					version_install: $(this).attr('data'),
					token: utk,
				},
				success: function(response){
					if(response.code == 2){
						location.reload();
					}
					else {
						callSaved(response.error, 3);
					}
					loadLob('admin/setting_update.php');
					waitUpdate = 1;
				},
				error: function(){
					loadLob('admin/setting_update.php');
					waitUpdate = 1;
				}
			});
		}
		else {
			return false;
		}
	});
   
});
removeAddons = function(item, aname){
	$(item).hide();
	$(item).parent().children('.work_button').show();
	$(item).parent().children('.config_addons').hide();
	$.post('system/encoded/system_addons.php', {
		remove_addons: 1,
		addons: aname,
		token: utk,
		}, function(response) {
			loadLob('admin/setting_addons.php');
	});	
}
configAddons = function(aname){
	$.post('addons/'+aname+'/system/config.php', {
		addons: aname,
		token: utk,
		}, function(response) {
			loadWrap(response);
	});	
}
addWord = function(t, z, i){
	$.post('system/encoded/action_filter.php', {
		add_word: $('#'+i).val(),
		type: t,
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.dataExist, 3)
			}
			else if(response == 2){
				callSaved(system.emptyField, 3);
			}
			else if(response == 99){
				callSaved(registerKey, 3);
			}
			else {
				$('#'+z+' .empty_zone').hide();
				$('#'+z).prepend(response);
			}
			$('#'+i).val('');
	});	
}
deleteWord = function(t, id){
	$.post('system/encoded/action_filter.php', {
		delete_word: id,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(t).parent().remove();
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
openAddPlayer = function(){
	$.post('system/box/add_player.php', {
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});	
}
addPlayer = function(){
	var playerAlias = $('#add_player_alias').val();
	var playerUrl = $('#add_player_url').val();
	$.post('system/encoded/action_player.php', {
		player_alias: playerAlias,
		player_url: playerUrl,
		token: utk,
		}, function(response) {
			if(response == 1){
				hideModal();
				loadLob('admin/setting_player.php');
			}
			else if(response == 2){
				callSaved(system.emptyField, 3);
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
saveRoomAdmin = function(){
	$.post('system/action_room.php', {
		admin_set_room_id: $('#admin_save_room').attr('data'),
		admin_set_room_name: $('#set_room_name').val(),
		admin_set_room_description: $('#set_room_description').val(),
		admin_set_room_password: $('#set_room_password').val(),
		admin_set_room_player: $('#set_room_player').val(),
		admin_set_room_access: $('#set_room_access').val(),
		token: utk,

		}, function(response) {
			if(response == 1){
				callSaved(system.saved, 1);
				loadLob('admin/setting_rooms.php');
			}
			else if(response == 2){
				callSaved(system.roomExist, 3);
			}
			else if(response == 4){
				callSaved(system.roomName, 3);
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
saveSettings = function(source){
	if(source == 'main_settings'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'main_settings',
			set_index_path: $('#set_index_path').val(),
			set_title: $('#set_title').val(),
			set_timezone: $('#set_timezone').val(),
			set_default_language: $('#set_default_language').val(),
			set_site_description: $('#set_site_description').val(),
			set_site_keyword: $('#set_site_keyword').val(),
			token: utk,
			}, function(response) {
				if(response == 1){
					callSaved(system.saved, 1);
				}
				else if(response == 2){
					location.reload();
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	}
	if(source == 'maintenance'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'maintenance',
			set_maint_mode: $('#set_maint_mode').val(),
			token: utk,
			}, function(response) {
				if(response == 1){
					callSaved(system.saved, 1);
				}
				else if(response == 2){
					location.reload();
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	}
	else if(source == 'data_setting'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'data_setting',
			set_max_avatar: $('#set_max_avatar').val(),
			set_max_cover: $('#set_max_cover').val(),
			set_max_file: $('#set_max_file').val(),
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
	else if(source == 'player'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'player',
			set_default_player: $('#set_default_player').val(),
			token: utk,
			}, function(response) {
				if(response == 1){
					callSaved(system.saved, 1);
				}
				else if(response == 2){
					callSaved(system.saved, 1);
					loadLob('admin/setting_player.php');
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	}
	else if(source == 'email'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'email_settings',
			set_mail_type: $('#set_mail_type').val(),
			set_site_email: $('#set_site_email').val(),
			set_email_from: $('#set_email_from').val(),
			set_smtp_host: $('#set_smtp_host').val(),
			set_smtp_username: $('#set_smtp_username').val(),
			set_smtp_password: $('#set_smtp_password').val(),
			set_smtp_port: $('#set_smtp_port').val(),
			set_smtp_type: $('#set_smtp_type').val(),
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
	else if(source == 'registration'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'registration',
			set_registration: $('#set_registration').val(),
			set_regmute: $('#set_regmute').val(),
			set_activation: $('#set_activation').val(),
			set_max_username: $('#set_max_username').val(),
			set_min_age: $('#set_min_age').val(),
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
	else if(source == 'guest'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'guest',
			set_allow_guest: $('#set_allow_guest').val(),
			set_guest_form: $('#set_guest_form').val(),
			set_guest_talk: $('#set_guest_talk').val(),
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
	else if(source == 'social_registration'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'social_registration',
			set_facebook_login: $('#set_facebook_login').val(),
			set_facebook_id: $('#set_facebook_id').val(),
			set_facebook_secret: $('#set_facebook_secret').val(),
			set_google_login: $('#set_google_login').val(),
			set_google_id: $('#set_google_id').val(),
			set_google_secret: $('#set_google_secret').val(),
			set_twitter_login: $('#set_twitter_login').val(),
			set_twitter_id: $('#set_twitter_id').val(),
			set_twitter_secret: $('#set_twitter_secret').val(),
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
	else if(source == 'display'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'display',
			set_main_theme: $('#set_main_theme').val(),
			set_login_page: $('#set_login_page').val(),
			token: utk,
			}, function(response) {
				if(response == 1){
					callSaved(system.saved, 1);
				}
				else if(response == 2){
					location.reload();
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	}
	else if(source == 'bridge_registration'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'bridge_registration',
			set_use_bridge: $('#set_use_bridge').val(),
			token: utk,
			}, function(response) {
				if(response == 1){
					callSaved(system.saved, 1);
				}
				else if(response == 404){
					callSaved(system.noBridge, 3);
				}
				else {
					callSaved(system.error, 3);
				}
		});	
	}
	else if(source == 'limitation'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'limitation',
			set_allow_avatar: $('#set_allow_avatar').val(),
			set_allow_cover: $('#set_allow_cover').val(),
			set_allow_gcover: $('#set_allow_gcover').val(),
			set_allow_cupload: $('#set_allow_cupload').val(),
			set_allow_pupload: $('#set_allow_pupload').val(),
			set_allow_wupload: $('#set_allow_wupload').val(),
			set_emo_plus: $('#set_emo_plus').val(),
			set_allow_direct: $('#set_allow_direct').val(),
			set_allow_room: $('#set_allow_room').val(),
			set_allow_theme: $('#set_allow_theme').val(),
			set_allow_history: $('#set_allow_history').val(),
			set_allow_colors: $('#set_allow_colors').val(),
			set_allow_grad: $('#set_allow_grad').val(),
			set_allow_neon: $('#set_allow_neon').val(),
			set_allow_font: $('#set_allow_font').val(),
			set_allow_name_color: $('#set_allow_name_color').val(),
			set_allow_name_grad: $('#set_allow_name_grad').val(),
			set_allow_name_neon: $('#set_allow_name_neon').val(),
			set_allow_name_font: $('#set_allow_name_font').val(),
			set_allow_verify: $('#set_allow_verify').val(),
			set_allow_name: $('#set_allow_name').val(),
			set_allow_mood: $('#set_allow_mood').val(),
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
	else if(source == 'delays'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'delays',
			set_act_delay: $('#set_act_delay').val(),
			set_chat_delete: $('#set_chat_delete').val(),
			set_private_delete: $('#set_private_delete').val(),
			set_wall_delete: $('#set_wall_delete').val(),
			set_member_delete: $('#set_member_delete').val(),
			set_room_delete: $('#set_room_delete').val(),
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
	else if(source == 'modules'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'modules',
			set_use_wall: $('#set_use_wall').val(),
			set_use_lobby: $('#set_use_lobby').val(),
			set_cookie_law: $('#set_cookie_law').val(),
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
	else if(source == 'chat'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'chat',
			set_room_count: $('#set_room_count').val(),
			set_gender_ico: $('#set_gender_ico').val(),
			set_flag_ico: $('#set_flag_ico').val(),
			set_max_main: $('#set_max_main').val(),
			set_max_private: $('#set_max_private').val(),
			set_max_offcount: $('#set_max_offcount').val(),
			set_speed: $('#set_speed').val(),
			set_allow_logs: $('#set_allow_logs').val(),
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
	else if(source == 'security_registration'){
		$.post('system/encoded/system_save.php', { 
			save_admin_section: 'security_registration',
			set_use_recapt: $('#set_use_recapt').val(),
			set_recapt_key: $('#set_recapt_key').val(),
			set_recapt_secret: $('#set_recapt_secret').val(),
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
	else { 
		return false;
	}
}
testMail = function(target){
	$.post('system/encoded/system_save.php', {
		test_mail: 1,
		test_email: $('#test_email').val(),
		token: utk,
		}, function(response) {
			if(response == 1){
				callSaved(system.actionComplete, 1);
			}
			else {
				callSaved(system.error, 3);
			}
			hideModal();
	});
}
deleteRoom = function(item, id){
	$.post('system/encoded/system_action.php', {
		delete_room: id,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(item).parent().remove();
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
editRoom = function(id){
	$.post('system/box/edit_room.php', {
		edit_room: id,
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});	
}
openTestMail = function(target){
	$.post('system/box/test_mail.php', {
		token: utk,
		}, function(response) {
			showModal(response);
	});
}
savePlayer = function(id){
	$.post('system/encoded/action_player.php', {
		new_stream_url: $('#new_player_url').val(),
		new_stream_alias: $('#new_player_alias').val(),
		player_id: id,
		token: utk,
		}, function(response) {
			if(response == 1){
				hideModal();
				callSaved(system.saved, 1);
				loadLob('admin/setting_player.php');
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
moreAdminSearch = function(ct){
	var lct = $('#search_admin_list .sub_list_item:last').attr('id');
	lastCt = lct.replace('found', '');	
	$.post('system/encoded/action_search.php', {
		more_search_critera: ct,
		last_critera: lastCt,
		token: utk,
		}, function(response) {
			if(response == 0){
				$('#search_for_more').remove();
			}
			else {
				$('#search_admin_list').append(response);
			}
	});
	
}
roomAdmin = 0;
addAdminRoom = function(){
	var rType = $("#set_room_type").val();
	var rLimit = $("#set_room_limit").val();
	var rPass = $("#set_room_password").val();
	var rName = $("#set_room_name").val();
	var rDescription = $("#set_room_description").val();
	if (/^\s+$/.test(rName) || rName == ''){
		callSaved(system.emptyField, 3);
	}
	else if(roomAdmin == 0){
		roomAdmin = 1;
		$.post('system/action_room.php', { 
			admin_add_room: 1,
			admin_set_name: rName,
			admin_set_type: rType,
			admin_set_pass: rPass,
			admin_set_description: rDescription,
			token: utk
			}, function(response) {
				if(response == 0){
					callSaved(system.error, 3);
				}
				else if(response == 1){
					callSaved(system.error, 3);
				}
				else if (response == 2){
					callSaved(system.roomName, 3);
				}
				else if (response == 6){
					callSaved(system.roomExist, 3);
				}
				else {
					$('#room_listing').prepend(response);
					hideModal();
				}
				roomAdmin = 0;
		});
	}
	else {
		return false;
	}	
}
adminCreateRoom = function(){
	$.post('system/box/admin_create_room.php', {
		token: utk,
		}, function(response) {
			showModal(response);
	});
}
openAddNotify = function(){
	$.post('system/box/add_notify.php', {
		token: utk,
		}, function(response) {
			showModal(response, 460);
	});
}
deletePlayer = function(id, item){
	$.post('system/encoded/action_player.php', {
		delete_player: id,
		token: utk,
		}, function(response) {
			if(response == 1){
				$(item).parent().remove();
			}
			else if(response == 2){
				loadLob('admin/setting_player.php');
			}
			else {
				callSaved(system.error, 3);
			}
	});	
}
editPlayer = function(id){
	$.post('system/box/edit_player.php', {
		edit_player: id,
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});	
}
createUser = function(){
	$.post('system/box/create_user.php', {
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});	
}
waitCreate = 0;
addNewUser = function(){
	if(waitCreate == 0){
		waitCreate = 1;
		$.post('system/encoded/action_users.php', {
			create_user: 1,
			create_name: $('#set_create_name').val(),
			create_password: $('#set_create_password').val(),
			create_email: $('#set_create_email').val(),
			create_gender: $('#set_create_gender').val(),
			create_age: $('#set_create_age').val(),
			token: utk
			}, function(response) {
				if(response == 5){
					callSaved(system.invalidEmail, 3);
				}
				else if(response == 6){
					callSaved(system.emailExist, 3);
				}
				else if(response == 4){
					callSaved(system.usernameExist, 3);
				}
				else if(response == 3){
					callSaved(system.invalidUsername, 3);
				}
				else if(response == 2){
					callSaved(system.emptyField, 3);
				}
				else if (response == 1){
					callSaved(system.saved, 1);
					hideModal();
					loadLob('admin/setting_members.php');
				}
				waitCreate = 0;
		});
	}
}
savePageData = function(p, c){
	$.post('system/encoded/system_save.php', {
		page_content: $('#'+c).val(),
		page_target: p,
		save_page: 1,
		token: utk,
		}, function(response) {
			callSaved(system.saved, 1);
	});	
}
reloadSystemConsole = function(){
	var systemConsoleState = $('#search_system_console').val();
	if($('#console_logs_box:visible').length && systemConsoleState == ''){
		var lastConsole = 0;
		if($('.console_data_logs').length > 0){
			lastConsole = $('#console_results .console_data_logs:first').attr('value');
		}
		$.post('system/encoded/system_console.php', {
			reload_console: lastConsole,
			token: utk,
			}, function(response) {
				if(response == 0){
					return false;
				}
				else {
					$('#console_results .empty_zone').remove();
					$('#console_spinner').hide();
					$('#console_results').prepend(response);
				}
		});
	}
}
clearConsole = function(){
	$.post('system/box/console_confirm.php', {
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				overModal(response, 400);
			}
	});
}
clearSystemConsole = function(){
	$.post('system/encoded/system_console.php', {
		clear_console: 1,
		token: utk,
		}, function(response) {
			if(response == 0){
				return false;
			}
			else {
				hideOver();
				$('#console_results').html('');
				reloadSystemConsole();
			}
	});
}
searchSystemConsole = function(){
	boomDelay(function() {
		$('#console_results').html('');
		$('#console_spinner').show();
		$.post('system/encoded/system_console.php', {
			search_console: $('#search_system_console').val(),
			token: utk,
			}, function(response) {
				if(response == 0){
					return false;
				}
				else {
					$('#console_spinner').hide();
					$('#console_results').html(response);
				}
		});
	}, 1000);
}
setEmailFilter = function(){
	$.post('system/encoded/action_filter.php', {
		email_filter: $('#set_email_filter').val(),
		token: utk,
		}, function(response) {
	});	
}
setWordAction = function(){
	$.post('system/encoded/action_filter.php', {
		word_action: $('#set_word_action').val(),
		word_delay: $('#set_word_delay').val(),
		token: utk,
		}, function(response) {
	});	
}
setSpamAction = function(){
	$.post('system/encoded/action_filter.php', {
		spam_action: $('#set_spam_action').val(),
		spam_delay: $('#set_spam_delay').val(),
		token: utk,
		}, function(response) {
	});	
}
checkSpamFilter = function(){
	var spamValue = $('#set_spam_action').val();
	if(spamValue == 1){
		$('#spam_action_delay').removeClass('hidden');
		selectIt();
	}
	else {
		$('#spam_action_delay').addClass('hidden');
	}
}
checkWordFilter = function(){
	var wordValue = $('#set_word_action').val();
	if(wordValue == 2 || wordValue == 3){
		$('#word_action_delay').removeClass('hidden');
		selectIt();
	}
	else {
		$('#word_action_delay').addClass('hidden');
	}
}