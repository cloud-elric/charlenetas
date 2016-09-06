var pages = 1;
var pagesComentarios = 0;

// Carga mas pins de los post
function cargarMasPosts() {
	var contenedor = $('#js-contenedor-posts-tarjetas');
	var tmp = $('#js-tmp');
	var url = 'netas/get-mas-posts?page='+pages;

	$.ajax({
		url:url,
		success:function(res){
			contenedor.append(res);
			ready();
			pages++;
		}
	});
//	tmp.load('netas/get-mas-posts?page=' + pages, function() {
//
//		if (tmp.html().trim().length > 0) {
//			contenedor.append(tmp.html());
//			pages++;
//			
//		} else {
//			alert('Sin datos para cargar');
//		}
		

	//});
}

// Carga los comentarios de un post y los nuevos borraran los anteriores o se
// pondran abajo
function cargarComentarios(token, borrarAnteriores) {
	var comentariosContenedor = $('#js-comments');
	var urlComentarios = 'netas/cargar-comentarios?token=' + token + '&page='
			+ pagesComentarios;

	// Carga los comentarios via asincrona

	$.ajax({
		url : urlComentarios,
		dataType : 'html',
		success : function(res) {
			$('#js-comments').append(res);
		}
	})

	// $('#js-comments').append('<div id="js-cargar-comentarios"
	// onclick="cargarComentarios(\''+token+'\', false)">Cargar más</div>');
	pagesComentarios++;

<<<<<<< HEAD
			 if(comentariosContenedor.html().trim().length>0){

				// Coloca un botón para cargar mas comentarios
				$('#js-comments').append('<div id="js-cargar-comentarios" onclick="cargarComentarios(\''+token+'\', false)">Cargar más</div>');
			 }
=======
}
>>>>>>> origin/probando-masonry

// Carga las respuestas de cada comentario
function cargarRespuestas(token, pageRespuestas) {
	var url = 'netas/cargar-respuestas?token=' + token + '&page='
			+ pageRespuestas;

	$.ajax({
		url : url,
		dataType : 'html',
		success : function(res) {
			// Poner las respuestas en el contenedor adecuado

			$('#js-respuestas-comentario-' + token).append(res);

		}

	});

}

/**
 * Carga las siguientes respuestas por token
 * 
 * @param element
 */
function cargarRespuestasPage(element) {
	var token = element.data('token');
	var page = $('#js-page-respuesta-' + token).val();
	var pageAdd = parseInt(page) + 1;
	$('#js-page-respuesta-' + token).val(pageAdd);

	cargarRespuestas(token, pageAdd);
}

// Muestra un post con toda su información
function showPostFull(token) {
	var background = $('#backScreen');
	var content = $('#js-content');
	var url = 'netas/cargar-post?token=' + token;

<<<<<<< HEAD
		}

		}

		});
=======
	$('body').css('overflow', 'hidden');
>>>>>>> origin/probando-masonry

	background.toggle();
	content.html('');

	content.load(url, function() {
		cargarComentarios(token, true);
	});
}

// Muestra el post despues del logueo
function showPostAfterLogin(token) {
	var background = $('#backScreen');
	var content = $('#js-content');
	var url = 'netas/cargar-post?token=' + token;

	$('body').css('overflow', 'hidden');

	content.html('');

	content.load(url, function() {
		cargarComentarios(token, true);
		$('#modal-login').closeModal();
		$('body').css('overflow', 'hidden');
	});
}

// Cierra el post con toda su información
function hidePostFull() {
	var background = $('#backScreen');
	background.toggle();
	$('body').css('overflow', 'auto');
	pagesComentarios = 0;
	$('#js-content').html();
}

