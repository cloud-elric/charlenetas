<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $media->isNewRecord?'':'active';
?>

<h4><?=$media->isNewRecord?'Agregar':'Editar'?> <span>Media</span></h4>

<?php
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
						'class' => 'mdl-textfield__label '.$classActive 
				],
				'options' => [
						'class' => 'input-field col s12'
				]
		],
		'errorCssClass' => 'invalid'
] );
?>
	
	<div class='row'>

		<?= $form->field($media, 'txt_url', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true, 'onchange'=>'cargarImagenes($(this));'])?>
		
		<?= $form->field($media, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		
		<?= $form->field($media, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
		<!-- <div id="js-contenedor-imagenes"></div> -->

   	</div>

     <?= Html::submitButton($media->isNewRecord?'crear':'edtar', ['id'=>$media->isNewRecord?'js-crear-submit':'js-editar-submit', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name' => 'boton-media', 'data-style'=>'zoom-in'])?>

<?php ActiveForm::end();

include 'templates/formato-fecha.php';
