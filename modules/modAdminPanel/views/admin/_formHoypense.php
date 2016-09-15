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

    <?= $form->field($hoyPense, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($hoyPense, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($hoyPense, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($hoyPense, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';