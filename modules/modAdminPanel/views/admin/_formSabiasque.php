<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		'layout' => 'horizontal',
		'id' => $post->isNewRecord?'form-sabiasque':'editar-sabias-que',
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
	
	<div class="row">

		<?= $form->field($sabiasque, 'b_verdadero')->textInput(['maxlength' => true])?>

		<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		
		<?= $form->field($post, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])?>
	
	</div>

	<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php ActiveForm::end();

include '/templates/formato-fecha.php';
