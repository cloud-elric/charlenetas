<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
// 		'enableAjaxValidation' => true,
// 		'enableClientValidation' => true,
// 		'validationUrl' => 'netas/validacion-usuario',
		'layout' => 'horizontal',
		'id' => 'login-alquimia',
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
    <div class='row'>
    <?= $form->field($post, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	<?= $form->field($post, 'imagen', ['template'=>'<div class="file-field input-field col s6">{input}{error}</div>'])->fileInput()?>
  	 
  	<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
  	 
  	 <?= $form->field($alquimia, 'num_calificacion_admin')?>
   </div>
    <?= Html::submitButton('Crear')?>
       
<?php

ActiveForm::end ();

include '/templates/formato-fecha.php';

