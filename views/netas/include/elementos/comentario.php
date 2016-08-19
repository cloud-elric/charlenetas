<?php

// Comentario
echo 'Comentarios:' . $comentario->txt_comentario . "<br>";
?>


<?php
if (! Yii::$app->user->isGuest) {
	foreach ( $feedbacks as $feedback ) {
		?>

<div style='display: inline-block; border: 1px solid white'
	onclick='agregarFeedback("<?=$comentario->txt_token?>", "<?=$feedback->txt_token?>")'>
		<?=$feedback->txt_nombre?>
		</div>

<div style='display: inline-block; border: 1px solid white'
	id='js-contador-<?=$comentario->txt_token?>-<?=$feedback->txt_token?>'>
		<?php
		switch ($feedback->id_tipo_feedback) {
			case 1 : // like
				echo $comentario->num_likes;
				break;
			case 1 : // like
				echo $comentario->num_likes;
				break;
			case 1 : // like
				echo $comentario->num_likes;
				break;
			default :
				echo '0';
			break;
		}
		?>
		</div>
<?php }}?>

<br>
