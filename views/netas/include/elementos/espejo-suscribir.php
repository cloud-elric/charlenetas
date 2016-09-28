<?php
use app\models\EntUsuariosLikePost;
use yii\helpers\Html;
use app\models\EntUsuariosSubscripciones;

$onclick = '';
$likeActivado = '';
if (Yii::$app->user->isGuest) {
	$onclick = 'showModalLogin();';
} else if (EntUsuariosLikePost::existsUsuarioLike ( Yii::$app->user->identity->id_usuario, $post->id_post )) {

	$likeActivado = ' did-usr-interact';
	$onclickLike = 'removeLikePost("'.$post->txt_token.'")';
} else {
	$onclickLike = 'addLikePost("'.$post->txt_token.'")';
}
?>

<div class="feedback js-feedback-like <?=$likeActivado?>" id="js-feedback-like-<?=$post->txt_token?>" onclick='<?=$onclickLike?>'
	data-token='<?=$post->txt_token?>'>
	<span id='js-like-<?=$post->txt_token?>'><?=Html::encode($post->num_likes)?></span>
	<i class="icon icon-thumbs-up"></i>
</div>
<?php
if (! Yii::$app->user->isGuest) {
	$usuarioIsSubscrito = EntUsuariosSubscripciones::findSubscripcion ( Yii::$app->user->identity->id_usuario, $post->id_post );
	$onclick = 'suscribirseEspejo("' . $post->txt_token . '");';
	$messageSub = 'Suscribir a la Pregunta';
	$subsActivado ='';

	// Validación de usuario ya se haya subscrito
	if ($usuarioIsSubscrito) {
		$onclick = 'desSuscribirseEspejo("' . $post->txt_token . '");';
		$messageSub = 'Suscrito a la Pregunta';
		$subsActivado = ' did-usr-interact';
	}

	?>
<div class="feedback js-feedback-like <?=$subsActivado?>" id="js-subs-like-<?=$post->txt_token?>" onclick='<?=$onclick?>'
	data-token='<?=$post->txt_token?>'>
	<span id='js-suscriptores-<?=$post->txt_token?>'><?=$post->entEspejos->num_subscriptores?></span>
	<i class="icon icon-fire"></i>
</div>
<?php
}

?>
