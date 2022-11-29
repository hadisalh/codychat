<?php
include(addonsLang('quizbot'));
?>
<script data-cfasync="false">

quizLeaderboard = function(){
	$.post('addons/quizbot/system/leaderboard.php', { 
		token: utk,
		}, function(response) {
		showModal(response, 420);
	});
}

$(document).ready(function(){
	appLeftMenu('question-circle', '<?php echo $lang['quiz_leaderboard']; ?>', 'quizLeaderboard();');
	boomAddCss('addons/quizbot/files/quizbot.css');
});
</script>