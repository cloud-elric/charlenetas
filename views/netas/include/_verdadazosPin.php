<?php
use yii\helpers\Url;
use app\modules\ModUsuarios\models\Utils;

/* @var $post EntPosts*/
?>
<div class="pin pin-verdadazos" onclick="showPostFull('<?=$post->txt_token?>')" >
	<div class="pin-header pin-header-verdadazos" style="background-color: #1940e3 !important;"></div>
	<div class=image>
		<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<h3 class="pin-titulo">
 			<?=$post->txt_titulo?>
 		</h3>
		<div class="pin-descripcion" style="
    max-height: 200px;
    overflow: hidden;
"><?=Utils::subStrTexto($post->txt_descripcion, 500)?></div>
	</div>
	<?php
		include 'elementos/pins-social.php';
	?>
</div>
