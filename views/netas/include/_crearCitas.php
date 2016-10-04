<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<head>
	<link rel='stylesheet' href='/fullcalendar-3.0.1/fullcalendar.css' />
	<script src='/fullcalendar-3.0.1/lib/jquery.min.js'></script>
	<script src='/fullcalendar-3.0.1/lib/moment.min.js'></script>
	<script src='/fullcalendar-3.0.1/fullcalendar.js'></script>
</head>

<h4><span>Crear cita</span></h4>

<?php
$form = ActiveForm::begin ([
		'options' => [
				'enctype' => 'multipart/form-data'
				]
]);
?>

<div class='row'>
	<?= $form->field($cita, 'fch_cita')->textInput(['maxlength' => true])->textArea(['rows'=>'1'])?>
	
	<?= $form->field($cita, 'hra_cita')->textInput(['maxlength' => true])->textarea(['rows'=>'1'])?>
</div>

<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php
ActiveForm::end ();
?>

<div id='calendar'></div>
<br/>

<script type="text/javascript">
	$('#calendar').fullCalendar({
        // put your options and callbacks here
        //events: {
        //    url: 'http://localhost/charlenetas/web/netas/anadir-citas',
        //    type: 'POST', // Send post data
        //    error: function() {
        //        alert('There was an error while fetching events.');
        //    }
        //}
    });
	</script>
