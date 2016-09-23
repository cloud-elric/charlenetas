<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h4>Agregar <span>Media</span></h4>

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
						'class' => 'mdl-textfield__label'
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
		<div id="js-contenedor-imagenes"></div>

   	</div>

     <?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>
       
<?php ActiveForm::end();

include '/templates/formato-fecha.php';
