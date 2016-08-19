<?php
/* @var $post EntPosts*/
?>

<div class="pin pin-alquimia" data-post="<?=$post->txt_token?>">
	<div class="pin-header pin-header-alquimia"></div>
	<div class="image">
		<img data-src="assets/images/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<h3 class="pin-titulo">
			<?=$post->txt_titulo?>
		</h3>
		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>
		<div class="pin-alquimia-grades">
			<span>Calificacion Charlenetas</span>

			<!-- //TODO:: poner el "for2 para por cada numero de calificción total poner las estrellas -->
			<div class="star-wrapper">
			<?php
			// Asignamos el modelo de alquimia a una variable
			$alquimia = $post->entAlquimias;
			
			// Pintar estrellas
			echo $alquimia->generarEstrellas(5, $alquimia->num_calificacion_admin);
			?>
			</div>

			<span>Los usuarios</span>
			<div class="star-wrapper">
				<?php 
				// Pintar estrellas
				echo $alquimia->generarEstrellas(5, $alquimia->num_calificacion_usuario);
				?>
			</div>
		</div>
	</div>

	<?php
		include 'elementos/pins-social.php';
	?>


	<!--?=$post->fch_creacion?-->
</div>
