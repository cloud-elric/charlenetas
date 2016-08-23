<?php
use yii\helpers\Html;

// Comentario
echo Html::img ( $comentario->idUsuario->getImageProfile (), [ 
		'width' => '50px' 
] ) . $comentario->txt_comentario . "<br>";
?>

<?php
// Si solamente es un comentario
if (! $respuesta) {
	?>
<hr>
<label>Respuestas:</label>
<div style='width: 90%; margin-left: 10%' id='js-respuestas-comentario-<?=$comentario->txt_token?>'>aqui van
	las respuestas</div>
	<script>
		var page<?=$comentario->txt_token?>= 0;
		cargarRespuestas('<?=$comentario->txt_token?>', page<?=$comentario->txt_token?>, true);
	</script>
<?php
	
// Coloca el input para responder
	echo $this->render ( 'inputComentario', [ 
			'token' => $comentario->txt_token,
			'respuesta'=>true
	] );
}?>




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
