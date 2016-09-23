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
		url:'crear-media',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

/**
 * Abrir modal para editar
 * @param token
 */
function abrirModalEditarMedia(token){
	$('#js-modal-post-editar .modal-content').html(loading);
	var url = 'editar-media?token='+token;
	$.ajax({
		url:url,
		success:function(res){
			$('#js-modal-post-editar .modal-content').html(res);
		}
	});
}

function agregarTarjetaNueva(json) {
	var template = '<div class="col s12 m6 l4" id="card_'+json.tk+'">'
			+ '<div class="card card-media" data-token="'+json.tk+'" onclick="showPostFull(\''+json.tk+'\')">'
			+ '<h3>'+json.t+'</h3>'
			+ '<p>0 Comentario(s)</p>'
			+ '<div class="card-options">'
			+ '<div class="card-options-check">'
			+ '<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />'
			+ '<label for="filled-in-box1"></label>' + '</div>'
			+ '<a id="button_'+json.tk+'" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarMedia(\''+json.tk+'\')" href="#js-modal-post-editar">'
			+'<i class="ion ion-android-more-vertical card-edit"></i>'
			+'</a>'
			+ '</div>' + '</div>' + '</div>';
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

$('body').on('beforeSubmit', '#form-media', function() {
	var form = $(this);
	// return false if form still have some validation errors
	if (form.find('.has-error').length) {
		return false;
	}
	// submit form
	$.ajax({
		url : form.attr('action'),
		type : 'post',
		 data: new FormData( this ),
		 cache: false,
	        contentType: false,
	        processData: false,
		success : function(response) {
			if (response.hasOwnProperty('status')
					&& response.status == 'success') {
				// Cierra el modal
				$('#js-modal-post').closeModal();
				// Se agrega una nueva tarjeta a la vista
				agregarTarjetaNueva(response);
				$('.modal-trigger').leanModal();
				// Reseteamos el modal
				document.getElementById("form-media").reset();
				
			} else {
				// Muestra los errores
				$('#form-media').yiiActiveForm('updateMessages',
						response, true);
			}
		}
	});
	return false;
});

$('body').on(
		'beforeSubmit',
		'#editar-media',
		function() {
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
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
						
					} else {
						// Muestra los errores
						$('#editar-media').yiiActiveForm('updateMessages',
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
