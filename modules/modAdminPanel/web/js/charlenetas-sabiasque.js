var loading = '<div class="loader-center">'+
					'<div class="preloader-wrapper big active">'+
					'<div class="spinner-layer spinner-blue-only">'+
							'<div class="circle-clipper left">'+
								'<div class="circle"></div>'+
							'</div>'+
							'<div class="gap-patch">'+
								'<div class="circle"></div>'+
							'</div>'+
							'<div class="circle-clipper right">'+
								'<div class="circle"></div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';

function cargarFormulario(){
	$.ajax({
		url:'crear-sabias-que',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

/**
 * Abrir modal para editar
 * @param token
 */
function abrirModalEditarSabiasQue(token){
	$('#js-modal-post-editar .modal-content').html(loading);
	var url = 'editar-sabias-que?token='+token;
	$.ajax({
		url:url,
		success:function(res){
			$('#js-modal-post-editar .modal-content').html(res);
		}
	});
}

function agregarTarjetaNueva(json) {
	var template = '<div class="col s12 m6 l4" id="card_'+json.tk+'">'
			+ '<div class="card card-sabias-que" data-token="'+json.tk+'">'
			+'<div class="card-contexto-cont">'
			+ '<p class="card-desc">'+json.t+'</p>'
			+ '</div>'
			
			+ '<div class="card-contexto-options">'
			+ '<a id="button_'+json.tk+'" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSabiasQue(\''+json.tk+'\')" href="#js-modal-post-editar">'
			+'<i class="ion ion-android-more-vertical card-edit"></i>'
			+'</a>'
			+ '</div>'  + '</div>';
	var contenedor = $('#js-contenedor-tarjetas');
	
	contenedor.prepend(template);
	
	var element = document.getElementById("button_"+json.tk);
	console.log(element);
	element.addEventListener("click", stopEvent, false);
}

function stopEvent(ev) {
	  // this ought to keep t-daddy from getting the click.
	  ev.stopPropagation();
	 
	}

$('body').on('beforeSubmit', '#form-sabiasque', function() {
	var form = $(this);
	// return false if form still have some validation errors
	if (form.find('.has-error').length) {
		return false;
	}
	var button = document.getElementById('js-crear-submit');
	var l = Ladda.create(button);
 	l.start();
	// submit form
	$.ajax({
		url : form.attr('action'),
		type : 'post',
		 data: new FormData( this ),
		 cache: false,
	        contentType: false,
	        processData: false,
		success : function(response) {
			// Si la respuesta contiene la propiedad status y es success
			if (response.hasOwnProperty('status')
					&& response.status == 'success') {
				// Cierra el modal
				$('#js-modal-post').closeModal();
				// Se agrega una nueva tarjeta a la vista
				agregarTarjetaNueva(response);
				l.stop();
				$('.modal-trigger').leanModal();
				// Reseteamos el modal
				document.getElementById("form-sabiasque").reset();
				
				
			} else {
				// Muestra los errores
				$('#form-sabiasque').yiiActiveForm('updateMessages',
						response, true);
			}
		}
	});
	return false;
});

$('body').on(
		'beforeSubmit',
		'#editar-sabias-que',
		function() {
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
			var button = document.getElementById('js-editar-submit');
			var l = Ladda.create(button);
		 	l.start();
			// submit form
			$.ajax({
				url : form.attr('action'),// url para peticion
				type : 'post', // Metodo en el que se enviara la informacion
				data : new FormData(this), // La informacion a mandar
				dataType: 'json',  // Tipo de respuesta
				cache : false, // sin cache
				contentType : false,
				processData : false,
				success : function(response) { // Cuando la peticion sea exitosamente se ejecutara la funcion
					// Si la respuesta contiene la propiedad status y es success
					if (response.hasOwnProperty('status')
							&& response.status == 'success') {
						// Cierra el modal
						$('#js-modal-post-editar').closeModal();
						
						$('#js-modal-post-editar .modal-content').html(loading);
						
						$('#card_'+response.tk+' .card-desc').text(response.t);
						
					} else {
						// Muestra los errores
						$('#editar-sabias-que').yiiActiveForm('updateMessages',
								response, true);
					}
				},
				statusCode: {
				    404: function() {
				      alert( "page not found" );
				    }
				  }

			});
			return false;
		});

$(document).ready(function(){
	$('.card-sabias-que').on('click', function(e) {
		console.log(e);
		
		if (e.target.localName == 'i') {
			return;
		}
		var token = $(this).data('token');
		showPostFull(token)
	});
	
	
});
