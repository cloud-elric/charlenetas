<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($verdadazo, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($verdadazo, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($verdadazo, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($verdadazo, 'fch_publicacion')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end() ?>