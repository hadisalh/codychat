<div id="menu_main_footer">
	<ul>
		<li><?php echo date('Y'); ?> ©<span class="theme_color"> <?php echo $data['title']; ?></span></li>
		<li class="bclick"><a href="<?php echo $data['domain']; ?>"><?php echo $lang['home']; ?></a></li>
		<li class="bclick"><a href="<?php echo $data['domain'] . '/terms.php'; ?>"><?php echo $lang['rules']; ?></a></li>
		<li class="bclick"><a href="<?php echo $data['domain'] . '/privacy.php'; ?>"><?php echo $lang['privacy']; ?></a></li>
		<?php if(!boomLogged()){ ?>
		<li class="bclick" onclick="getLanguage();"><i class="fa fa-language"></i> <?php echo $lang['language']; ?></li>
		<?php } ?>
		<?php if(bridgeMode(1)){ ?>
		<li class="bclick" onclick="getLogin();"><?php echo $lang['login']; ?></li>
		<?php } ?>
	</ul>
</div>