<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($media, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($media, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($media, 'txt_url')->fileInput()?>
  	 
  	 <?= $form->field($media, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
