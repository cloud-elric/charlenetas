<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $post EntPosts*/
?>

<div class="pin pin-alquimia" onclick="showPostFull('<?=$post->txt_token?>')" id="js-alquimia-<?=$post->txt_token?>">
	<div class="pin-header pin-header-alquimia"></div>
	<div class="image">
		<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<h3 class="pin-titulo">
			<?=$post->txt_titulo?>
		</h3>
		<div class="pin-descripcion" style="
    max-height: 500px;
    overflow: hidden;
"><?=$post->txt_descripcion?></div>
		<div class="pin-alquimia-grades">
			<span>Calificación Charlenetas</span>
			<?php
			// Asignamos el modelo de alquimia a una variable
			$alquimia = $post->entAlquimias;
			?>
			<?=$alquimia->contenedorEstrellas(Html::encode($alquimia->num_calificacion_admin))?>
			<span>Calificación netanautas</span>
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
