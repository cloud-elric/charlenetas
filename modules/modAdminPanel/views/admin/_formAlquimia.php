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

  	 <?= $form->field($post, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($post, 'fch_publicacion')?>
  	 
  	 <?= $form->field($alquimia, 'num_calificacion_admin')?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end() ?>