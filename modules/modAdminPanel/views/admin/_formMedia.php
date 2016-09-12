<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($media, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($media, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($media, 'txt_url')->fileInput()?>
  	 
  	 <?= $form->field($media, 'fch_publicacion')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end() ?>