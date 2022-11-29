var regSpinner = '<i class="fa fa-spinner fa-spin fa-fw reg_spinner"></i>';
var largeSpinner = '<div class="large_spinner"><i class="fa fa-spinner fa-spin fa-fw boom_spinner"></i></div>';


pageMenuSelect = function(){
	if($('.page_menu_item').length > 1){
		$('.page_menu_item').first().addClass('page_selected');
	}
}

selectIt = function(){
	$("select:visible").selectBoxIt({ 
		autoWidth: false,
		hideEffect: 'fadeOut',
		hideEffectSpeed: 100
	});
}
hideAll = function(){
	$('.hideall').hide();
	$('.sysmenu').hide();
}
adjustSubMenu = function(){
	$('#side_menu').hide();
}
hideSubMenu = function(){
	var mobWidth = $(window).width();
	if(mobWidth <= 1024){
		$('.sub_page_menu').hide();
	}
}
var curCall = '';
callSaved = function(text, type){
	var s = 3000;
	if(type == 1){
		s = 1000;
	}
	if(text == curCall && $('.saved_data:visible').length){
		return false;
	}
	else {
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
		$('.saved_data').fadeIn(300).delay(s).fadeOut();
		curCall = text;
	}
}
textArea = function(elem, height) {
    $(elem).css('height', height + 'px');
    $(elem).css('height', (elem.scrollHeight)+"px");
}
loadLob = function(p){
	hideAll();
	$.post('system/pages/'+p, { 
		token: utk,
		}, function(response) {
			$('#page_wrapper').html(response);
			selectIt();
			pageTop();
	});
}
loadWrap = function(content){
	$('#page_wrapper').html(content);
	selectIt();
	pageTop();
}
loadFirst = function(){
	if(loadPage != ''){
		$.post(loadPage, { 
			token: utk,
			}, function(response) {
				$('#page_wrapper').html(response);
				selectIt();
		});
	}
}
boomAllow = function(rnk){
	if(user_rank >= rnk){
		return true;
	}
	else {
		return false;
	}
}
isStaff = function(rnk){
	if(rnk >= 8){
		return true;
	}
	else {
		return false;
	}
}
showModal = function(r,s){
	hideAll();
	hideModal();
	if(!s){
		s = 400;
	}
	if(s == 0){
		s = 400;
	}
	$('.small_modal_in').css('max-width', s+'px');
	$('#small_modal_content').html(r);
	$('#small_modal').show();
	offScroll();
	modalTop();
	selectIt();
}
showEmptyModal = function(r,s){
	hideAll();
	hideModal();
	if(!s){
		s = 400;
	}
	if(s == 0){
		s = 400;
	}
	$('.large_modal_in').css('max-width', s+'px');
	$('#large_modal_content').html(r);
	$('#large_modal').show();
	offScroll();
	modalTop();
	selectIt();
}
overModal = function(r,s){
	hideAll();
	hideOver();
	if(!s){
		s = 400;
	}
	if(s == 0){
		s = 400;
	}
	$('.over_modal_in').css('max-width', s+'px');
	$('#over_modal_content').html(r);
	$('#over_modal').show();
	offScroll();
	selectIt();
}
overEmptyModal = function(r,s){
	hideAll();
	hideOver();
	if(!s){
		s = 400;
	}
	if(s == 0){
		s = 400;
	}
	$('.over_emodal_in').css('max-width', s+'px');
	$('#over_emodal_content').html(r);
	$('#over_emodal').show();
	offScroll();
	selectIt();
}
showSide = function(content, s){
	hideAll();
	if(!s){
		s = 400;
	}
	if(s == 0){
		s = 400;
	}
	$('#side_inside').html(content);
	$('#side_content').css('width', s).show();
	$('#side_inside').scrollTop(0);
	selectIt();
}
hideSide = function(){
	$('#side_inside').html('');
	$('#side_content').hide();
}
hideModal = function(){
	$('#small_modal_content, #large_modal_content').html('');
	$('#small_modal, #large_modal').hide();
	onScroll();
}
hideOver = function(){
	$('#over_modal_content, #over_emodal_content').html('');
	$('#over_modal, #over_emodal').hide();
	if(!$('#small_modal:visible').length && !$('#large_modal:visible').length){
		onScroll();
	}
}
hideAllModal = function(){
	hideModal();
	hideOver();
}
pageTop = function(){
	$("html, body").animate({ scrollTop: 0 }, "fast");
}
modalTop = function(){
	$(".modal_back").animate({ scrollTop: 0 }, "fast");
}
offScroll = function(){
	if(curPage != 'chat'){
		$('body').addClass('modal_open');
	}
}
onScroll = function(){
	if(curPage != 'chat'){
		$('body').removeClass('modal_open');
	}
	else {
		$('body').css('overflow', 'hidden');
	}
}
messagePlay = function(){
	if(boomSound(1)){
		document.getElementById('message_sound').play();
	}
}
clearPlay = function(){
	if(boomSound(1)){
		document.getElementById('clear_sound').play();
	}
}
joinPlay = function(){
	if(boomSound(1)){
		document.getElementById('join_sound').play();
	}
}
leavePlay = function(){
	if(boomSound(1)){
		document.getElementById('leave_sound').play();
	}
}
actionPlay = function(){
	if(boomSound(1)){
		document.getElementById('action_sound').play();
	}
}
whistlePlay = function(){
	if(boomSound(1)){
		document.getElementById('whistle_sound').play();
	}
}
privatePlay = function(){
	if(boomSound(2)){
		document.getElementById('private_sound').play();
	}
}
notifyPlay = function(){
	if(boomSound(3)){
		document.getElementById('notify_sound').play();
	}
}
usernamePlay = function(){
	if(boomSound(4)){
		document.getElementById('username_sound').play();
	}
}
newsPlay = function(){
	if(boomSound(3)){
		document.getElementById('news_sound').play();
	}
}
updateSession = function(){
	$.post('system/update_session.php', { 
		token: utk,
		}, function(response) {
			if(response == 0){
				location.reload();
			}
	});
}
lazyBoom = function(zone){
	$("#"+zone+" .lazyboom").each(function(){
		$(this).attr('src', $(this).attr('data-img'));
	});
}
closeTrigger = function(){
	$('.drop_list').slideUp(100);
}
getLanguage = function(){
	$.post('system/box/language.php', {
		}, function(response) {
				showModal(response, 240);
	});
}

