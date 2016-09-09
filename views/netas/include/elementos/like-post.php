<?php
use app\models\EntUsuariosLikePost;
use yii\helpers\Html;

$onclick = '';
$likeActivado = '';
if (Yii::$app->user->isGuest) {
	$onclick = 'showModalLogin();';
} else if (EntUsuariosLikePost::existsUsuarioLike ( Yii::$app->user->identity->id_usuario, $post->id_post )) {
	
	$likeActivado = ' did-usr-interact';
	$onclick = 'removeLikePost("'.$post->txt_token.'")';
} else {
	$onclick = 'addLikePost("'.$post->txt_token.'")';
}
?>
<div class="feedback js-feedback-like <?=$likeActivado?>" id="js-feedback-like-<?=$post->txt_token?>" onclick='<?=$onclick?>'
	data-token='<?=$post->txt_token?>'>
	<span id='js-like-<?=$post->txt_token?>'><?=Html::encode($post->num_likes)?></span>
	<i class="icon icon-thumbs-up"></i>
</div>