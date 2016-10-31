
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
			$('.modal-trigger').trigger('click');
			//var title = prompt('Title:');
			//if (title) {
			start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			//alert(start);
			end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			m = moment(date);
			m.add(1,'hours').hours();
			end = moment(m).format('YYYY-MM-DD HH:mm:ss');
			//alert(end);
				
			$('#submitButton').on('click', function(e){
				e.preventDefault();
				title = $('#nombreCita').val()
				$.ajax({
					url: 'agregar-citas',
					data: 'title='+ title+'&start='+ start +'&end='+ end ,
					//dataType: "JSON",
					type: 'POST',
					success: function(json) {
						if(json.status == "creditosSuficientes"){
							alert("Se guardo la cita correctamente");
							calendar.fullCalendar('renderEvent',
									{
									title: title,
									start: start,
									end: end,
									//allDay: allDay
									},
								true // make the event 'stick'
								);
						}else {
							alert("No tienes los creditos suficientes");
						}
					},
					error: function(){
						alert("Ocurrio un error inesperado en el servidor");
					}
				});
			});
			calendar.fullCalendar('unselect');	
		}
	} 
});