<?php
function commandosEscape($t){
	global $mysqli;
	$atags = '<a><p><h1><h2><h3><h4><ul><li><b><strong><br><i><span><u><strike><small><font><center><blink><marquee>';
	$t = strip_tags($t, $atags);
	return $mysqli->real_escape_string(trim($t));
}
?>