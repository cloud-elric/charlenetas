<?php
/* @var $post EntPosts*/
?>

<div class="pin pin-solo-por-hoy">
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
			<h3><a href="<?=$post->txt_url?>"> Ver nota</a></h3>
		</div>
	</div>








	<div class="pin-social">
		<div class="pin-social-counters-wrapper">
			<div class="pin-social-interactions">
				<span>140</span>
				<i class="glyphicon glyphicon-thumbs-up margin-right-20"></i>
				<span>45</span>
				<i class="glyphicon glyphicon-comment"></i>
			</div>
		</div>
	</div>
</div>
