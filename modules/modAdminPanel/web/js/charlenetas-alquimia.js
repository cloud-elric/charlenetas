function cargarFormulario(){
	$.ajax({
		url:'crear-alquimia',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

function calificarPrenderEstrellas(elemento){
	var calificacion = elemento.data('value');
	encenderEstrellas(calificacion);
	$('#entalquimias-num_calificacion_admin').val(calificacion);
}

//Encendemos las estrellas necesarias
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

function agregarTarjetaNueva(json){
	var template = '<div class="col s12 m6 l4">'+
						'<div class="card card-alquimia">'+
							'<h3>{titulo}</h3>'+
							'<p>0 Comentario(s)</p>'+
							'<div class="card-options">'+
								'<div class="card-options-check">'+
									'<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />'+
									'<label for="filled-in-box1"></label>'+
								'</div>'+
								'<i class="ion ion-android-more-vertical card-edit"></i>'+
							'</div>'+
						'</div>'+
					'</div>';
}

$('body').on('beforeSubmit', '#form-alquimia', function() {
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
			if(response=='success'){
				 $('#js-modal-post').closeModal();
			}else{
				$('#form-alquimia').yiiActiveForm('updateMessages',response, true);
			}
		}
	});
	return false;
});