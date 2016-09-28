<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $respuesta->isNewRecord?'':'active';
?>

<h4>Agregar <span>Espejo</span></h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
 		
		'layout' => 'horizontal',
		'id' => 'form-respuesta-espejo',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label '.$classActive 
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
	<div class='row'>

		<?= $form->field($respuesta, 'txt_respuesta')->textarea(['class'=>'materialize-textarea'])?>
		<?= $form->field($respuesta, 'fch_publicacion_respuesta')->textInput(["class"=>"datepicker", "style"=>"margin-top: 35px;"])?>

	</div>

	<?= Html::submitButton('Responder <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php

ActiveForm::end ();

include 'templates/formato-fecha.php';
