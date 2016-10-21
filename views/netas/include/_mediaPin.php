<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;

/* @var $post EntPosts*/
?>
<a class="pin pin-media" href="<?=Html::encode($post->txt_url)?>" target="_blank">
	<div class="pin-header pin-header-media"></div>
	<div class=image>
		<img src="http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($post->txt_url)?>/mqdefault.jpg">
	</div>
	<div class="pin-video-icon">
		<i class="large material-icons">play_circle_outline</i>
	</div>
	<div class="pin-content-wrapper" lang="en">
		<p class="pin-descripcion">
			<?= $post->txt_descripcion?>
		</p>
	</div>
</a>
