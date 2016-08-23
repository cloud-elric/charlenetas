<?php

use yii\widgets\ActiveForm;
use app\models\EntComentariosPosts;
use yii\helpers\Html;


// Formulario para guardar un comentario
$form = ActiveForm::begin([
    'id' => 'js-comentario-form-'.$token, // Id de la etiqueta form
]);

// Si el usuario esta logueado
if (! Yii::$app->user->isGuest) {

// avatar del usuario
echo Html::img(Yii::$app->params ['modUsuarios'] ['pathImageProfile'].Yii::$app->user->identity->txt_imagen, ['width'=>'30px']);
$comentario = new EntComentariosPosts();

 ?>
    <?= $form->field($comentario, 'txt_comentario')->textArea(['rows'=>3])->label(false) ?>

	<!-- Boton para guardar el comentario -->
	<div id="js-comentar" style='border:1px solid black;' onclick="enviarComentario('<?=$token?>');">Comentar</div>

<?php

}else{

  <input>
	/**
	 * @todo colocar algo para cuando el usuario no puede comentar por que no esta logueado
	 */

} ActiveForm::end(); ?>


<!--
/**
 * @todo colocar algo para cuando el usuario no puede comentar por que no esta logueado
 */
 -->

<!-- if pintar el boton publica
publica();

else pintar pero el boton lanza a autenticar
Autenticar();


Active form tienen dos modos

modo logueado
modo no logueado

modo logueado trae
icon - txt field y boton con metodo publicar


modo no logueado trae
txt-fiedl y boton con metodo autenticar -->
