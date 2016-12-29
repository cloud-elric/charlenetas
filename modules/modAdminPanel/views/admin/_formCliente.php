<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$classActive = $post->isNewRecord?'':'active';
?>

<h4><?php /*echo $post->isNewRecord?'Agregar':'Editar'*/?> <span>Cliente</span></h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
 		
		'layout' => 'horizontal',
		'id' => 'form-cliente',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label '//.$classActive 
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
	<div class='row'>

		<?= $form->field($cliente, 'txt_nombre')->textInput(['maxlength' => true])?>
		
		<?= $form->field($cliente, 'txt_apellido')->textInput(['maxlength' => true])?>
		
		<?= $form->field($cliente, 'txt_correo')->textInput(['maxlength' => true])?>
		
		<?= $form->field($cliente, 'num_telefono')->textInput(['maxlength' => true])?>
		
	</div>

	<?= Html::submitButton('crear',['id'=>'js-crear-submit', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name'=>'boton-cliente', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();
