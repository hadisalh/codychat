<?php
function quizPost($id, $room, $message){
	global $mysqli, $lang;
	$message = softEscape($message);
	botPostChat($id, $room, $message);
}
function quizCleaning($message){
	return
	str_replace(array('&#039;', '&apos;', "&quot;", "&#34;", "&gt;", "&#62;", "&lt;", "&#60;", "&#38;", "&amp;"),
				array("'", "'", '"', '"', '>', '>', '<', '<', '&', '&'),
				$message
	);
}
function quizArray($v){
	$qarray = array("'", '-', '<', '>', '&');
	if(in_array($v, $qarray)){
		return true;
	}
}
function quizBox($content, $color){
	return '<div class="quiz_text ' . $color . '">' . $content . '</div>';
}
function countWord($content){
	$cal = preg_split('/\s+/', $content);
	$count = count($cal);
	return $count;
}
function postQuestion(){
	global $lang, $quiz;
	$count = countWord($quiz['custom7']);
	$content = 
	str_replace(
		array('%question%', '%words%', '%qsign%'),
		array('<span>' . $quiz['custom6'] . '</span>', $count, '<i class="fa fa-question-circle"></i>'),
		$lang['question']
	);
	$content = quizBox($content, 'quiz_question');
	quizPost($quiz['bot_id'], $quiz['custom1'], $content);
}
function postScramble(){
	global $lang, $quiz;
	$content = 
	str_replace(
		array('%question%', '%psign%'),
		array('<span>' . $quiz['custom6'] . '</span>', '<i class="fa fa-puzzle-piece"></i>'),
		$lang['scramble']
	);
	$content = quizBox($content, 'quiz_question');
	quizPost($quiz['bot_id'], $quiz['custom1'], $content);
}
function postWinner(){
	global $mysqli, $lang, $quiz, $winner, $pass;
	$s = quizScore($pass);
	$ts = $s + $winner['quiz_score'];
	$score = str_replace('%points%', $s, $lang['points']);
	$tscore = str_replace('%points%', $ts, $lang['points']);
	$content = 
	str_replace(
		array('%user%', '%answer%', '%score%', '%tscore%', '%wsign%'),
		array('<span>' . $winner['user_name'] . '</span>', '<span>' . $quiz['custom7'] . '</span>', '<span>' . $score . '</span>', '<span>' . $tscore . '</span>', '<i class="fa fa-trophy"></i>'),
		$lang['good']
	);
	$content = quizBox($content, 'quiz_good');
	quizPost($quiz['bot_id'], $quiz['custom1'], $content);
	$mysqli->query("UPDATE boom_users SET quiz_score = quiz_score + $s WHERE user_id = '{$winner['user_id']}'");
}
function postHint(){
	global $lang, $quiz;
	$hint = quizHint($quiz['custom7']);
	if($hint !== 0){
		$content = 
		str_replace(
			array('%answer%', '%hsign%'),
			array('<span>' . $hint . '</span>', '<i class="fa fa-star"></i>'),
			$lang['hint']
		);
		$content = quizBox($content, 'quiz_hint');
		quizPost($quiz['bot_id'], $quiz['custom1'], $content);
	}
}
function postFail(){
	global $lang, $quiz;
	$hint = $quiz['custom7'];
	$content = 
	str_replace(
		array('%answer%', '%qcommand%'),
		array('<span>' . $hint . '</span>', '<span>!quiz</span>'),
		$lang['sorry']
	);
	$content = quizBox($content, 'quiz_bad');
	quizPost($quiz['bot_id'], $quiz['custom1'], $content);
}
function quizHint($answer){
	$answer = trim($answer);
	$c = explode(' ', $answer);
	$n = count($c);
	$d = $n - 1;
	$t = 0;
	$string = '';
	if($n > 1){
		while($t <= $d){
			if ($t % 2 !== 0) {
				$string .= $c[$t];
			}
			else {
				$string .= ' ____ ';
			}
			$t++;
		}
		return $string;
	}
	else {
		if(strlen($answer) > 1){
			return scrambleHint($answer);
		}
		else {
			return 0;
		}
	}
}
function listQuiz($f){
	$quiz_list = '';
	foreach(glob(__DIR__ . '/quiz/*.*') as $file) {
		$file = str_replace(__DIR__ . '/quiz/', '', $file);
		$quiz_list .= '<option ' . selCurrent($f, $file) . ' value="' . $file . '">' . $file . '</option>';
	}
	return $quiz_list;
}
function listScramble($f){
	$scramble_list = '';
	foreach(glob(__DIR__ . '/scramble/*.*') as $file) {
		$file = str_replace(__DIR__ . '/scramble/', '', $file);
		$scramble_list .= '<option ' . selCurrent($f, $file) . ' value="' . $file . '">' . $file . '</option>';
	}
	return $scramble_list;
}
function quizType($type){
	global $lang;
	$quiz_type = '';
	$quiz_type .= '<option ' . selCurrent($type, 1) . ' value="1">' . $lang['quiz_mode'] . '</option>';
	$quiz_type .= '<option ' . selCurrent($type, 2) . ' value="2">' . $lang['scramble_mode'] . '</option>';
	$quiz_type .= '<option ' . selCurrent($type, 3) . ' value="3">' . $lang['mix_mode'] . '</option>';
	return $quiz_type;
}
function playerOn($room){
	global $mysqli;
	$delay = time() - 60;
	$count_player = $mysqli->query("SELECT user_id FROM boom_users WHERE last_action > '$delay' AND user_roomid = '$room'");
	if($count_player->num_rows > 0){
		return true;
	}
}
function quizFile(){
	global $quiz;
	if($quiz['custom3'] == 1){
		return $quiz['custom4'];
	}
	else if($quiz['custom3'] == 2){
		return $quiz['custom5'];
	}
	else if($quiz['custom3'] == 3){
		$sel = mt_rand(10,30);
		if($sel <= 20){
			return $quiz['custom4'];
		}
		else {
			return $quiz['custom5'];
		}
	}
	else {
		return $quiz['custom4'];
	}
}
function shuffleIt($str) {
    $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    shuffle($tmp);
    return join("", $tmp);
}
function scrambleHint($text){
	$text = quizCleaning($text);
	$array = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
	$t = 0;
	$hint = '';
	foreach($array as $key) {
		if(quizArray($key)){
			$hint .= $key . ' ';
		}
		else {
			if ($t == 0) {
				$hint .= $key . ' ';
				$t = 1;
			}
			else {
				$hint .= '_ ';
				$t = 0;
			}
		}
	}
	return $hint;
}
function quizScore($pass){
	switch($pass){
		case 0:
		case 1:
		case 2:
			return 100;
		case 3:
			return 90;
		case 4:
			return 80;
		case 5:
			return 70;
		case 6:
			return 60;
		case 7:
			return 50;
		case 8:
			return 40;
		case 9:
			return 30;
		default:
			return 20;
	}
}
function writeScore($score){
	global $lang;
	return str_replace('%points%', $score, $lang['points']);
}
function newScore($score, $add){
	return $score + $add;
}
?>