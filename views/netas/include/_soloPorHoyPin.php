<?php
/* @var $post EntPosts*/
?>

<div class="pin pin-solo-por-hoy" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header pin-header-solo-por-hoy"></div>

	<div class=image>
		<img data-src="assets/images/<?=$post->txt_imagen?>">
	</div>



	<div class="pin-content-wrapper" lang="en">
		<a href="<?=$post->entSoloPorHoys->num_articulo?>" class="margin-bottom-10px">Artículo <?=$post->entSoloPorHoys->num_articulo?></a>

		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>

		<div class="pin-link">
			<a class="waves-effect waves-light btn btn-secondary" href="<?=$post->txt_url?>">Ver nota</a>
		</div>
	</div>




	<?php
		include 'elementos/pins-social.php';
	?>


</div>
