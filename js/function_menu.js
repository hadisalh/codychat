appAvMenu = function(type, icon, text, pCall){
	var cMenu = '<div data="" value="" data-av="" class="avset avitem" onclick="'+pCall+'"><i class="fa fa-'+icon+'"></i> '+text+'</div>';
	$('.av'+type).append(cMenu);
}
renderAvMenu = function(elem, uid, uname, urank, ubot, uflag, cover, age, gender){
	var avt = $(elem).find('.avav').attr('src');
	$('#action_menu .avset').attr('data', uid);
	$('#action_menu .avset').attr('value', uname);
	$('#action_menu .avset').attr('data-av', avt);
	$('#action_menu .avusername').text(uname);
	$('#action_menu .avavatar').attr('src', avt);
	if(cover != '' && cardCover > 0){
		$('#action_menu .avbackground').css('background-image', 'url("cover/' + cover + '")');
	}
	else {
		$('#action_menu .avbackground').css('background-image', '');
	}
	if(uflag != '' && uflag != 'ZZ'){
		$('.avflag').show();
		$('#action_menu .avflag').attr('src', 'system/location/flag/'+uflag+'.png');
	}
	else {
		$('.avflag').hide();
	}
	if(age > 0){
		$('#action_menu .avage').text(age+' '+userAge);
	}
	else {
		$('#action_menu .avage').text('');
	}
	if(gender != ''){
		$('#action_menu .avgender').text(gender);
	}
	else {
		$('#action_menu .avgender').text('');
	}
	var avHeight = 0;
	var avDrop = '';
	$("#action_menu .avheader").each(function(){
		avDrop += $(this)[0].outerHTML;
	});
	$("#action_menu .avinfo").each(function(){
		avDrop += $(this)[0].outerHTML;
	});
	if(uid == user_id){
		$("#action_menu .avself").each(function(){
			avDrop += $(this)[0].outerHTML;
		});
	}
	else if(ubot > 0){
		$("#action_menu .avbot").each(function(){
			avDrop += $(this)[0].outerHTML;
		});	
	}
	else if(isStaff(user_rank) && user_rank > urank){
		$("#action_menu .avstaff").each(function(){
			avDrop += $(this)[0].outerHTML;
		});
	}
	else if(!isStaff(urank) && roomRank > 3){
		$("#action_menu .avroomstaff").each(function(){
			avDrop += $(this)[0].outerHTML;
		});
	}
	else {
		$("#action_menu .avother").each(function(){
			avDrop += $(this)[0].outerHTML;
		});
	}
	return avDrop;
}
var avCurrent = '';
avMenu = function(elem, uid, uname, urank, ubot, uflag, cover, age, gender){
	var avDrop = renderAvMenu(elem, uid, uname, urank, ubot, uflag, cover, age, gender);
	$('#avcontent').html(avDrop);
	
	if($('#av_menu').css('left') != '-5000px' && elem == avCurrent){
		resetAvMenu();
	}
	else {
		avCurrent = elem;
		var zHeight = $(window).height();
		var offset = $(elem).offset();
		var emoWidth = $(elem).width();
		var emoHeight = $(elem).height();
		var avMenu = $('#avcontent').outerHeight();
		var avWidth = $('#av_menu').width();
		var footHeight = $('#my_menu').outerHeight();
		var inputHeight = $('#top_chat_container').outerHeight();
		var avSafe = avMenu + footHeight + inputHeight;
		if(offset.top > zHeight - avSafe){
			var avTop = zHeight - avSafe - 5;
		}
		else {
			var avTop = offset.top;
		}
		if(rtlMode == 1){
			var avLeft = offset.left - (avWidth + 5);
		}
		else {
			var avLeft = offset.left + emoWidth + 5;
		}
		$('#av_menu').css({
			'left': avLeft,
			'top': avTop,
			'height': avMenu,
			'z-index': 99,
		}, 100);
	}
}
dropUser = function(elem, uid, uname, urank, ubot, uflag, cover, age, gender){
	var avDrop = renderAvMenu(elem, uid, uname, urank, ubot, uflag, cover, age, gender);
	$('#avcontent').html(avDrop);

	if($('#av_menu').css('left') != '-5000px' && elem == avCurrent){
		resetAvMenu();
	}
	else {
		avCurrent = elem;
		var zHeight = $(window).height();
		var zWidth = $(window).width();
		var offset = $(elem).offset();
		var emoWidth = $(elem).width();
		var emoHeight = $(elem).outerHeight();
		var avMenu = $('#avcontent').outerHeight();
		var avWidth = $('#av_menu').width();
		var footHeight = $('#my_menu').outerHeight();
		var inputHeight = $('#top_chat_container').outerHeight();
		var avSafe = avMenu + footHeight;
		var avLeft = offset.left + 10;
		var leftSafe = zWidth - avWidth;
		if(offset.top > zHeight - avSafe){
			var avTop = zHeight - avSafe;
		}
		else {
			var avTop = offset.top + emoHeight - 10;
		}
		if(leftSafe > emoWidth){
			avLeft = offset.left - avWidth + 10;
		}
		$('#av_menu').css({
			'left': avLeft,
			'top': avTop,
			'height': avMenu,
			'z-index': 202,
		});
	}	
}
logMenu = function(elem,id,d,p){
	$('#log_menu_content .log_menu_item').attr('data', id);
	var menuLog = '';
	if(p == 1){
		$("#log_menu_content .log_report").each(function(){
			menuLog += $(this)[0].outerHTML;
		});
	}
	if(d == 1){
		$("#log_menu_content .log_delete").each(function(){
			menuLog += $(this)[0].outerHTML;
		});
	}
	$('#logmenu').html(menuLog);
	if($('#log_menu').css('left') != '-5000px'){
		resetLogMenu();
	}
	else {
		var zHeight = $(window).height();
		var offset = $(elem).offset();
		var emoWidth = $(elem).width();
		var emoHeight = $(elem).height();
		var avMenu = $('#logmenu').outerHeight();
		var avWidth = $('#log_menu').width();
		var footHeight = $('#my_menu').outerHeight();
		var inputHeight = $('#top_chat_container').outerHeight();
		var avSafe = avMenu + footHeight + inputHeight;
		if(offset.top > zHeight - avSafe){
			var avTop = zHeight - avSafe - 5;
		}
		else {
			var avTop = offset.top;
		}
		if(rtlMode == 1){
			var avLeft = offset.left + emoWidth;
		}
		else {
			var avLeft = offset.left - avWidth;
		}
		$('#log_menu').css({
			'left': avLeft,
			'top': avTop,
			'height': avMenu,
		});
	}	
}
resetLogMenu = function(){
	$('#logmenu').html('');
	$('#log_menu').css({
		'left': '-5000px',
	});	
}
resetAvMenu = function(){
	$('.avavatar').attr('src', '');
	$('#av_list').html('');
	$('#av_menu').css({
		'left': '-5000px',
	});	
}

$(document).ready(function(){

$(document).on('mouseleave', '#log_menu', function(){
	resetLogMenu();
});

$(document).click(function(e){
	var container = $(".avtrig");
	if(!$(e.target).hasClass('avtrig')){
		if (!container.is(e.target) && container.has(e.target).length === 0){
				resetAvMenu();
		}
	}
});

});