var divider = 5;
var divider2 = 5;
var lastWidth = $(window).width();

lastActive = function(){
	if(lastWidth > 1024){
		divider = 8;
		hideArrow(8);
	}
	if(lastWidth < 600){
		divider = 4;
		hideArrow(4);
	}
	if(lastWidth < 500){
		divider = 3;
		hideArrow(3);
	}
	if(lastWidth < 400){
		divider = 2;
		hideArrow(2);
	}
	var calAct = $('.last-clip').width() / divider;
	$('.active_user').width(calAct);
}

$(document).ready(function(){

	lastActive();
	
	var scrollIncrement = $('.last-clip').width();
	
	$("#last_active").on("click", ".left-arrow", function() {
	  var current = $('#last_active .last_10').position().left;
	  if(-current > 0) {
		$('#last_active .last_10').animate({left: current + scrollIncrement});
	  }
	});
	
	$("#last_active").on("click", ".right-arrow", function() {
		if(lastWidth > 1024){
			divider2 = 8;
		}
		if(lastWidth < 600){
			divider2 = 4;
		}
		if(lastWidth < 500){
			divider2 = 3;
		}
		if(lastWidth < 400){
			divider2 = 2;
		}
		var current = $('#last_active .last_10').position().left;
		if(-current/scrollIncrement < $('#last_active .active_user').length/divider2 - 1) {
		$('#last_active .last_10').animate({left: current - scrollIncrement});
		}
	});
	
});