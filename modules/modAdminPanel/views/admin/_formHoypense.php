<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h4>Agregar <span>Hoy pense</span></h4>

<?php
$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => $hoyPense->isNewRecord?'form-hoypense':'editar-hoy-pense',
		'fieldConfig' => [
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [
						'error' => 'mdl-textfield__error'
				],
				'labelOptions' => [
						'class' => 'mdl-textfield__label'
				],
				'options' => [
						'class' => 'input-field col s12 m6'
				]
		],
		'errorCssClass' => 'invalid'
] );
?>

	<div class='row'>

		<?= $form->field($hoyPense, 'txt_titulo', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])?>

		<?= $form->field($hoyPense, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>

		<?= $form->field($hoyPense, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   	
		<?= $form->field($hoyPense, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])?>

	</div>

	<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php ActiveForm::end();

include '/templates/formato-fecha.php';