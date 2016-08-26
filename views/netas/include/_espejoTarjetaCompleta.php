<?php
use app\models\EntUsuariosSubscripciones;
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
?>


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
	$messageSub = 'Me interesa la pregunta';

	// Validación de usuario ya se haya subscrito
	if ($usuarioIsSubscrito) {
		$onclick = 'desSuscribirseEspejo("' . $post->txt_token . '");';
		$messageSub = 'No me interesa la pregunta';
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
		<?=Html::img ( $post->idUsuario->getImageProfile (), [ 'width' => '50px','alt'=>'Avatar de NetaAdmin que respondio en el Espejo'] )?>
		</div>

	</div>

</section>

<section class="full-pin-body full-pin-body-espejo">
	<h3><!--?=$post->txt_titulo?--></h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>


</section>




<section class="full-pin-respuesta">


	<?php
	include 'elementos/respuesta-admin.php'
	?>

</section>
