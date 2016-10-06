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

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();

	$('#calendar').fullCalendar({
        // put your options and callbacks here
        editable: true,
		eventLimit: true,
        events: 'http://localhost/charlenetas/web/netas/anadir-citas',
        selectable: true,
		selectHelper: true,

		select: function(start, end, allDay) {
			 var title = prompt('Event Title:');
			 if (title) {
			 	start = $.fullCalendar.moment(event.start).format("YYYY-MM-DD HH:mm:ss");
			 	end = $.fullCalendar.moment(event.end).format("YYYY-MM-DD HH:mm:ss");
			 	$.ajax({
			 		url: 'http://localhost/fullcalendar/add_events.php',
			 		data: 'title='+ title+'&start='+ start +'&end='+ end ,
			 		type: "POST",
			 		success: function(json) {
			 			alert('OK');
			 		}
			 	});
			 	calendar.fullCalendar('renderEvent',
			 	{
			 		title: title,
			 		start: start,
			 		end: end,
			 		allDay: allDay
			 	},
			 	true // make the event "stick"
			 	);
			 }
			 calendar.fullCalendar('unselect');
	    }
    });
	</script>
