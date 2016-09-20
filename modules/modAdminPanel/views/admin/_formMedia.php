<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => 'form-media',
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

  	 <?= $form->field($media, 'txt_url')->fileInput()?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
