<?php 
/* @var $post EntPosts*/
?>


<div class="pin pin-solo-por-hoy" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header"></div>

	<div class=image>
		<img data-src="assets/images/<?=$post->txt_imagen?>">
	</div>



	<div class="pin-content-wrapper" lang="en">
		<a href="<?=$post->entSoloPorHoys->num_articulo?>">Artículo <?=$post->entSoloPorHoys->num_articulo?></a>

		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>

		<div class="pin-link">
			<h3><a href="<?=$post->txt_url?>">Ver nota</a></h3>
		</div>
</div>

