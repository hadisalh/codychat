<?php
$ignore = getIgnore();
?>
<?php if(!mySelf($boom['user_id']) && !ignored($boom) && insideChat($boom['page'])){ ?>
<div data="<?php echo $boom['user_id']; ?>" value="<?php echo $boom['user_name']; ?>" data-av="<?php echo myAvatar($boom['user_tumb']); ?>" class="gprivate fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-comments theme_color"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['private']; ?>
	</div>
</div>
<?php } ?>
<?php if(canFriend($boom) && !ignored($boom) && isMember($data) && isMember($boom)){ ?>
<div onclick="addFriend(<?php echo $boom['user_id']; ?>);" class="fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-user-plus success"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['add_friend']; ?>
	</div>
</div>
<?php } ?>
<?php if(!canFriend($boom) && !ignored($boom) && isMember($data) && isMember($boom)){ ?>
<div onclick="unFriend(<?php echo $boom['user_id']; ?>);" class="fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-user-times error"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['unfriend']; ?>
	</div>
</div>
<?php } ?>
<?php if(!isIgnored($ignore, $boom['user_id']) && canIgnore($boom)){ ?>
<div onclick="ignoreUser(<?php echo $boom['user_id']; ?>);" class="fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-ban error"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['ignore']; ?>
	</div>
</div>
<?php } ?>
<?php if(isIgnored($ignore, $boom['user_id'])){ ?>
<div onclick="unIgnore(<?php echo $boom['user_id']; ?>);" class="fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-check-circle success"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['unignore']; ?>
	</div>
</div>
<?php } ?>
<?php if(!canManageReport() && !mySelf($boom['user_id']) && !isBot($boom) && canReport()){ ?>
<div onclick="openReport(<?php echo $boom['user_id']; ?>, 4);" class="fmenu_item">
	<div class="fmenu_icon">
		<i class="fa fa-flag warn"></i>
	</div>
	<div class="fmenu_text">
		<?php echo $lang['report']; ?>
	</div>
</div>
<?php } ?>