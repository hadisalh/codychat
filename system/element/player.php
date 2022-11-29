<?php if(usePlayer()){ ?>
<div id="player_options" class="player_options add_shadow hideall hidden">
	<div class="player_list_container">
		<p class="text_xsmall bold bpad5"><?php echo $lang['station_list']; ?></p>
		<div id="player_listing">
			<?php echo playerList(); ?>
		</div>
	</div>
	<div class="player_volume">
		<div id="sound_display" class="bcell_mid">
			<i class="fa fa-volume-down show_sound"></i>
		</div>
		<div id="player_volume" class="bcell_mid boom_slider">
			<div id="slider"></div>
		</div>
	</div>
</div>
<div class="music_player">
	<div class="player_menu" onclick="togglePlayer();" >
		<i class="fa fa-sliders"></i>
	</div>
	<div id="player_actual_status" class="player_button turn_on_play">
		<i id="current_play_btn" class="fa fa-play-circle"></i>
	</div>
	<div id="current_player" class="player_current hide_mobile">
		<p class="bellips text_xsmall theme_color"><?php echo $lang['station']; ?></p>
		<p class="bellips" id="current_station"><?php echo $radio['player_title']; ?></p>
	</div>
	<div class="bcell">
	</div>
</div>
<?php } ?>