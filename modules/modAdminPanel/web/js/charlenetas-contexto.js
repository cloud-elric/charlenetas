function cargarFormulario(){
	$.ajax({
		url:'crear-contexto',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}


$('body').on(
		'beforeSubmit',
		'#form-contexto',
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
						//agregarTarjetaNueva(response);
						$('.modal-trigger').leanModal();
						// Reseteamos el modal
						document.getElementById("form-contexto").reset();
						
						
					} else {
						// Muestra los errores
						$('#form-contexto').yiiActiveForm('updateMessages',
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