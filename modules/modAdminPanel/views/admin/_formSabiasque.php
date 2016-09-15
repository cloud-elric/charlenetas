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

    <?= $form->field($post, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($post, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
  	 
  	 <?= $form->field($sabiasque, 'b_verdadero')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
