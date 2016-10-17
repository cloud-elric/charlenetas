<?php
use yii\helpers\Url;

/* @var $post EntPosts*/
?>
<div class="pin pin-verdadazos" onclick="showPostFull('<?=$post->txt_token?>')" >
	<div class=image>
		<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>">
	</div>
</div>
