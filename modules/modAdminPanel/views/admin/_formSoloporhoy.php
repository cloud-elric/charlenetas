<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($post, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($post, 'txt_url')->fileInput()?>
  	 
  	 <?= $form->field($post, 'fch_publicacion')?>
  	 
  	 <?= $form->field($soloporhoy, 'num_articulo')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end() ?>