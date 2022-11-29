<?php if(canEditRoom() && canRoomAction($boom, 6)){ ?>
<div class="bpad25">
	<p class="label"><?php echo $lang['room_rank']; ?></p>
	<select onChange="changeRoomRank(<?php echo $boom['user_id']; ?>);" id="room_staff_rank">
		<?php echo listRoomRank($boom['room_ranking']); ?>
	</select>
</div>
<?php } ?>
<?php if($boom['is_muted'] == 0 && canRoomAction($boom, 4, 2)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_mute');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-microphone-slash warn"></i></div>
	<div class="sub_list_content"><?php echo $lang['mute']; ?></div>
</div>
<?php } ?>
<?php if($boom['is_muted'] > 0 && canRoomAction($boom, 4, 2)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_unmute');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-microphone warn"></i></div>
	<div class="sub_list_content"><?php echo $lang['unmute']; ?></div>
</div>
<?php } ?>
<?php if($boom['is_blocked'] == 0 && !mainRoom() && canRoomAction($boom, 5, 2)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_block');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-hand-paper-o error"></i></div>
	<div class="sub_list_content"><?php echo $lang['block']; ?></div>
</div>
<?php } ?>
<?php if($boom['is_blocked'] > 0 && !mainRoom() && canRoomAction($boom, 5, 2)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_unblock');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-hand-paper-o error"></i></div>
	<div class="sub_list_content"><?php echo $lang['unblock']; ?></div>
</div>
<?php } ?>