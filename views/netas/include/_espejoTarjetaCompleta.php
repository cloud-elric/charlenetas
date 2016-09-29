<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use app\models\ConstantesWeb;
use app\models\EntRespuestasEspejo;
$usuario = $post->idUsuario;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">

	<h2>El Espejo</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: <?=$post->idUsuario->nombreCompleto?></h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_creacion))?></h6>
		</div>

		<div class="post-publisher-avatar">
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>

	</div>

</section>

<section class="full-pin-body full-pin-body-espejo">
	<h3>
		<!--?=$post->txt_titulo?-->
	</h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>

	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
		</div>
		<div class="full-pin-body-footer-feedbacks">
			<?php
				include 'elementos/espejo-suscribir.php';
			?>
		</div>
	</div>

</section>
<?php
// Obtenemos la respuesta para el post
$respuesta = $post->entRespuestasEspejo;

// Si el admin ya  contesto la pregunta
if (! empty ( $respuesta )) {
	?>

<section class="full-pin-respuesta">


	<?php

	include 'elementos/respuesta-admin.php';?>

</section>
<?php }else{
	$respuesta = new EntRespuestasEspejo();
}

?>
