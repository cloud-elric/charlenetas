<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => $media->isNewRecord?'form-media':'editar-media',
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

  	 <?= $form->field($media, 'txt_url', ['template'=>'<div class="btn"><span>URL</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
   
     <?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
