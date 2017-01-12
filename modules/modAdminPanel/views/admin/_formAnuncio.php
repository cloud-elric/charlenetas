<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $anuncio->isNewRecord?'':'active';
?>

<h4><?=$anuncio->isNewRecord?'Agregar':'Editar'?> <span>Anuncio</span></h4>

<?php
$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => $anuncio->isNewRecord?'form-anuncio':'editar-anuncio',
		//'id' => 'form-anuncio',
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
	
		<?= $form->field($anuncio, 'id_cliente')->textInput(['maxlength' => true, 'value' => $id, 'style' => 'display:none'])->label(false)?>
	
		<?= $form->field($anuncio, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>

		<?= $form->field($anuncio, 'imagen2', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
		
		<?= $form->field($anuncio, 'fch_creacion')->textInput(["class"=>"datepicker"])?>
		
		<?= $form->field($anuncio, 'fch_finalizacion')->textInput(["class"=>"datepicker"])?>

   	</div>

     <?= Html::submitButton($anuncio->isNewRecord?'crear':'editar', ['id'=>$anuncio->isNewRecord?'js-crear-submit':'js-editar-submit', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name' => 'boton-anuncio', 'data-style'=>'zoom-in'])?>

<?php ActiveForm::end();

include 'templates/formato-fecha.php';
