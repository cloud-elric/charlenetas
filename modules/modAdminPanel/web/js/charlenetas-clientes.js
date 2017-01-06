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

function cargarFormulario() {
	$.ajax({
		url : 'crear-cliente',
		success : function(res) {
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

var pages = 1;
//Carga mas pins de los post
function cargarMasPosts(postTotales, numeroPostMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts-alquimia'));
 	l.start();
	 	
	totalPostMostrados = (pages+1)*10;
	totalPost = postTotales - totalPostMostrados;
	
	var contenedor = $('#js-contenedor-tarjetas');
	var url = basePath+'adminPanel/admin/get-mas-posts-alquimia?page=' + pages;
	
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
				$("#js-cargar-mas-posts-alquimia").remove();
			}else{
				$("#js-cargar-mas-posts-alquimia label").text('('+totalPost+')');
			}
			
			l.stop();
		}
	});

}

//Eliminar posts
function deletePosts(){
	var del = document.getElementsByTagName('input');
	var token;
	
	$('.modal-trigger.js-eliminar-cliente').trigger('click');
	$('#Aceptar-cliente').on('click', function(e){
		e.preventDefault();
	
		$("input:checked").each(function(){
			console.log($(this).val());
			token = $(this).val();
			console.log("token"+token);
			//alert(token);
			$('#card_cliente_'+ token).remove();
			$('.lean-overlay').trigger("click");
			var ajax=$.ajax({
				url: basePath+'adminPanel/admin/deshabilitar-cliente?idCliente='+token,
				type : 'GET'
			});
		});
	});
	$('#Cancelar-cliente').on('click', function(e){
		$('.lean-overlay').trigger("click");
	});
}



function calificarPrenderEstrellas(elemento) {
	var calificacion = elemento.data('value');
	encenderEstrellas(calificacion);
	
	$('#form-alquimia #entalquimias-num_calificacion_admin').val(calificacion);
	$('#editar-alquimia #entalquimias-num_calificacion_admin').val(calificacion);
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

/**
 * Abrir modal para editar
 * @param token
 */
function abrirModalEditarCliente(token){
	$('#js-modal-post-editar .modal-content').html(loading);
	var url = 'editar-cliente?token='+token;
	$.ajax({
		url:url,
		success:function(res){
			$('#js-modal-post-editar .modal-content').html(res);
		}
	});
}

function agregarTarjetaNueva(json) {
	var template = '<div class="col s12 m6 l4" id="card_cliente_'+json.id+'">'
			+ '<div class="card card-user">'	
			+ '<div class="card-user-cont">'
			+ '<div class="row">'
			+ '<div class="col s9">'
			+ '<p class="card-user-nombre">'+json.nombre+'</p>'
			+ '<p class="card-user-email">'+json.correo+'</p>'
  			+ '<p class="card-user-email">'+json.tel+'</p>'
			+ '</div>'
			+ '</div>'
			+ '</div>'
			+ '<div class="card-contexto-options">'
			+ '<div>'
			+ '<input type="checkbox" id="delete-'+json.id+'" value="'+json.id+'"/>'
			+ '<label class="alquimia-delete-check" for="delete-'+json.id+'"></label>'
			+ '</div>'
			+ '<a id="button_'+json.id+'" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarCliente('+json.id+')" href="#js-modal-post-editar">'
			+ '<i class="ion ion-android-more-vertical card-edit"></i>'
			+ '</a>'
			+ '</div>'
			+ '</div>'
			+ '</div>';
	var contenedor = $('#js-contenedor-tarjetas');
	
	contenedor.prepend(template);
	
//	var element = document.getElementById("button_"+json.tk);
//	console.log(element);
//	element.addEventListener("click", stopEvent, false);
}

$('body').on(
		'beforeSubmit',
		'#form-cliente',
		function() {
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
				url : form.attr('action'),// url para peticion
				type : 'post', // Metodo en el que se enviara la informacion
				data : new FormData(this), // La informacion a mandar
				dataType: 'json',  // Tipo de respuesta
				cache : false, // sin cache
				contentType : false,
				processData : false,
				success : function(response) { // Cuando la peticion sea exitosamente se ejecutara la funcion
					// Si la respuesta contiene la propiedad status y es success
					console.log("success");
					if (response.status == 'success') {
						// Cierra el modal
						console.log("success");
						$('#js-modal-post').closeModal();
						// Se agrega una nueva tarjeta a la vista
						agregarTarjetaNueva(response);
						$('.modal-trigger').leanModal();
						l.stop();
						// Reseteamos el modal
						document.getElementById("form-cliente").reset();
						
					} else {
						// Muestra los errores
						$('#form-alquimia').yiiActiveForm('updateMessages',
								response, true);
					}
				},
				statusCode: {
				    404: function() {
				      //alert( "page not found" );
				    }
				  }
			});
			return false;
		});

$('body').on(
		'beforeSubmit',
		'#editar-cliente',
		function() {
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
			//$('#js-editar-submit').attr('value', 'editar');
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
					if (response.status == 'success') {
						// Cierra el modal
						$('#js-modal-post-editar').closeModal();
						
						$('#js-modal-post-editar .modal-content').html(loading);
						$('#card_cliente_'+response.id+' .card-user-nombre').text(response.nombre);
						$('#card_cliente_'+response.id+' .card-user-email').text(response.correo);
						$('#card_cliente_'+response.id+' .card-user-phone').text(response.tel);
						
					} else {
						// Muestra los errores
						$('#editar-cliente').yiiActiveForm('updateMessages',
								response, true);
					}
					l.stop();
				},
				statusCode: {
				    404: function() {
				      //alert( "page not found" );
				    }
				  }

			});
			return false;
		});


function stopEvent(ev) {
	  // this ought to keep t-daddy from getting the click.
	  ev.stopPropagation();
	 
	}

//$(document).ready(function(){
//	$('.card-user').on('click', function(e) {	
//		//console.log(e.target);
//		if (e.target.localName == 'i' || e.target.localName == 'label' || e.target.localName == 'input') {
//			e.stopPropagation();
//			return;
//		}
//		//$(e.target).hasClass('alquimia-delete-check')
//	
//		var token = $(this).data('token');
//		mostrarAnuncios(token)
//	});
//});

document.on({'click':function(e){
	if (e.target.localName == 'i' || e.target.localName == 'label' || e.target.localName == 'input') {
		e.stopPropagation();
		return;
	}
	//$(e.target).hasClass('alquimia-delete-check')

	var token = $(this).data('token');
	mostrarAnuncios(token)
	}
}, '.card-user');

function mostrarAnuncios(id){
	console.log("id-"+id);
	window.location.href = basePath+'adminPanel/admin/mostrar-anuncios?idC='+id;
}

