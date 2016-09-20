<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => 'form-hoypense',
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

    <?= $form->field($hoyPense, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($hoyPense, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($hoyPense, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($hoyPense, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';