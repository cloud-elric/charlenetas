<?php
/* @var $post EntPosts*/
?>

<div onclick="showPostFull('<?=$post->txt_token?>')" class=pin>
	<div class=image>
		<img data-src="images/03fb13e8.image1.jpg">
	</div>
	<div class=description>
		
		<div class="">
				<?=$post->txt_titulo?><br>
		</div>
		<div class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</div>


			<?=$post->id_usuario_administrador?><br>
			<?=$post->fch_creacion?><br>
			<?=$post->txt_imagen?><br>
			<?=$post->entAlquimias->num_calificacion_admin?><br>
			<?=$post->entAlquimias->num_calificacion_usuario?><br></div>
	<div class=credits>Sample credits</div>

</div>
