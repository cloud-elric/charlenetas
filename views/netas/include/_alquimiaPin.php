<?php
use yii\helpers\Html;

/* @var $post EntPosts*/
?>

<div class="pin pin-alquimia" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header pin-header-alquimia"></div>
	<div class="image">
		<img src="assets/images/<?=$post->txt_imagen?>">
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
			<?php
			// Asignamos el modelo de alquimia a una variable
			$alquimia = $post->entAlquimias;
			?>
			<?=$alquimia->contenedorEstrellas(Html::encode($alquimia->num_calificacion_admin))?>
			<span>Los usuarios</span>
			<div class="star-wrapper">
				<?php 
				// Pintar estrellas
				echo $alquimia->generarEstrellas($alquimia->num_calificacion_usuario);
				?>
			</div>
		</div>
	</div>
	<?php
		include 'elementos/pins-social.php';
	?>

	<!--?=$post->fch_creacion?-->
</div>
