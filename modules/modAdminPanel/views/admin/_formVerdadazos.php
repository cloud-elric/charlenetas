<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => 'form-verdadazos',
		'fieldConfig' => [
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [
						'error' => 'mdl-textfield__error'
				],
				'labelOptions' => [
						'class' => 'mdl-textfield__label'
				],
				'options' => [
						'class' => 'input-field col s6'
				]
		],
		'errorCssClass' => 'invalid'
] );
?>

	<div class='row open'>
    
   	 <?= $form->field($verdadazo, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($verdadazo, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($verdadazo, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
  	 
   </div>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
