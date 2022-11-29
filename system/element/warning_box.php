<?php
switch($boom['type']){
	case 'neutral':
		$color = 'boom_neutral';
		$icon = 'exclamation-circle';
		break;
	case 'success':
		$color = 'boom_success';
		$icon = 'check-circle';
		break;
	case 'warning':
		$color = 'boom_warning';
		$icon = 'exclamation-triangle';
		break;
	case 'error':
		$color = 'boom_error';
		$icon = 'ban';
		break;
	default:
		$color = 'boom_neutral';
		$icon = 'exclamation-circle';
}
?>
<div class="btable warning_box <?php echo $color; ?>">
	<div class="warning_box_icon">
		<i class="fa fa-<?php echo $icon; ?>"></i>
	</div>
	<div class="warning_box_text">
		<?php echo $boom['message']; ?>
	</div>
</div>