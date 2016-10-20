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
		url:'crear-hoy-pense',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

var pages = 1;
//Carga mas pins de los post
function cargarMasPosts(postTotales, numeroPostMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts-hoy-pense'));
 	l.start();
	 	
	totalPostMostrados = (pages+1)*10;
	totalPost = postTotales - totalPostMostrados;
	
	var contenedor = $('#js-contenedor-tarjetas');
	var url = basePath+'adminPanel/admin/get-mas-posts-hoy-pense?page=' + pages;
	
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
				$("#js-cargar-mas-posts-hoy-pense").remove();
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
function abrirModalEditarHoyPense(token){
	$('#js-modal-post-editar .modal-content').html(loading);
	var url = 'editar-hoy-pense?token='+token;
	$.ajax({
		url:url,
		success:function(res){
			$('#js-modal-post-editar .modal-content').html(res);
		}
	});
}

function agregarTarjetaNueva(json) {
	var template = '<div class="col s12 m6 l4" id="card_'+json.tk+'">'
			+ '<div class="card card-hoy-pense" data-token="'+json.tk+'" onclick="showPostFull(\''+json.tk+'\')">'
			+'<div class="card-contexto-cont">'
			+ '<h3 class="card-title">'+json.t+'</h3>'
			+'</div>'
			+'<div class="card-contexto-status">'
			+'<p class="card-contexto-status-comen">'
			+'<i class="ion icon icon-comment"></i> <span>0</span>'
			+'</p>'
			+'</div>'
			+ '<div class="card-contexto-options">'
			+ '<a id="button_'+json.tk+'" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarHoyPense(\''+json.tk+'\')" href="#js-modal-post-editar">'
			+'<i class="ion ion-android-more-vertical card-edit"></i>'
			+'</a>'
			+ '</div>' + '</div>';
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

$('body').on('beforeSubmit', '#form-hoypense', function() {
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
				l.stop();
				// Se agrega una nueva tarjeta a la vista
				agregarTarjetaNueva(response);
				
				$('.modal-trigger').leanModal();
				// Reseteamos el modal
				document.getElementById("form-hoypense").reset();
				
				
			} else {
				// Muestra los errores
				$('#form-hoypense').yiiActiveForm('updateMessages',
						response, true);
			}
			
		}
	});
	return false;
});

$('body').on(
		'beforeSubmit',
		'#editar-hoy-pense',
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
						
						$('#card_'+response.tk+' .card-hoy-pense h3').text(response.t);
						
					} else {
						// Muestra los errores
						$('#editar-hoy-pense').yiiActiveForm('updateMessages',
								response, true);
					}
					l.stop();
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
	$('.card-hoy-pense').on('click', function(e) {
		console.log(e);
		
		if (e.target.localName == 'i') {
			return;
		}
		var token = $(this).data('token');
		showPostFull(token)
	});
	
});

