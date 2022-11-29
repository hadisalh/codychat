<?php
$load_addons = 'giphy';
require('../../../system/config_addons.php');
?>
<div class="top_mod">
	<div class="top_mod_empty pad10">
		<div class="reg_menu">
			<ul>
				<li onclick="giphySelect(1);" class="reg_menu_item reg_selected" data="giphy_tab" data-z="giphy_gifs"><?php echo $lang['gifs']; ?></li>
				<li onclick="giphySelect(2);" class="reg_menu_item" data="giphy_tab" data-z="giphy_stickers"><?php echo $lang['stickers']; ?></li>
			</ul>
		</div>
	</div>
	<div class="top_mod_option close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="btable tmargin5">
	<div class="bcell_mid hpad10">
		<input class="full_input" onkeydown="startGiphySearch(event, this);" placeholder="&#xf002;" id="find_giphy" type="text"/>
	</div>
</div>
<div id="giphy_tab" class="pad10">
	<div class="giphy_results reg_zone" id="giphy_gifs"></div>
	<div class="giphy_results reg_zone hide_zone" id="giphy_stickers"></div>
</div>