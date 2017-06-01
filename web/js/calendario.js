//var basePath = 'http://localhost/charlenetas/web'; 
var idUsuario = $('.js-crear-cita').data("id");
console.log(idUsuario);
var date1 = new Date();
var d = date1.getDate();
var m = date1.getMonth();
var y = date1.getFullYear();

var calendar = $('#calendar').fullCalendar({
    // put your options and callbacks here
	defaultView: 'agendaDay',
	//allDaySlot: false,
    minTime: "08:00:00",
    maxTime: "21:00:00",
	slotDuration: "00:15:00",
	eventLimit: true,
	monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
	editable: false,
	eventLimit: true, 
	selectable: true,
	eventOverlap: false,
	selectHelper: true,
	unselectAuto : false,
	selectConstraint: 'disponible',
    eventConstraint: 'disponible',
	events: basePath + 'netas/anadir-citas',
	eventRender: function(event, element, view) {
       if(event.id_usuario != idUsuario && event.id_usuario != 0) {
            element.css('backgroundColor', '#6F6868');
            $(element).text('No disponible');
        }
		if(event.id_usuario == 0){
			event.overlap = true;
			event.id = 'disponible';
		}
        if(event.b_activo == 1 && event.id_usuario == idUsuario) {
			element.css('backgroundColor', '#04B404');
	    }
	},
	eventDrop: function(event, delta) {
		start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
		//alert(start);
		end = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
		m = moment(date1);
		m.add(.25,'hours').hours();
		end = moment(m).format('YYYY-MM-DD HH:mm:ss');
		//alert(end);
		$.ajax({
			url: 'actualizar-citas',
			data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
			type: 'POST',
			success: function(json) {
				//alert('OK');
				console.log("actializar");
				actualizarDatosCita(json.fecha, json.horaInicio, json.horaFin, json.restrarCred);
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
				//alert('OK');
				console.log("actializar");
				actualizarDatosCita(json.fecha, json.horaInicio, json.horaFin, json.restrarCred);
			}
		});		 
	},
	select: function(date, jsEvent, view ){
		if(date._d >= date1){
			//console.log(date._d);
			$('.modal-trigger.modal-cita').trigger('click');
			//var title = prompt('Title:');
			//if (title) {
			start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			//alert(start);
			end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			m = moment(date);
			m.add(.25,'hours').hours();
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
									id_usuario: idUsuario,
									id: json.idCita,
									overlap: true,
									editable: true
									//allDay: allDay
									},
								true // make the event 'stick'
								);
								//CAMBIAR VALOR DE INPUTS
								actualizarDatosCita(json.fecha, json.horaInicio, json.horaFin, json.restrarCred);

								$('#submitFinalizarCita').prepend("<input id='valorIdCita' type='hidden' value="+json.idCita+">");
								$("#modalFinalizar").on('click', function(){
									//$('.modal-trigger.modal-finalizar').trigger('click');
									fecha = $('#fecha').val();
									hora1 = $('#hora1').val();
									hora2 = $('#hora2').val();
									costo = $('#creditos').val();
									alertDatosCita(fecha, hora1, hora2, costo);
								});
							//location.reload(true);
						}else if(json.status == "creditosInsuficientes"){
							//alert("No tienes los creditos suficientes");
							$('.modal-trigger.modal-creditos').trigger('click');
							l.stop();
						}else{
							$('.lean-overlay').trigger("click");
							l.stop();
						}
					},
					error: function(){
						console.log("Ocurrio un error inesperado en el servidor");
						l.stop();
					}
				});
				l.stop();
			});
			
			$('#submitButtonCancelar').on('click', function(e){
				$('.lean-overlay').trigger("click");
			});	
			calendar.fullCalendar('unselect');	
		}else{
			//alert("Fecha incorrecta");
			swal("Fecha no disponoble");
		}
	}
});

function actualizarDatosCita(fecha, hora1, hora2, costo){
	$('#fecha').val(fecha);
	$('#hora1').val(hora1);
	$('#hora2').val(hora2);
	$('#creditos').val(costo);
	console.log($('#creditos').val());
}

function alertDatosCita(fecha, hora1, hora2, costo){
	swal({
		title: "Estas a punto de agendar una cita",
		text: "Revisa tus datos\nFecha: "+fecha+"\nHora: "+hora1+" a "+hora2+"\nCosto: "+costo+" creditos",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, agendar cita",
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function(){
		var idCita = $('#valorIdCita').val();
		var costo = $('#creditos').val();
		//console.log("+++"+idCita);
		$.ajax({
			url: 'habilitar-cita',
			data: 'idCita='+ idCita+"&costo="+costo,
			type: 'POST',
			success: function(resp){
				if(resp.status == "creditosSuficientes"){
					//console.log('*****SUCCESS*****');
					setTimeout(function(){
						swal("Correcto", "Tu cita ha sido agendada.", "success");
					}, 3000);
					location.reload(true);
				}else if(resp.status == "creditosInsuficientes"){
					//alert("No tienes los creditos suficientes");
					//$('.modal-trigger.modal-creditos').trigger('click');
					swal("Error", "No tienes los creditos suficientes", "error");
				}
			}
		});
	});
}

$(document).ready(function() {
    $('select').material_select();
});