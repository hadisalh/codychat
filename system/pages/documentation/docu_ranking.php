<?php
require_once('../../config_session.php');
?>
<?php echo elementTitle('Ranking system'); ?>
<div class="page_element">
	<div class="docu_box">
		<div class="docu_head sub_list">
			Guest
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Do not have any special previlege</li>
					<li>Subject to system staff and room admin action.</li>
					<li>Account will not be permanent and erased by system.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			User
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Do not have any special previlege</li>
					<li>Subject to system staff and room admin action.</li>
					<li>Permanent account non subject to system account clear.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-diamond ico_vip"></i> Vip member
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can have access to more feature depending of Owner choice in limit options.</li>
					<li>Subject to system staff and room admin action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-user ico_radmin"></i> Room owner
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can clear room logs</li>
					<li>Can block members from specific room.</li>
					<li>Can mute user from specific room.</li>
					<li>Can manage room settings from specific room.</li>
					<li>Subject to system staff action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-user ico_radmin"></i> Room admin
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can clear room logs</li>
					<li>Can block members from specific room.</li>
					<li>Can mute user from specific room.</li>
					<li>Subject to system staff and room owner action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-user ico_rmod"></i> Room moderator
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can clear room logs</li>
					<li>Can mute user from specific room.</li>
					<li>Subject to system staff and room owner action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-shield ico_mod"></i> Moderator
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can enter password room without providing password.</li>
					<li>Can mute members.</li>
					<li>Can unmute members.</li>
					<li>Can delete chat logs.</li>
					<li>Can delete wall post.</li>
					<li>Can interact on reports.</li>
					<li>Subject to admin and Owner action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-star ico_admin"></i> Admin
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can enter password room without providing password.</li>
					<li>Can manually verify members.</li>
					<li>Can mute members.</li>
					<li>Can unmute members.</li>
					<li>Can ban members.</li>
					<li>Can unban members.</li>
					<li>Can delete chat logs.</li>
					<li>Can delete wall post.</li>
					<li>Can interact on reports.</li>
					<li>Can access admin panel with limited options.</li>
					<li>Can edit some part of members account.</li>
					<li>Can change user color name.</li>
					<li>Can create vip.</li>
					<li>Can create moderator.</li>
					<li>Can create room admin.</li>
					<li>Subject to Owner Action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-star ico_sadmin"></i> Super Admin
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can do pretty much everything owner can do</li>
					<li>Limited access to some admin area</li>
					<li>Subject to Owner Action.</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="docu_box">
		<div class="docu_head sub_list">
			<i class="fa fa-trophy ico_owner"></i> Owner
		</div>
		<div class="docu_content">
			<div class="docu_description">
				<ul class="docu_sub_list">
					<li>Can do everything</li>
					<li>Is not subject to any action.</li>
				</ul>
			</div>
		</div>
	</div>
</div>