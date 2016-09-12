<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($hoyPense, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($hoyPense, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($hoyPense, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($hoyPense, 'fch_publicacion')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end() ?>