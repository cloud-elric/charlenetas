<?php
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;

/* @var $post EntPosts*/
?>
<div class="pin pin-hoy-pense" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header pin-header-hoy-pense"></div>
	<div class=image>
		<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<h3 class="pin-titulo">
 			<?=$post->txt_titulo?>
 		</h3>
		<div class="pin-descripcion" style="
    max-height: 500px;
    overflow: hidden;
">
			<?=$post->txt_descripcion?>
		</div>
	</div>
	<?php
		include 'elementos/pins-social.php';
	?>
</div>
