function cargarFormulario() {
	$.ajax({
		url : 'crear-alquimia',
		success : function(res) {
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

function calificarPrenderEstrellas(elemento) {
	var calificacion = elemento.data('value');
	encenderEstrellas(calificacion);
	$('#entalquimias-num_calificacion_admin').val(calificacion);
}

// Encendemos las estrellas necesarias
function encenderEstrellas(estrellasAEncender) {
	$('.star-clickeble').each(function(index) {

		var estrella = $(this);
		var calificacion = estrella.data('value');

		estrella.addClass('icon-star-empty');

		if (estrellasAEncender >= calificacion) {
			estrella.removeClass('icon-star-empty');
		}
	});

}

function agregarTarjetaNueva(json) {
	var template = '<div class="col s12 m6 l4" data-token="{token}">'
			+ '<div class="card card-alquimia" onclick="showPostFull(\'{token}\')">'
			+ '<h3>{titulo}</h3>'
			+ '<p>0 Comentario(s)</p>'
			+ '<div class="card-options">'
			+ '<div class="card-options-check">'
			+ '<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />'
			+ '<label for="filled-in-box1"></label>' + '</div>'
			+ '<i class="ion ion-android-more-vertical card-edit"></i>'
			+ '</div>' + '</div>' + '</div>';
	var contenedor = $('#js-contenedor-tarjetas');
	var tarjeta = template.replace('{titulo}', json.t);
	tarjeta = tarjeta.replace('{token}', json.tk);
	contenedor.prepend(tarjeta);
}

$('body').on(
		'beforeSubmit',
		'#form-alquimia',
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
						$('#js-modal-post').closeModal();
						// Se agrega una nueva tarjeta a la vista
						agregarTarjetaNueva(response);
						// Reseteamos el modal
						document.getElementById("form-alquimia").reset();
						
						encenderEstrellas(0);
					} else {
						// Muestra los errores
						$('#form-alquimia').yiiActiveForm('updateMessages',
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