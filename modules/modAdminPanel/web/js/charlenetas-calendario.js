
var date1 = new Date();
var d = date1.getDate();
var m = date1.getMonth();
var y = date1.getFullYear();
var idUsuario = $('.js-calendario').data('id');
	
var calendar = $('#calendar').fullCalendar({
		header: {
			left: 'title',
			center: '',
			right: ''
		},
		minTime: "08:00:00",
    	maxTime: "21:00:00",
		slotDuration: "00:15:00",
		allDaySlot: false,
		defaultView: 'agendaWeek',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
		editable: true,
		eventLimit: true, 
		events: basePath + '/adminPanel/calendario/anadir-citas',
		selectable: true,
		eventOverlap: false,
		selectHelper: true,
		eventRender: function(event, element, view) {
			if(event.id_usuario != 0 && event.id != "disponible"){
				element.css('backgroundColor', '#6F6868');
				$(element).text('No disponible');
				event.overlap = false;
				event.editable = false;
			}
		},
		eventDrop: function(event, delta) {
			start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			//alert(start);
			end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD HH:mm:ss');
			//m = moment(date);
			//m.add(.25,'hours').hours();
			//end = moment(m).format('YYYY-MM-DD HH:mm:ss');
			//alert(end);
			$.ajax({
				url: 'actualizar-citas',
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id_cita ,
				type: 'POST',
				success: function(json) {
					//alert('OK');
				}
			});
		},
		eventResize: function(event, delta) {
			start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD HH:mm:ss');
			$.ajax({
				url: 'actualizar-citas',
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id_cita ,
				type: 'POST',
				success: function(json) {
					//alert('OK');
				}
			});		 
		},
		eventClick:  function(event, jsEvent, view){
			//set the values and open the modal
			if(event.id_usuario != 0){
				$.ajax({
					url: 'datos-usuarios',
					data: 'idUser='+ event.id_usuario+'&idCita='+event.id_cita,
					type: 'POST',
					success: function(resp){
						swal(resp.userNombre+" "+resp.userAp+"\n"+resp.userEmail, "Realizo una cita en: \nFecha: "+
						resp.fecha+"\nInicio: "+resp.horaInicio+"\nFin: "+resp.horaFin);
					}
				});
			}
		},
		dayClick: function(date, jsEvent, view ){
//			var view = $('#calendar').fullCalendar('getView');
//			calendar.fullCalendar('gotoDate',date)
//			calendar.fullCalendar('changeView','agendaDay')	
			/*start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
			m = moment(date);
			m.add(.25,'hours').hours();
			end = moment(m).format('YYYY-MM-DD HH:mm:ss');*/
			//calendar.fullCalendar('renderEvent', { title: '', start: start, end:end, allDay: false }, true );

			//if(view.name == 'agendaDay'){

//			
			if(date._d >= date1){

				//$('.modal-trigger').leanModal();
				//$('.modal-trigger.js-crear').trigger('click');
				//var title = prompt("Evento:");
				//if (title) {
				start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
				end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
				m = moment(date);
				m.add(.25,'hours').hours();
				end = moment(m).format('YYYY-MM-DD HH:mm:ss');
				
				//$('#submitButton').on('click', function(e){
				//	e.preventDefault();
					//title = $('#nombreCita').val()
					title = "Disponible"
					$.ajax({
						url: 'agregar-citas',
						data: 'title='+ title+'&start='+ start +'&end='+ end ,
						type: 'POST',
						success: function(json) {
							//alert('OK');
							//$('.lean-overlay').trigger("click");
							calendar.fullCalendar('renderEvent',
							{
								//title: title,
								id_cita: json.idCita,
								id_usuario: json.idUser,
								title: title,
								start: start,
								end: end,
								overlap: true,
								editable: true,
							},
							true
							);

							$("#modalFinalizar").on('click', function(){
								//$('.modal-trigger.modal-finalizar').trigger('click');
								//alertDatosCita(fecha, hora1, hora2, costo);
							});
						}
					});
				//});
				calendar.fullCalendar('unselect');	
			}else{
				swal("Fecha no disponoble");
			}
		},
		
	});

function alertDatosCita(fecha, hora1, hora2, costo){
	swal({
		title: "Estas segura de ese horario",
		text: "Rivisa bien los datos",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, agendar horario",
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function(){
		//console.log("+++"+idCita);
		$.ajax({
			url: 'habilitar-cita',
			data: 'idCita='+ idCita+"&costo="+costo,
			type: 'POST',
			success: function(resp){
				swal("Correcto", "Tu cita ha sido agendada.", "success");
				location.reload(true);
			}
		});
	});
}

$(document).ready(function(){
	$('.modal-trigger').leanModal();	
	
});


$(document).on({
	'click' : function(e) {
		var token = $(this).data('token');
		$('.modal-trigger.js-eliminar').trigger('click');
		$('#Aceptar').on('click', function(e){
			e.preventDefault();
			$.ajax({
				url: 'eliminar-citas',
				data: 'id=' + token,
				type: "POST",
				success: function () {
					$('.lean-overlay').trigger("click");
					calendar.fullCalendar('removeEvents',token);
					//alert("Acaba de eliminar la cita del calendario");	    
				}
			});
		});
		$('#Cancelar').on('click', function(e){
			$('.lean-overlay').trigger("click");
		});
	}
}, '.closeon');