<?php 
require('../../../system/config_session.php');
?>
<div class="top_mod">
	<div class="top_mod_empty pad10">
		<div class="reg_menu">
			<ul>
				<li class="reg_menu_item" data="youtube_tab" data-z="youtube_results"><i class="fa fa-youtube"></i> Youtube</li>
			</ul>
		</div>
	</div>
	<div class="top_mod_option close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="btable tmargin5">
	<div class="bcell_mid hpad10">
		<input class="full_input" onkeydown="youtubeSearch(event, this);" placeholder="&#xf002;" id="find_youtube" type="text"/>
	</div>
</div>
<div id="youtube_tab" class="pad10">
	<div class="youtube_results reg_zone" id="youtube_results"></div>
</div>