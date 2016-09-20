<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		'layout' => 'horizontal',
		'id' => 'form-sabiasque',
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

    <?= $form->field($sabiasque, 'b_verdadero')->textInput(['maxlength' => true])?>
    
    <?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])?>
  	 
  	<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
  	 
    <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