showRules = function(){
	$.post('system/box/terms.php', {
		}, function(response) {
			overModal(response, 500);
	});
}
showPrivacy = function(){
	$.post('system/box/privacy.php', {
		}, function(response) {
			showModal(response, 500);
	});
}
boomClick = function(id){
	$("#"+id).trigger('click');
}
backLocation = function(){
	window.history.back();
	hideAll();
}
openSamePage = function(l){
	var addEmbed = '';
	if(pageEmbed == 1){
		addEmbed = '?embed=1';
	}
	window.location.href = l+addEmbed;
}
openLinkPage = function(l){
	window.open(l, '_BLANK');
}
openParentPage = function(l){
	window.open(l, '_PARENT');
}
checkPageHistory = function(){
	if(window.history.length <= 1){
		$('.back_location').hide();
	}
}
resetSelect = function(val){
	$('#'+val).selectBoxIt('selectOption', 0);
}
getBox = function(f, t, s){
	if(!s){
		s = 0;
	}
	if(curPage == 'chat'){
		closeLeft();
	}
	hideModal();
	$.post(f, { 
		token: utk,
		}, function(response) {
			if(t == 'modal'){
				showModal(response, s);
			}
			if(t == 'emodal'){
				showEmptyModal(response, s);
			}
			if(t == 'side'){
				showSide(response, s);
			}
			if(t == 'panel' && curPage == 'chat'){
				panelIt(s);
				chatRightIt(response);
			}
			else {
				return false;
			}
			selectIt();
	});	
}
getOver = function(f, t, s){
	if(!s){
		s = 0;
	}
	hideOver();
	$.post(f, { 
		token: utk,
		}, function(response) {
			if(t == 'over'){
				overModal(response, s);
			}
			if(t == 'eover'){
				overEmptyModal(response, s);
			}
			selectIt();
	});	
}
var boomDelay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();
boomAddCss = function(addFile){
	$('head').append('<link rel="stylesheet" href="'+addFile+bbfv+'" type="text/css" />');
}
adjustSide = function(){
		var winHeight = $(window).height();
		var sideTop = $('#side_top').outerHeight();
		$('#side_inside').css({ "height": winHeight - sideTop });	
}
loadLanguage = function(lang){
	$.post('system/load_lang.php', {
		lang: lang,
		}, function(response) {
			location.reload();
	});
}
showMenu = function(id){
	if($('#'+id+':visible').length){
		$('#'+id).hide();
	}
	else {
		$('#'+id).show();
	}
	$('.sysmenu').each(function(){
		if($(this).attr('id') != id){
			$(this).hide();
		}
	});
	
}
function hideMenu(){
	$('.sysmenu').each(function(){
		if($(this).attr('id') != id){
			$(this).hide();
		}
	});
}
boomSound = function(snd){
	if(uSound.match(snd)){
		return true;
	}
}
noAction = function(){
	console.log('there is no action on that button');
}
$(document).ready(function(){
	
	loadFirst();
	adjustSide();
	pageMenuSelect();
	checkPageHistory();
	
	if(curPage != 'chat' && logged == 1){
		updateSession();
		var upsess = setInterval(updateSession, 60000);
	}
	
	$(document).on('click', '.modal_menu_item', function(){
		var mmi = $(this).attr('data-z');
		if(mmi != 'void'){
			$(this).parent().find('.modal_menu_item').removeClass('modal_selected');
			$(this).addClass('modal_selected');
			$('#'+$(this).attr('data')+' .modal_zone').hide();
			lazyBoom(mmi);
			$('#'+$(this).attr('data-z')).fadeIn(200);
			selectIt();
		}
	});
	
	$(document).on('click', '.tab_menu_item', function(){
		$(this).parent().find('.tab_menu_item').removeClass('tab_selected');
		$(this).addClass('tab_selected');
		$('#'+$(this).attr('data')+' .tab_zone').hide();
		$('#'+$(this).attr('data-z')).fadeIn(200);
		selectIt();
	});
	
	$(document).on('click', '.reg_menu_item', function(){
		$(this).parent().find('.reg_menu_item').removeClass('reg_selected');
		$(this).addClass('reg_selected');
		$('#'+$(this).attr('data')+' .reg_zone').hide();
		$('#'+$(this).attr('data-z')).fadeIn(200);
		selectIt();
	});

	$(document).on('click', '.close_modal, .cancel_modal', function(){
		hideModal();
	});
	$(document).on('click', '.close_over, .cancel_over', function(){
		hideOver();
	});
	$(document).on('click', '.close_side, .cancel_side', function(){
		hideSide();
	});
	
	$(document).on('click', '#open_sub_mobile', function(){
		$('#side_menu').toggle();
	});
	
	$(document).on('click', '.get_dat', function(){
		var p = $(this).attr('data');
		loadLob(p);
	});
	
	$(document).on('click', '.open_page', function(){
		hideAll();
		var toPage = $(this).attr('data');
		window.open(toPage, '_blank'); 
	});
	
	$(document).on('click', '.getmenu', function(){
		var getPage = $(this).attr('data');
		window.location.href = getPage;
	});
	
	$(document).on('click', '#open_sub_mobile, #close_sub', function(){		
		$('.sub_page_menu').toggle();
	});
	
	$( window ).resize(function() {
		adjustSubMenu();
		adjustSide();
	});
	
	$('.fancybox').fancybox({
	  helpers: {
		overlay: {
		  locked: false
		}
	  }
	});
	
	$(document).on('click', '.getbox', function(){
		if(!$(this).attr('data-type')){
			return false;
		}
		if(!$(this).attr('data-box')){
			return false;
		}
		var dSize = 0;
		var dType = $(this).attr('data-type');
		var dFile = $(this).attr('data-box');
		if($(this).attr('data-size')){
			dSize = $(this).attr('data-size');
		}
		getBox(dFile, dType, dSize);
	});
	
	$(document).on('click', '.page_drop_control', function() {	
		$('.popen').hide();
		$('.pclose').show();
		if($(this).next('.page_drop').is(":visible")){
			$(this).next('.page_drop').slideUp(100);
		}
		else {
			$( ".page_drop" ).each(function() {
				$(this).hide();
			});
			$(this).next('.page_drop').slideDown(100);
			$(this).children('.page_drop_icon').children('.pclose').hide();
			$(this).children('.page_drop_icon').children('.popen').show();
		}
	});
	$(document).on('click', '.page_drop_item, .page_menu_item', function() {
		if(!$(this).hasClass('page_drop_control')){
			$('.page_drop_item, .page_menu_item').removeClass('page_selected');
			$(this).addClass('page_selected');
		}
	});
	
	$(document).click(function(e){
		var container = $(".sysmenu");
		if(!$(e.target).hasClass('menutrig')){
			if (!container.is(e.target) && container.has(e.target).length === 0){
				container.hide();
			}
		}
	});
	
	$(document).on('click', '.docu_head', function(){
		if($(this).next('.docu_content').is(":visible")){
			$(this).next('.docu_content').hide();
		}
		else {
			$( ".docu_content" ).each(function() {
				$(this).hide();
			});
			$(this).next('.docu_content').show();
		}
	});
	
	$(document).on('click', '.bswitch', function(){
		var cval = $(this).attr('data');
		var callback = $(this).attr('data-c');
		if(cval == 1){
			$(this).attr('data', 0);
			$(this).switchClass( "onswitch", "offswitch", 100);
			$(this).find('.bball').switchClass( "onball", "offball", 100, function(){ window[callback](); });
		}
		else if(cval == 0){
			$(this).attr('data', 1);
			$(this).switchClass( "offswitch", "onswitch", 100);
			$(this).find('.bball').switchClass( "offball", "onball", 100, function(){ window[callback](); });
		}
	});
	
	var modal = document.getElementById('small_modal');	
	var largeModal = document.getElementById('large_modal');

});