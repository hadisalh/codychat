<div onclick="newsLike(<?php echo $boom['like_post']; ?>, 1);" class="like_count <?php echo $boom['liked']; ?>">
	<img class="like_icon" src="<?php echo $data['domain']; ?>/default_images/reaction/like.svg"/> <?php echo $boom['like_count']; ?>
</div>
<div onclick="newsLike(<?php echo $boom['like_post']; ?>, 2);" class="like_count <?php echo $boom['disliked']; ?>">
	<img class="like_icon" src="<?php echo $data['domain']; ?>/default_images/reaction/dislike.svg"/> <?php echo $boom['dislike_count']; ?>
</div>
<div onclick="newsLike(<?php echo $boom['like_post']; ?>, 3);" class="like_count <?php echo $boom['loved']; ?>">
	<img class="like_icon" src="<?php echo $data['domain']; ?>/default_images/reaction/love.svg"/> <?php echo $boom['love_count']; ?>
</div>
<div onclick="newsLike(<?php echo $boom['like_post']; ?>, 4);" class="like_count <?php echo $boom['funned']; ?>">
	<img class="like_icon" src="<?php echo $data['domain']; ?>/default_images/reaction/funny.svg"/> <?php echo $boom['fun_count']; ?>
</div>