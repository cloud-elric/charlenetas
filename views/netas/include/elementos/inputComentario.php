<?php
use yii\widgets\ActiveForm;
use app\models\EntComentariosPosts;
use yii\helpers\Html;
use yii\helpers\Url;

// Si el usuario esta logueado ponemos su avatar
if (Yii::$app->user->isGuest) {
	echo Html::img ( Yii::$app->urlManager->createAbsoluteUrl ( [''] ).'webAssets/images/usr-avatar.png', [
			'width' => '30px'
	] );
} else {
	echo Html::img ( Yii::$app->user->identity->getImageProfile (), [
			'width' => '30px'
	] );

	$comentario = new EntComentariosPosts ();
}

// Formulario para guardar un comentario
$form = ActiveForm::begin ( [
		'fieldConfig' => [
				'options' => [
						'tag' => false,
				],
		],
		'id' => 'js-comentario-form-' . $token, // Id de la etiqueta form
		'options' => [
				'class' => 'add-new-comment'
		]
] );

// Si el usuario esta logueado
if (! Yii::$app->user->isGuest) {

	echo $form->field ( $comentario, 'txt_comentario' )->textArea ( [
			'rows' => 3,
			'placeholder' => 'Yo opino que...',

	] )->label ( false );

	if ($respuesta) {
		?>
<!-- Boton para guardar la respuesta -->
<a class="waves-effect waves-light btn btn-primary ladda-button animated delay-3"
	data-style="zoom-in"
	id="js-responder-<?=$token?>"
	onclick="enviarRespuesta('<?=$token?>');">Responder</a>

<?php }else{?>
<!-- Boton para guardar el comentario -->
<a class="waves-effect waves-light btn btn-primary ladda-button animated delay-3"
	data-style="zoom-in"
	id="js-responder-<?=$token?>"
	onclick="enviarComentario('<?=$token?>');">Publicar</a>
<?php }?>
<?php
} else {

	echo '<textarea name="comentario" placeholder="Yo opino que..."></textarea>
	<a class="waves-effect waves-light btn btn-primary" id="js-login"
			onclick="showModalLogin();">Responder</a>';
}
ActiveForm::end ();
?>
