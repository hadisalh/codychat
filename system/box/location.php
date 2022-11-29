<?php
require('../config_session.php');
?>

<div class="pad15">
	<div class="setting_element ">
		<p class="label"><?php echo $lang['language']; ?></p>
		<select id="set_profile_language">
			<?php echo listLanguage($data['user_language'], 1); ?>
		</select>
	</div>
	<div class="form_split">
		<div class="form_left_full">
			<div class="setting_element ">
				<p class="label"><?php echo $lang['country']; ?></p>
				<select id="set_profile_country">
					<?php echo listCountry($data['country']); ?>
				</select>
			</div>
		</div>
		<div class="form_right_full">
			<div class="setting_element ">
				<p class="label"><?php echo $lang['user_timezone']; ?></p>
				<select id="set_profile_timezone">
					<?php echo getTimezone($data['user_timezone']); ?>
				</select>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="tpad15">
		<button onclick="saveLocation();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
		<button class="cancel_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>