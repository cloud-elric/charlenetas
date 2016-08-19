<?php
use app\models\EntUsuariosSubscripciones;
?>
<h1>Espejo</h1>
<?=$post->txt_descripcion?><br>
<?=$post->idUsuario->nombreCompleto?><br>
<?=$post->idUsuario->txt_imagen?><br>
<?=$post->fch_creacion?><br>

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
// Obtenemos la respuesta para el post
$respuesta = $post->entRespuestasEspejo;

// Si ya se contesto la pregunta
if (! empty ( $respuesta )) {
	echo $respuesta->txt_respuesta . '<br>';
	echo $respuesta->fch_publicacion_respuesta . '<br>';
	
	// Este dato imprime 1 si el usuario quien pregunto esta de acuerdo con la respuesta y 0 para no estar de acuerdo
	echo $respuesta->b_de_acuerdo . '<br>';
} else {
	echo 'Pregunta no contestada aún';
}
?>
