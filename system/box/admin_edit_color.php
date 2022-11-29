<?php
require_once('../config_session.php');
if(!isset($_POST['target'])){
	die();
}
$target = escape($_POST['target']);
$user = userDetails($target);

if(!canModifyColor($user)){
	echo 99;
	die();
}
?>
<div class="pad_box">
	<div class="preview_zone border_bottom">
		<p class="label"><?php echo $lang['preview']; ?></p>
		<p id="preview_name" class="<?php echo myColorFont($user); ?>"><?php echo $user['user_name']; ?></p>
	</div>
	<div class="user_color" data-u="<?php echo $user['user_id']; ?>" data="<?php echo $user['user_color']; ?>">
		<?php if(canNameGrad() || canNameNeon()){ ?>
		<div class="reg_menu_container tmargin10">		
			<div class="reg_menu">
				<ul>
					<li class="reg_menu_item reg_selected" data="color_tab" data-z="reg_color"><?php echo $lang['color']; ?></li>
					<?php if(canNameNeon()){ ?>
					<li class="reg_menu_item" data="color_tab" data-z="neon_color"><?php echo $lang['neon']; ?></li>
					<?php } ?>
					<?php if(canNameGrad()){ ?>
					<li class="reg_menu_item" data="color_tab" data-z="grad_color"><?php echo $lang['gradient']; ?></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<div id="color_tab">
			<div id="reg_color" class="reg_zone vpad5">
				<?php echo colorChoice($user['user_color'], 1); ?>
				<div class="clear"></div>
			</div>
			<?php if(canNameGrad()){ ?>
			<div id="grad_color" class="reg_zone vpad5 hide_zone">
				<?php echo gradChoice($user['user_color'], 1); ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
			<?php if(canNameNeon()){ ?>
			<div id="neon_color" class="reg_zone vpad5 hide_zone">
				<?php echo neonChoice($user['user_color'], 1); ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
	<div>
		<?php if(canNameFont()){ ?>
		<div class="setting_element">
			<p class="label"><?php echo $lang['font']; ?></p>
			<select id="fontitname">
				<?php echo listNameFont($user['user_font']); ?>
			</select>
		</div>
		<?php } ?>
		<?php if(!canNameFont()){ ?>
		<input id="fontitname" value="" class="hidden"/>
		<?php } ?>
	</div>
	<div class="tpad10">
		<button onclick="saveUserColor(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
	</div>
</div>