<?php
use app\models\EntUsuariosFeedbacks;

foreach ( $feedbacks as $feedback ) {
	
	// did-usr-interact
	$onclick = '';
	$feedBackActivado = '';
	
	if (Yii::$app->user->isGuest) {
		$onclick = 'showModalLogin();';
	} else if (EntUsuariosFeedbacks::existFeedbackUsuario ( Yii::$app->user->identity->id_usuario, $comentario->id_comentario_post, $feedback->id_tipo_feedback )) {
	
		$feedBackActivado = 'did-usr-interact';
		$onclick = 'removeFeedback("' . $comentario->txt_token . '","' . $feedback->txt_token . '");';
		//$onclick = 'revisarFeedbacks("' . $comentario->txt_token . '","' . $feedback->txt_token . '");';
	} else {
		//$onclick = 'addFeedback("' . $comentario->txt_token . '","' . $feedback->txt_token . '");';
		$onclick = 'revisarFeedbacks("' . $comentario->txt_token . '","' . $feedback->txt_token . '");';
	}
	
	switch ($feedback->id_tipo_feedback) {
		case 1 : // like
			$numFeed = $comentario->num_likes;
			$icon = "icon-thumbs-up";
			break;
		case 2 : // no like
			$numFeed = $comentario->num_dislikes;
			$icon = "icon-thumbs-down";
			break;
		case 3 : // troll
			$numFeed = $comentario->num_trolls;
			$icon = "icon-trollface";
			break;
		default :
			$numFeed = '0';
			break;
	}
	?>
<div
	class="feedback js-feedback <?=$feedBackActivado?> js-feedback-<?=$comentario->txt_token?>"
	onclick='<?=$onclick?>' data-token='<?=$comentario->txt_token?>'
	data-tfb='<?=$feedback->txt_token?>'
	id='js-feedback-<?=$comentario->txt_token?>-<?=$feedback->txt_token?>'
	>
	<i class="icon <?=$icon?>"></i> <span
		id='js-contador-<?=$comentario->txt_token?>-<?=$feedback->txt_token?>'><?=$numFeed?$numFeed:'0'?></span>
</div>
<?php }?>