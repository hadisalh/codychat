<?php
$load_addons = 'vip';
require_once('../../../system/config_addons.php');
if(boomAllow(2)){
	die();
}
if(vipOff()){
	die();
}
function vipBaseFeature(){
	global $data, $lang;
	$list = '';
	$vip_feature = array(
		'allow_avatar',
		'allow_cupload',
		'allow_name',
		'allow_mood',
		'emo_plus',
		'allow_name_color',
		'allow_colors',
		'allow_direct',
		'allow_room',
		'allow_theme',
		'allow_history',
	);
	foreach($vip_feature as $feature){
			if($data[$feature] == 2){
				$list .= boomTemplate('../addons/vip/system/template/vip_feature', $lang['vip_' . $feature]);
			}
	}
	return $list;
}
function vipExtraFeature(){
	global $lang;
	$list = '';
	$i = 1;
	while($i <= 20){
		if($lang['vip_custom_feature' . $i] != ''){
			$list .= boomTemplate('../addons/vip/system/template/vip_feature', $lang['vip_custom_feature' . $i]);
		}
		$i++;
	}
	return $list;
}
?>
<div id="vip_main_content" class="pad15">
	<div id="vippart1" class="vippart">
		<div class="hpad10">
			<div class="vip_text_top centered_element bold pad5">
				<p class="text_med"><?php echo $lang['vip_feature_title']; ?></p>
			</div>
			<div class="vip_text_intro centered_element bpad15">
				<p class="text_small sub_text"><?php echo $lang['vip_feature_text']; ?></p>
			</div>
		</div>
		<div class="vip_table_list text_small hpad10 bpad15">
			<?php echo vipBaseFeature(); ?>
			<?php echo vipExtraFeature(); ?>
		</div>
		<div class="vip_button_box centered_element vpad15">
			<button onclick="vipPart('vippart2');" class="reg_button ok_btn"><i class="fa fa-suitcase"></i> <?php echo $lang['vip_take']; ?></button>
		</div>
	</div>
	<div id="vippart2" class="vippart hidden">
		<?php if(boomAllow(1)){ ?>
		<div class="hpad10 bpad10">
			<div class="vip_text_top centered_element bold pad5">
				<p class="text_med"><?php echo $lang['vip_plan_title']; ?></p>
			</div>
			<div class="vip_text_intro centered_element bpad15">
				<p class="text_small sub_text"><?php echo $lang['vip_plan_text']; ?></p>
			</div>
		</div>
		<div class="hpad15 bpad15">
			<div class="vip_table_list text_small bpad10">
				<?php echo boomTemplate('../addons/vip/system/template/vip_pricing',1); ?>
				<?php echo boomTemplate('../addons/vip/system/template/vip_pricing',2); ?>
				<?php echo boomTemplate('../addons/vip/system/template/vip_pricing',3); ?>
				<?php echo boomTemplate('../addons/vip/system/template/vip_pricing',4); ?>
				<?php echo boomTemplate('../addons/vip/system/template/vip_pricing',5); ?>
			</div>
		</div>
		<div id="vip_cart" class="hpad15 bpad15 centered_element hidden">
			<p class="sub_text text_small" id="vip_selected_title">---</p>
			<p class="bold text_med"><?php echo vipSymbol($data['custom7']); ?><span id="vip_selected_price">---</span> <?php echo $data['custom7']; ?></p>
			<div class="vpad15">
				<button value="0" onclick="showSpin();vipPaypal(this);" id="vip_selected" class="reg_button paypal_btn"><i class="fa fa-paypal"></i> <?php echo $lang['vip_checkout']; ?></button>
			</div>
		</div>
		<?php } ?>
		<?php if(!boomAllow(1)){ ?>
		<div class="hpad10 bpad10">
			<div class="vip_text_top centered_element bold pad5">
				<p class="text_med"><?php echo $lang['register']; ?></p>
			</div>
			<div class="vip_text_intro centered_element vpad10">
				<p class="text_small sub_text"><?php echo $lang['vip_guest']; ?></p>
			</div>
			<div class="vpad15 centered_element">
				<button class="cancel_modal reg_button ok_btn"><i class="fa fa-times"></i> <?php echo $lang['close']; ?></button>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<div id="vip_spin_box" class="hidden pad15 centered_element">
	<p><i class="fa fa-spinner fa-spin vip_spinner success"></i></p>
	<p class="text_small tpad15"><?php echo $lang['vip_redirect']; ?></p>
</div>
<script data-cfasync="false">
	vipPart = function(part){
		$('.vippart').hide();
		$('#'+part).show();
	}
	showSpin = function(part){
		$('#vip_main_content').hide();
		$('#vip_spin_box').show();
	}
	vipPlan = function(item, plan){
		if($('#vip_selected').attr('value') == plan){
			$(item).children('.vip_checkbox').children('i').removeClass('fa-check-circle').addClass('fa-circle-thin').removeClass('success');
			$('#vip_selected').attr('value', 0);
			$('#vip_selected_title').text('---');
			$('#vip_selected_price').text('---');
			$('#vip_cart').hide();
		}
		else {
			$('#vip_selected').attr('value', plan);
			$('.vip_checkbox').children('i').removeClass('fa-check-circle').addClass('fa-circle-thin').removeClass('success');
			$(item).children('.vip_checkbox').children('i').removeClass('fa-circle-thin').addClass('fa-check-circle').addClass('success');
			$('#vip_selected_title').text($(item).children('.vip_plan_title').text());
			$('#vip_selected_price').text($(item).children('.vip_price_cell').children('.vip_price').text());
			$('#vip_cart').show();
		}
	}
	vipPaypal = function(item){
		$.post('addons/vip/system/payment/paypal.php', { 
			plan: $(item).attr('value'),
			ref: window.location.href,
			token: utk,
			}, function(response) {
				if(response == 0){
					callSaved(system.error, 3);
					hideModal();
				}
				else if(response.indexOf("Fatal") >= 1 || response.indexOf("error") >= 1){
					callSaved(system.error, 3);
					hideModal();
				}
				else {
					openSamePage(response);
				}
		});
	}
</script>