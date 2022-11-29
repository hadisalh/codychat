<html>
<head>
</head>
<body>
	<div>
		<?php echo $lang['subject']; ?> : <?php echo $boom['subject']; ?>
	</div>
	<div>
		<?php echo $lang['email']; ?> : <?php echo $boom['email']; ?>
	</div>
	<div>
		<?php echo $lang['username']; ?> : <?php echo $data['user_name']; ?>
	</div>
	<div>
		<?php echo $lang['user_rank']; ?> : <?php echo rankTitle($data['user_rank']); ?>
	</div>
	<br/>
	<div>
		<?php echo $boom['content']; ?>
	</div>
</body>
</html>