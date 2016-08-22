<?php

use yii\widgets\ActiveForm;
use app\models\EntComentariosPosts;
use yii\helpers\Html;

// Si el usuario esta logueado
if (! Yii::$app->user->isGuest) {

// avatar del usuario
echo Html::img(Yii::$app->user->identity->getImageProfile(), ['width'=>'30px']);	
$comentario = new EntComentariosPosts();

// Formulario para guardar un comentario
$form = ActiveForm::begin([
    'id' => 'js-comentario-form-'.$token, // Id de la etiqueta form
]) ?>
    <?= $form->field($comentario, 'txt_comentario')->textArea(['rows'=>3])->label(false) ?>
	
	<!-- Boton para guardar el comentario -->
	<div id="js-comentar" style='border:1px solid black;' onclick="enviarComentario('<?=$token?>');">Comentar</div>
		
<?php 
ActiveForm::end(); 
}else{

	/**
	 * @todo colocar algo para cuando el usuario no puede comentar por que no esta logueado
	 */
	
}?>
