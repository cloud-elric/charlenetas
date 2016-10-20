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

$(document).ready(function(){
	$('.card-espejo').on('click', function(e) {
		console.log(e);
		
		if (e.target.className !== '') {
			return;
		}
		var token = $(this).data('token');
		showPostFull(token)
	});
	
});

var pages = 1;
var totalPostMostrados = 0;
var totalPost = 0;

//Carga mas pins de los post
function cargarMasPosts(postTotales, numeroPostMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts-espejo'));
 	l.start();
	 	
	totalPostMostrados = (pages+1)*10;
	totalPost = postTotales - totalPostMostrados;
	
	var contenedor = $('#js-contenedor-tarjetas');
	var url = basePath+'adminPanel/admin/get-mas-posts-espejo?page=' + pages;
	
	$.ajax({
		url : url,
		success : function(res) {

			var $items = $(res);

			contenedor.append($items);
			//contenedor.masonry('appended', $items);

			pages++;

			//filtrarPost();
			
			if(totalPost <= 0){
				console.log(totalPost);
				$("#js-cargar-mas-posts-espejo").remove();
			}else{
				$("#js-cargar-mas-posts label").text('('+totalPost+')');
			}
			
			l.stop();
		}
	});

}

/**
 * Abrir modal para editar
 * @param token
 */
function abrirModalResponderEspejo(token){
	$('#js-modal-post-editar .modal-content').html(loading);
	var url = 'responder-espejo?token='+token;
	$.ajax({
		url:url,
		success:function(res){
			$('#js-modal-post-editar .modal-content').html(res);
		}
	});
}

$('body').on(
		'beforeSubmit',
		'#form-respuesta-espejo',
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
						
						$('#card_'+response.tk+' .card-espejo .respondido span').text('Espejo respondido');
						
						if(!response.e){
							$('#card_'+response.tk).clone().appendTo( "#js-contenedor-tarjetas" );
							$('#card_'+response.tk).remove();
							$('.modal-trigger').leanModal();
						}
						// Cierra el modal
						$('#js-modal-post-editar').closeModal();


					} else {
						// Muestra los errores
						$('#form-respuesta-espejo').yiiActiveForm('updateMessages',
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
	$('.card-espejo').on('click', function(e) {
		console.log(e);
		
		if (e.target.localName == 'i') {
			return;
		}
		var token = $(this).data('token');
		showPostFull(token)
	});
	
	
});
