<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $post->isNewRecord ? '' : 'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Espejo</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		
		'layout' => 'horizontal',
		'id' => $post->isNewRecord ? 'form-espejo' : 'editar-espejo',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label ' . $classActive 
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
<div class='row'>
		<?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])->textarea()?>
	</div>

<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php

ActiveForm::end ();

