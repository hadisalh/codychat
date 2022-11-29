<?php
$load_addons = 'quizbot';
require(__DIR__ . '/../../../../system/config_cron.php');
$quiz = addonsData('quizbot');

$time = time();
$mode = 1;
$zone = 'quiz';

if($quiz['custom2'] == 0){
	die();
}

$file = quizFile();

if($file == $quiz['custom5']){
	$mode = 2;
	$zone = 'scramble';
}

$lines = file(__DIR__ . '/../' . $zone . '/' . $file);
$line_count = count($lines);
$random = rand(1,$line_count - 1);
$read = $lines[$random];

if($mode == 2){
	$dbquestion = escape(shuffleIt(trim($read)));
	$dbanswer = escape($read);
}
else {
	$question_line = explode('*',$read);
	$dbquestion = escape(trim($question_line[0]));
	$dbanswer = escape(trim($question_line[1]));
}
if($dbquestion == '' || $dbanswer == ''){
	die();
}
else {
	
	$mysqli->query("UPDATE boom_addons SET custom6 = '$dbquestion', custom7 = '$dbanswer' WHERE addons = '$load_addons'");
	$quiz = addonsData('quizbot');
	
	if(!playerOn($quiz['custom1'])){
		die();
	}
	if($mode == 2){
		postScramble();
	}
	else {
		postQuestion();
	}
	
	mysqli_close($mysqli);
	
	$pass = 0;
	while($pass < 11){
		usleep(5250000);
		$mysqli = @new mysqli(BOOM_DHOST, BOOM_DUSER, BOOM_DPASS, BOOM_DNAME);
		$check_answer = $mysqli->query("SELECT * FROM boom_chat WHERE post_message COLLATE UTF8_GENERAL_CI LIKE '%{$quiz['custom7']}%' AND post_date > '$time' ORDER BY post_date ASC LIMIT 1");
		
		if($check_answer->num_rows > 0){
			$winner_details = $check_answer->fetch_array(MYSQLI_BOTH);
			$winner = userDetails($winner_details['user_id']);
			postWinner();
			die();
		}
		else {
			if($pass == 5){
				postHint();
				$pass++;
				mysqli_close($mysqli);
			}
			else if($pass == 10){
				postFail();
				die();
			}
			else {
				$pass++;
				mysqli_close($mysqli);
			}
		}
	}
}
?>