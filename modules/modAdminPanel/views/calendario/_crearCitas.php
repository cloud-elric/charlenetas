
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

<h4><span>Agenda</span></h4>

<div id='calendar'></div>
<br/>

<script>
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$(document).ready(function() {
		
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar').fullCalendar({
		editable: true,
		eventLimit: true, 
		events: 'http://localhost/charlenetas/web/adminPanel/calendario/anadir-citas',
		selectable: true,
		selectHelper: true,
		editable: true,
		eventDrop: function(event, delta) {
			start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			alert(start);
			end = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			m = moment(date);
			m.add(1,'hours').hours();
			end = moment(m).format('YYYY-MM-DD HH:mm:ss');
			alert(end);
			$.ajax({
				url: 'actualizar-citas',
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
				type: 'POST',
				success: function(json) {
					alert('OK');
				}
			});
		},
		eventResize: function(event, delta) {
			start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD HH:mm:ss');
			$.ajax({
				url: 'actualizar-citas',
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
				type: 'POST',
				success: function(json) {
					alert('OK');
				}
			});		 
		},
		
		dayClick: function(date, jsEvent, view ){
			var view = $('#calendar').fullCalendar('getView');
			calendar.fullCalendar('gotoDate',date)
			calendar.fullCalendar('changeView','agendaDay')
			
			if(view.name == 'agendaDay'){
				var title = prompt('Title:');
				if (title) {
					start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
					end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
					m = moment(date);
					m.add(1,'hours').hours();
					end = moment(m).format('YYYY-MM-DD HH:mm:ss');
					$.ajax({
						url: 'agregar-citas',
						data: 'title='+ title+'&start='+ start +'&end='+ end ,
						type: 'POST',
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
					true
					);
				}
				calendar.fullCalendar('unselect');	
			}
		},
		eventRender: function(event, element) {
	    	element.append( "<span class='closeon'>X</span>" );
	    	element.find('.closeon').click(function(calEvent, jsEvent, view) {
	     	  	$.ajax({
	        	   url: 'eliminar-citas',
	        	   data: 'id=' + event.id,
	   	    	   type: "POST",
	   	    	   success: function () {
	   	    			var aceptar = confirm("Quiere eliminar este evento?");
	   	    			if (aceptar == true) {
	   	    				calendar.fullCalendar('removeEvents',event.id);
	 	   			   	    alert("Acaba de eliminar la cita del calendario");
	   	    			} 
	        	   }
	        	});
	    	});
		}
	});
});
</script>

<?php //include 'templates/calendario.php'; ?>
