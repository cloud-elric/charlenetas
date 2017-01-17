$(document).ready(function(){
	$('.modal-trigger').leanModal();	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar').fullCalendar({
		
		//defaultView: 'agendaWeek',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
		editable: true,
		eventLimit: true, 
		events: basePath + '/adminPanel/calendario/anadir-citas',
		selectable: true,
		selectHelper: true,
		eventDrop: function(event, delta) {
			start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			//alert(start);
			end = $.fullCalendar.moment(event.start).format('YYYY-MM-DD HH:mm:ss');
			m = moment(date);
			m.add(1,'hours').hours();
			end = moment(m).format('YYYY-MM-DD HH:mm:ss');
			//alert(end);
			$.ajax({
				url: 'actualizar-citas',
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
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
				data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
				type: 'POST',
				success: function(json) {
					//alert('OK');
				}
			});		 
		},
		
		dayClick: function(date, jsEvent, view ){
			var view = $('#calendar').fullCalendar('getView');
			calendar.fullCalendar('gotoDate',date)
			calendar.fullCalendar('changeView','agendaDay')
			
			if(view.name == 'agendaDay'){
				//$('.modal-trigger').leanModal();
				$('.modal-trigger.js-crear').trigger('click');
				//var title = prompt("Evento:");
				//if (title) {
				start = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
				end = $.fullCalendar.moment(date).format('YYYY-MM-DD HH:mm:ss');
				m = moment(date);
				m.add(1,'hours').hours();
				end = moment(m).format('YYYY-MM-DD HH:mm:ss');
				
				$('#submitButton').on('click', function(e){
					e.preventDefault();
					title = $('#nombreCita').val()
					$.ajax({
						url: 'agregar-citas',
						data: 'title='+ title+'&start='+ start +'&end='+ end ,
						type: 'POST',
						success: function(json) {
							//alert('OK');
							$('.lean-overlay').trigger("click");
							calendar.fullCalendar('renderEvent',
							{
								title: title,
								start: start,
								end: end,
							},
							true
							);
						}
					});
				});
				calendar.fullCalendar('unselect');	
			}
		},
		eventRender: function(event, element) {
	    	element.append( "<span class='closeon'>X</span>" );
	    	element.find('.closeon').click(function(calEvent, jsEvent, view) {
	    		console.log("Eliminar");
	    		$('.modal-trigger.js-eliminar').trigger('click');
	    		$('#Aceptar').on('click', function(e){
	    			e.preventDefault();
	    			$.ajax({
	    				url: 'eliminar-citas',
	    				data: 'id=' + event.id,
	    				type: "POST",
	    				success: function () {
	    					$('.lean-overlay').trigger("click");
	    					calendar.fullCalendar('removeEvents',event.id);
	    					//alert("Acaba de eliminar la cita del calendario");	    
	    				}
	    			});
	    		});
	    		$('#Cancelar').on('click', function(e){
	    			$('.lean-overlay').trigger("click");
	    		});
	    	});
		}
	});
});
