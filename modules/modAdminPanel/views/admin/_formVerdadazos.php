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

    <?= $form->field($verdadazo, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($verdadazo, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($verdadazo, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($verdadazo, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
