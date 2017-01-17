var basePath = 'http://localhost/charlenetas/web'; 
var idUsuario = $('.js-crear-cita').data("id");
console.log(idUsuario);
var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

var calendar = $('#calendar').fullCalendar({
    // put your options and callbacks here
	defaultView: 'agendaWeek',
	eventLimit: true,
	monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
	events: basePath + '/netas/anadir-citas',
	eventRender: function(event, element, view) {
        if(event.id_usuario != idUsuario) {
            element.css('backgroundColor', '#E6E6E6');
            element.val('No disponible');
        }
	},
	    
	dayClick: function(date, jsEvent, view ){
		//var view = $('#calendar').fullCalendar('getView');
		//calendar.fullCalendar('gotoDate',date)
		//calendar.fullCalendar('changeView','agendaDay')
		
		//if(view.name == 'agendaDay'){
			$('.modal-trigger.modal-cita').trigger('click');
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
				title = "Haz hecho una cita en charlenetas";//$('#nombreCita').val()
				$.ajax({
					url: 'agregar-citas',
					data: 'title='+ title +'&start='+ start +'&end='+ end ,
					//dataType: "JSON",
					type: 'POST',
					success: function(json) {
						if(json.status == "creditosSuficientes"){
							//alert("Se guardo la cita correctamente");
							$('.lean-overlay').trigger("click");
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
							//alert("No tienes los creditos suficientes");
							$('.modal-trigger.modal-creditos').trigger('click');
						}
					},
					error: function(){
						alert("Ocurrio un error inesperado en el servidor");
					}
				});
			});
			
			$('#submitButtonCancelar').on('click', function(e){
				$('.lean-overlay').trigger("click");
			});
			
			calendar.fullCalendar('unselect');	
		//}
	} 
});