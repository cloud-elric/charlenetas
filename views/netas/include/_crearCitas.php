<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h4><span>Crear cita</span></h4>

<?php
$form = ActiveForm::begin ([
		'options' => [
				'enctype' => 'multipart/form-data'
				]
]);
?>

<div class='row'>
	<?= $form->field($cita, 'fch_cita')->textInput(['maxlength' => true])->textarea()?>
	
	<?= $form->field($cita, 'hra_cita')->textInput(['maxlength' => true])->textarea()?>
</div>

<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php
ActiveForm::end ();
