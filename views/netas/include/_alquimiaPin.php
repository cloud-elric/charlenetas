<?php
/* @var $post EntPosts*/
?>

<div class=pin>
	<div class=image>
		<img data-src="images/03fb13e8.image1.jpg">
	</div>
	<div class=description><span onclick="showPostFull('<?=$post->txt_token?>')">Ver más</span><br>
		<div class="clase-de-alf-que-hace-algo">
				<?=$post->txt_titulo?><br>
		</div>
			<?=$post->txt_descripcion?><br>

			<?=$post->id_usuario_administrador?><br>
			<?=$post->fch_creacion?><br>
			<?=$post->txt_imagen?><br>
			<?=$post->entAlquimias->num_calificacion_admin?><br>
			<?=$post->entAlquimias->num_calificacion_usuario?><br></div>
	<div class=credits>Sample credits</div>

</div>
