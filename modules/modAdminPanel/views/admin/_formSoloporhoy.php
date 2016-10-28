<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$classActive = $post->isNewRecord ? '' : 'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Solo por Hoy</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		
		'layout' => 'horizontal',
		'id' => $post->isNewRecord ? 'form-soloporhoy' : 'editar-solo-por-hoy',
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

<div class="row">
	<?= $form->field($soloporhoy, 'num_articulo')->textInput()?>

		<?= $form->field($post, 'txt_url')->textInput()?>
		
		<?= $form->field($post, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>

		<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		
		
		<?= $form->field($post, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
   	</div>

<?= Html::submitButton('<span class="ladda-label">Crear</span>', ['id'=>$post->isNewRecord?'js-crear-submit':'js-editar-submit', 'class'=>'btn btn-submit ladda-button', 'name' => 'boton-solo', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();

include 'templates/formato-fecha.php';
