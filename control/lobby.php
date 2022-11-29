<?php
include('header.php');
?>
<div id="page_content">
	<div id="page_global">
		<div class="page_indata">
			<div id="page_wrapper">
				<div class="room_options">
					<?php if(canRoom()){ ?>
					<button class="reg_button theme_btn" onclick="openAddRoom();"><i class="fa fa-plus"></i> <?php echo $lang['add_room']; ?></button>
					<?php } ?>
				</div>
				<div id="container_rooms">
					<?php echo getRoomList('box'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script data-cfasync="false" src="js/function_lobby.js<?php echo $bbfv; ?>"></script>

					