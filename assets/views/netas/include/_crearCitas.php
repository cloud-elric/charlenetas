
<head>
	<link rel='stylesheet' href='/fullcalendar-3.0.1/fullcalendar.css' />
	<script src='/fullcalendar-3.0.1/lib/jquery.min.js'></script>
	<script src='/fullcalendar-3.0.1/lib/moment.min.js'></script>
	<script src='/fullcalendar-3.0.1/fullcalendar.js'></script>
	
	<style>

		body {
			margin: 40px 10px;
			padding: 0;
			font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
			font-size: 14px;
		}

		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}

	</style>
</head>

<h4><span>Crear cita</span></h4>

<div id='calendar'></div>
<br/>

<script type="text/javascript">

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();

	var calendar = $('#calendar').fullCalendar({
        // put your options and callbacks here
		eventLimit: true,
        events: 'http://localhost/charlenetas/web/netas/anadir-citas',
	    
	    dayClick: function(date, jsEvent, view ){
			var view = $('#calendar').fullCalendar('getView');
			calendar.fullCalendar('gotoDate',date)
			calendar.fullCalendar('changeView','agendaDay')
			
			if(view.name == 'agendaDay'){
				var title = prompt('Title:');
				if (title) {
					start = $.fullCalendar.moment(date).format("YYYY-MM-DD HH:mm:ss");
					end = $.fullCalendar.moment(date).format("YYYY-MM-DD HH:mm:ss");
					$.ajax({
						url: 'agregar-citas',
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
		}
    });
	</script>
