<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">

var snippet = 'snippet';
var youtubeLimit = 16;
var youtubeTemplate = '';
var youtubeMode = 1;
var youtubeTarget = 0;

getYoutube = function(md){
	youtubeMode = md;
	if(md == 2){
		youtubeTarget = $('#get_private').attr('value');
	}
	else {
		youtubeTarget = 0;
	}
	if(youtubeTemplate == ''){
		$.post('addons/youtube/system/youtube_template.php', {
			token: utk,
			}, function(response) {
				showEmptyModal(response, 400);
				youtubeTemplate = response;
		});
	}
	else {
		showEmptyModal(youtubeTemplate, 400);
	}
}
youtubeItemTemplate = function(youId, youTitle, youTumb){
	ytmp = '';
	ytmp += '<div onclick="sendYoutube(\''+youId+'\');" class="btable you_result">';
	ytmp += '<div class="bcell pad5">';
	ytmp += '<img class="you_tumb" src="'+youTumb+'" autoplay loop/>';
	ytmp += '<div class="you_text"><p class="bold">'+youTitle+'</p></div>';
	ytmp += '</div>';
	ytmp += '</div>';
	return ytmp;
}

startYoutubeSearch = function(event, item){
	var youtubeContent = $(item).val();
	if(event.keyCode == 13 && event.shiftKey == 0){
		if (/^\s+$/.test(youtubeContent) || youtubeContent == ''){
			return false;
		}
		else {
			youtubeSearch(youtubeContent);
		}
	}
}
sendYoutube = function(yid){
	hideModal();
	$.post('addons/youtube/system/action.php', {
		id: yid,
		type: youtubeMode,
		target: youtubeTarget,
		token: utk,
		}, function(response) {
			if(response == 20){
				callSaved(system.cannotContact, 3);
			}
	});	
}
youtubeSearch = function(event, item){
	if(event.keyCode == 13 && event.shiftKey == 0){
		var youtubeContent = $(item).val();
		$('#find_youtube').val('');
		if (/^\s+$/.test(youtubeContent) || youtubeContent == ''){
			return false;
		}
		else{
			$.ajax({
				url: "addons/youtube/system/youtube_search.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: { 
					youtube_search: youtubeContent,
					token: utk,
				},
				success: function(data){
					if (typeof data == 'object' && data.pageInfo.totalResults > 0 && data.pageInfo.resultsPerPage > 0) {
						$('#youtube_results').html('');
						$('#youtube_results').scrollTop(0);
						for (var i = 0; i < data.items.length; i++) {
							$('#youtube_results').append(youtubeItemTemplate(data.items[i].id.videoId, data.items[i].snippet.title, data.items[i].snippet.thumbnails.medium.url));	
						}
					}
					else{
						$('#youtube_results').html(noDataTemplate());
					}
				},
			});	
		}
	}
}

$(document).ready(function(){
	appInputMenu('<?php echo $data['domain']; ?>/addons/youtube/files/youtube.svg', 'getYoutube(1);');
	appPrivInputMenu('<?php echo $data['domain']; ?>/addons/youtube/files/youtube.svg', 'getYoutube(2);');
	boomAddCss('addons/youtube/files/youtube.css');
});

</script>
<?php } ?>