// Metodo para suscribirse a una pregunta espejo
function suscribirseEspejo(token) {
	var url = 'netas/suscripcion-espejo?token=' + token;

	$.ajax({
		url : url,
		dataType : 'html',
		beforeSend : function() {
			// Colocar un loading o algo asi

			$('#js-btn-suscribirse-' + token).attr('onclick', ' ');
		},
		success : function(res) {

			if (res === 'subscrito') {
				// Colocar un mensaje de que usuario ya esta inscrito
				removeSubscriptores(token);
			} else {
				addSubscriptores(token);
			}

		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	});

}

/**
 * Agrega el botón para agregar subscritores
 */
function addSubscriptores(token) {
	var btnDesSuscribirse = '<div id="js-btn-suscribirse-'
			+ token
			+ '"onclick=\'desSuscribirseEspejo("'
			+ token
			+ '");\' style="border: 1px solid black">No me interesa la pregunta</div>';
	var subs = $('#js-suscriptores-' + token).text();

	$('#js-suscriptores-' + token).text(parseInt(subs) + 1);

	$('#js-btn-suscribirse-' + token).replaceWith(btnDesSuscribirse);
}

/**
 * Remueve el botón para eliminar subscritores
 */
function removeSubscriptores(token) {
	var btnSuscribirse = '<div id="js-btn-suscribirse-'
			+ token
			+ '"onclick=\'suscribirseEspejo("'
			+ token
			+ '");\' style="border: 1px solid black">Me interesa la pregunta</div>';
	var subs = $('#js-suscriptores-' + token).text();

	$('#js-suscriptores-' + token).text(parseInt(subs) - 1);
	$('#js-btn-suscribirse-' + token).replaceWith(btnSuscribirse);
}

/**
 * Metodo para suscribirse a una pregunta espejo
 */
function desSuscribirseEspejo(token) {
	var url = 'netas/des-suscripcion-espejo?token=' + token;

	$.ajax({
		url : url,
		dataType : 'html',
		beforeSend : function() {
			// Colocar un loading o algo asi

			$('#js-btn-suscribirse-' + token).attr('onclick', ' ');
		},
		success : function(res) {

			if (res === 'sinSubscripcion') {
				addSubscriptores(token);
			} else {
				removeSubscriptores(token);
			}

		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	});
}

/**
 * Guarda un comentario del usuario
 */
function enviarComentario(token) {
	var data = $('#js-comentario-form-' + token).serialize();
	var url = 'netas/comentar-post?token=' + token;

	$.ajax({
		url : url,
		data : data,
		dataType : 'html',
		method : 'POST',
		success : function(res) {
			$('#new-comment').after(res);
			$('#js-comentario-form-' + token + ' textarea').val('');
		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	});
}

/**
 * Guarda un comentario del usuario
 */
function agregarFeedback(token, feed) {
	var url = 'netas/agregar-feedback?token=' + token + '&feed=' + feed;

	$.ajax({
		url : url,
		dataType : 'html',
		method : 'GET',
		success : function(res) {

		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},

			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	});
}

/**
 * Agrega visualmente un feedback a un comentario
 * 
 * @param token
 */
function addFeedback(token, feed) {
	var elemento = $("#js-feedback-" + token + "-" + feed);
	var contador = $('#js-contador-' + token + '-' + feed).text();

	elemento.addClass('did-usr-interact');
	elemento.attr('onclick', 'removeFeedback("' + token + '","' + feed + '")');

	$('#js-contador-' + token + '-' + feed).text(parseInt(contador) + 1);
	agregarFeedback(token, feed);
}

/**
 * Remueve visulamente un feedback a un comentario
 * 
 * @param token
 */
<<<<<<< HEAD
function agregarFeedback(token, feed){
	var url = 'netas/agregar-feedback?token='+token+'&feed='+feed;

	$.ajax({
		url:url,
		dataType:'html',
		method:'GET',
		success:function(res){
			if(res=='exist'){

			}else{
				var contador = $('#js-contador-'+token+'-'+feed).text();
				$('#js-contador-'+token+'-'+feed).text(parseInt(contador)+1);
=======
function removeFeedback(token, feed) {
	var elemento = $("#js-feedback-" + token + "-" + feed);
	var contador = $('#js-contador-' + token + '-' + feed).text();

	elemento.removeClass('did-usr-interact');
	elemento.attr('onclick', 'addFeedback("' + token + '","' + feed + '")');

	$('#js-contador-' + token + '-' + feed).text(parseInt(contador) - 1);

	agregarFeedback(token, feed)
}

/**
 * Califica alquimia y prender las estrellas
 * 
 * @param element
 */
function calificarPrenderEstrellas(element) {
	var calificacion = element.data('value');
	var parent = element.parent('.star-wrapper');
	var token = parent.data('token');

	encenderEstrellas(calificacion);

	calificarAquimia(token, calificacion);
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
 * Califica alquimia
 */
function calificarAquimia(token, calificacion) {
	var url = 'netas/calificar-alquimia?token=' + token + '&calificacion='
			+ calificacion;
	$.ajax({
		url : url,
		success : function() {

		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
>>>>>>> origin/probando-masonry
			}
		}
	});
}

// Envia respuesta
function enviarRespuesta(token) {

	var data = $('#js-comentario-form-' + token).serialize();
	var url = 'netas/responder-comentario?token=' + token;

	$.ajax({
		url : url,
		data : data,
		dataType : 'html',
		method : 'POST',
		success : function(res) {

			$('#js-comentario-form-' + token + ' textarea').val('');
			$('#js-respuestas-comentario-' + token).prepend(res);
		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	});
}

/**
 * Pone un like a un post
 * 
 * @param token
 */
function likePost(token) {
	var url = 'netas/like-post?token=' + token;

	$.ajax({
		url : url,
		success : function(res) {

		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},

			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeLikePost(token);
			}
		}
	})

}

/**
 * Visualmente agrega la parte de aumento de like
 * 
 * @param token
 */
function addLikePost(token) {
	var elemento = $('#js-feedback-like-' + token);
	var contador = $('#js-like-' + token).text();

	elemento.addClass('did-usr-interact');
	elemento.attr('onclick', 'removeLikePost("' + token + '")');

	$('#js-like-' + token).text(parseInt(contador) + 1);

	likePost(token);
}

/**
 * Visualmente remueve el contador de likes
 * 
 * @param token
 */
function removeLikePost(token) {
	var elemento = $('#js-feedback-like-' + token);
	var contador = $('#js-like-' + token).text();

	elemento.removeClass('did-usr-interact');
	elemento.attr('onclick', 'addLikePost("' + token + '")');

	$('#js-like-' + token).text(parseInt(contador) - 1);

	likePost(token);
}

/**
 * Muestra el ladda al elemento
 * 
 * @param element
 */
function loadLada(element) {
	var l = Ladda.create(element);
	l.start();
	showModalLogin()
}

/**
 * Carga login
 */
function loadLogin() {
	var url = 'http://localhost/charlenetas/web/login';
	var contentModal = $('#modal-login .modal-content');

	$.ajax({
		url : url,
		success : function(res) {
			contentModal.html(res);

		}
	})
}

// Muestra el login en un modal
function showModalLogin() {

	$('.modal-trigger').trigger('click');

}

// Carga todos los tipos para que funcione la pagina una vez logueado el usuario
function cargarHabilidadesUsuario() {
	cargarFeeds();
	cargarCalificacion();
	cargarInputComentario();
	cargarInputRespuestas();
	cargarHabilidadLike();
}

// Carga la habilidad para los feedback
function cargarFeeds() {
	$('.js-feedback').each(function(index) {
		var token = $(this).data('token');
		var tfb = $(this).data('tfb');
		$(this).attr('onclick', 'addFeedback("' + token + '","' + tfb + '")');

	});
}

/**
 * Ilumina las estrellas de acuerdo a la que dio click
 */
function cargarCalificacion() {
	var token = $('#js-estrellas-usuario').data('token');

	$('.js-estrella-usuario .icon-star').each(function() {
		var estrella = $(this);
		estrella.attr('onclick', 'calificarPrenderEstrellas($(this))');
	});

	cargarCalificacionUsuario(token);
}

/**
 * Carga la calificacion del usuario de una alquimia a traves de una petición
 * ajax
 * 
 * @param token
 */
function cargarCalificacionUsuario(token) {
	var url = 'netas/get-calificacion-usuario?token=' + token;

	$.ajax({
<<<<<<< HEAD
		url:url,
		data:data,
		dataType:'html',
		method:'POST',
		success:function(res){

			$('#js-comentario-form-'+token+' textarea').val('');
=======
		url : url,
		success : function(resp) {
			encenderEstrellas(resp);
>>>>>>> origin/probando-masonry
		},
		statusCode : {
			403 : function() {
				showModalLogin();
			},
			404 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			},
			500 : function() {
				// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			}
		}
	})
}

/**
 * Carga la habilidad de dar like
 */
function cargarHabilidadLike() {
	$('.js-feedback-like').each(function(index) {
		var token = $(this).data('token');
		$(this).attr('onclick', 'addLikePost("' + token + '")');
	});
}

/*
 * Carga el input del comentario
 */
function cargarInputComentario() {
	var comentarioNuevo = $('#new-comment');
	var url = 'netas/cargar-input-comentario?token='
			+ comentarioNuevo.data('token');

	$.ajax({
		url : url,
		success : function(res) {
			comentarioNuevo.html(res);
			$('#modal-login').closeModal();
		}
	});

}

/**
 * Carga los input para responder
 */
function cargarInputRespuestas() {
	$('.js-reply-comentario').each(function() {
		var reply = $(this);
		var url = 'netas/cargar-input-respuesta?token=' + reply.data('token');

		$.ajax({
			url : url,
			success : function(res) {
				reply.html(res);
			}
		});
	});
}



/**
 * Cambia la clase pin a otra
 */
function cambiarClassPin(elemento, opacity){
	elemento.toggleClass('pin');
	elemento.toggle();
}

/**
 * Oculta o aparece a los tipo post
 * @param idTipoPost
 */
function ocultarTipoPost(tipoPost, opacity){
	
	switch (tipoPost) {
	case 1: // espejo
		var elemento = $('.pin-espejo');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 2: // Alquimia
		var elemento = $('.pin-alquimia');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 3: // Verdadazos
		var elemento = $('.pin-verdadazos');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 4: // Hoy pense
		var elemento = $('.pin-hoy-pense');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 5: // Media
		var elemento = $('.pin-media');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 6: // Contexto
		var elemento = $('.pin-contexto');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 7: // Solo por hoy
		var elemento = $('.pin-solo-por-hoy');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;
	case 8: // Sabias que
		var elemento = $('.pin-sabias-que');
		elemento.css('opacity', opacity);
		cambiarClassPin(elemento);
		break;

	default:
		alert('No especificado');
		break;
	}
	
}

$(document).ready(function() {
	$('#js-login').on('click', function(e) {
		e.preventDefault();
	});

	$('.btn').on('click', function(e) {
		e.preventDefault();
	});

	$('#backScreen').on('click', function(e) {
		if (e.target !== this) {
			return;
		}

		hidePostFull();
	});

	$('.modal-trigger').leanModal({

		complete : function() {
			$('body').css('overflow', 'hidden');
		} // Callback for Modal close
	});

	// oculta pines
	$('.js-filter-tipo-post').on('click', function(e) {
		e.preventDefault();
		var elemento = $(this);
		var tipoPost = elemento.data('value');
		var opacity = 1;
		
		if (elemento.hasClass('filter-active')) {
			opacity = 0;
		}

		ocultarTipoPost(tipoPost, opacity)
		elemento.toggleClass('filter-active');
		ready();
	});

});

$('body').on('beforeSubmit', '#login-form', function() {
	var form = $(this);
	// return false if form still have some validation errors
	if (form.find('.has-error').length) {
		return false;
	}
	// submit form
	$.ajax({
		url : form.attr('action'),
		type : 'post',
		data : form.serialize(),
		success : function(response) {
			if (response == 'success') {

				var token = $('#js-token-post').val();
				showPostAfterLogin(token);
				// cargarHabilidadesUsuario();

			}
		}
	});
<<<<<<< HEAD
}


$('.filters-toggle').on('click',function(){
  $('nav').toggleClass('mobile');
});
=======
	return false;
});
>>>>>>> origin/probando-masonry
