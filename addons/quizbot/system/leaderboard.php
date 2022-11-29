<?php
$load_addons = 'quizbot';
require_once('../../../system/config_addons.php');

$leader_list = '';

function quizLeader($lead, $rank){
	global $lang;
	$add_me = '';
	if(mySelf($lead['user_id'])){
		$add_me = 'noview';
	}
	return '<div class="ulist_item ' . $add_me . '">
				<div class="ranking_lm">
					' . $rank . '
				</div>
				<div class="get_info ulist_avatar" data="' . $lead['user_id'] . '">
					<img src="' . myAvatar($lead['user_tumb']) . '"/>
				</div>
				<div class="ulist_name">
					<p class="username ' . myColor($lead) . '">' . $lead["user_name"] . '</p>
				</div>
				<div class="score_lm">
					' . $lead['quiz_score'] . '
				</div>
			</div>';
}

$get_leader = $mysqli->query("SELECT * FROM boom_users WHERE quiz_score > 0 AND user_bot = 0 ORDER BY quiz_score DESC LIMIT 100");
if($get_leader->num_rows > 0){
	$rank = 1;
	while($lead = $get_leader->fetch_assoc()){
		$leader_list .= quizLeader($lead, $rank);
		$rank++;
	}
}
else {
	$leader_list .= emptyZone($lang['no_data']);
}
?>
<div class="ulist_container">
	<?php echo $leader_list; ?>
</div>

