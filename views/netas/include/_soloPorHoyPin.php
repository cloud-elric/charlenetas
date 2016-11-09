<?php
use yii\helpers\Url;

/* @var $post EntPosts*/
?>
<div class="pin pin-solo-por-hoy" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header pin-header-solo-por-hoy"></div>
	<div class=image>
		<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">

		<a href="http://www.ordenjuridico.gob.mx/Constitucion/articulos/<?=$post->entSoloPorHoys->num_articulo?>.pdf" target="_blank" class="margin-bottom-10px">Artículo <?=$post->entSoloPorHoys->num_articulo?></a>

		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>
		<div class="pin-link">
			<a class="waves-effect waves-light btn btn-secondary" href="<?=$post->txt_url?>" target="_blank">Ver nota</a>
		</div>
	</div>
	<?php
		include 'elementos/pins-social.php';
	?>
</div>
