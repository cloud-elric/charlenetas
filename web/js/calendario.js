//var basePath = 'http://localhost/charlenetas/web'; 
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
	events: basePath + 'netas/anadir-citas',
	eventRender: function(event, element, view) {
        if(event.id_usuario != idUsuario) {
            element.css('backgroundColor', '#6F6868');
            $(element).text('No disponible');
        }
        if(event.b_activo == 1 && event.id_usuario == idUsuario) {
			element.css('backgroundColor', '#04B404');
	    }
	},
	    
	dayClick: function(date, jsEvent, view ){
		//var view = $('#calendar').fullCalendar('getView');
		//calendar.fullCalendar('gotoDate',date)
		//calendar.fullCalendar('changeView','agendaDay')
		//console.log(valForm);
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

			var button = document.getElementById('submitButtonLlenar');
			var l = Ladda.create(button);	
			$('#submitButtonLlenar').on('click', function(e){
				l.start();
				e.preventDefault();
				title = "Haz hecho una cita en charlenetas";//$('#nombreCita').val()
				txtSexo = $('#txt_sexo select').val();
				txtGenero = $('#txt_genero select').val();
				txtReligion = $('#txt_religion select').val();
				txtEstadoCivil = $('#txt_estado_civil').val();
				txtEdad = $('#txt_edad').val();
				txtNacionalidad = $('#txt_nacionalidad').val();
				txtDomicilio = $('#txt_domicilio').val();
				txtPalabra = $('#txt_palabra').val();
				txtOcupacion = $('#txt_ocupacion').val();
				txtPregunta = $('#txt_pregunta').val();
				txtFinalPreg = $('#txt_final_pregunta').val();

				$.ajax({
					url: 'agregar-citas',
					data: 'title='+ title +'&start='+ start +'&end='+ end +
						'&txtSexo='+txtSexo +'&txtGenero='+txtGenero +'&txtReligion='+txtReligion+
						'&txtEstadoCivil='+txtEstadoCivil +'&txtEdad='+txtEdad +'&txtNacionalidad='+txtNacionalidad+
						'&txtDomicilio='+txtDomicilio +'&txtPalabra='+txtPalabra +'&txtOcupacion='+txtOcupacion+
						'&txtPregunta='+txtPregunta +'&txtFinalPreg='+txtFinalPreg,
					//dataType: "JSON",
					type: 'POST',
					success: function(json) {
						if(json.status == "creditosSuficientes"){
							//alert("Se guardo la cita correctamente");
							$('.lean-overlay').trigger("click");
							l.stop();
							calendar.fullCalendar('renderEvent',
									{
									title: title,
									start: start,
									end: end,
									id_usuario: idUsuario
									//allDay: allDay
									},
								true // make the event 'stick'
								);
							valForm = 1;
							//location.reload(true);
						}else if(json.status == "creditosInsuficientes"){
							//alert("No tienes los creditos suficientes");
							$('.modal-trigger.modal-creditos').trigger('click');
						}else{
							$('.lean-overlay').trigger("click");
							l.stop();
						}
					},
					error: function(){
						console.log("Ocurrio un error inesperado en el servidor");
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

$(document).ready(function() {
    $('select').material_select();
  });