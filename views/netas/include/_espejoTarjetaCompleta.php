<?php
use app\models\EntUsuariosSubscripciones;
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use app\models\ConstantesWeb;
use app\models\EntRespuestasEspejo;
$usuario = $post->idUsuario;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />

<p id='js-suscriptores-<?=$post->txt_token?>'><?=$post->entEspejos->num_subscriptores?></p>
<br>
<?php
/**
 *
 * @todo Colocar al usuario correspondiente
 */

if (! Yii::$app->user->isGuest) {
	$usuarioIsSubscrito = EntUsuariosSubscripciones::findSubscripcion ( Yii::$app->user->identity->id_usuario, $post->id_post );
	$onclick = 'suscribirseEspejo("' . $post->txt_token . '");';
	$messageSub = 'Suscribir a la Pregunta';

	// Validación de usuario ya se haya subscrito
	if ($usuarioIsSubscrito) {
		$onclick = 'desSuscribirseEspejo("' . $post->txt_token . '");';
		$messageSub = 'Suscrito a la Pregunta';
	}

	?>
<div id="js-btn-suscribirse-<?=$post->txt_token?>"
	onclick='<?=$onclick?>' style="border: 1px solid black"><?=$messageSub?></div>
<?php
}

?>


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

// Si el usuario es el administrador podra responder al usuario
if(Yii::$app->user->identity->id_tipo_usuario==ConstantesWeb::USUARIO_ADMINISTRADOR){
	 $this->render('@app/modules/modAdminPanel/views/admin/_formRespuestaEspejo', ['respuesta'=>$respuesta]);
	
}?>
