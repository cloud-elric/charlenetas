/**
 * Proyecto
 *
 * # author      Damián <@damian>
 * # copyright   Copyright (c) 2016, Proyecto
 *
 *
 *
 * @param {Object} e The event
 * @param {String} className The class name to check against
 * @return {Boolean}
 */

/**
 * Document Ready
 */
$(document).ready(function(){

	$('#backScreen').on('click', function(e) {
		if (e.target !== this) {
			return;
		}

		hidePostFull();
	});
	
	// Dropdown
	$(".dropdown-button").dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: true, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: false, // Displays dropdown below the button
		alignment: 'left' // Displays dropdown with edge aligned to the left of button
	});

	// Holder.run();

	// Scroll (nav)
    $('.nav').asScrollable();
    // Scroll (nav)
    $('.agenda').asScrollable();

});

$(window).load(function(){
	// alert("Load");
	$(".loader").fadeOut();
	$(".wrap").delay(3000).fadeIn();
});



/**
 * Variables
 */

var basePath = 'http://localhost/charlenetas/web/';
var pagesComentarios = 0;

//Muestra un post con toda su información
function showPostFull(token) {
	var background = $('#backScreen');
	var content = $('#js-content');
	var url = basePath+'netas/cargar-post?token=' + token;

	$('body').css('overflow', 'hidden');

	background.toggle();
	content.html('');

	content.load(url, function() {
		cargarComentarios(token, true);
	});
}

//Carga los comentarios de un post y los nuevos borraran los anteriores o se
//pondran abajo
function cargarComentarios(token, borrarAnteriores) {
	var comentariosContenedor = $('#js-comments');
	var urlComentarios = basePath+'netas/cargar-comentarios?token=' + token + '&page='
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

}


//Carga las respuestas de cada comentario
function cargarRespuestas(token, pageRespuestas) {
	var url = basePath+'netas/cargar-respuestas?token=' + token + '&page='
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

//Cierra el post con toda su información
function hidePostFull() {
	var background = $('#backScreen');
	background.toggle();
	$('body').css('overflow', 'auto');
	pagesComentarios = 0;
	$('#js-content').html();
}


//Metodo para suscribirse a una pregunta espejo
function suscribirseEspejo(token) {
	var url = basePath+'netas/suscripcion-espejo?token=' + token;

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
	var url = basePath+'netas/des-suscripcion-espejo?token=' + token;

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
	var url = basePath+'netas/comentar-post?token=' + token;

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
	var url = basePath+'netas/agregar-feedback?token=' + token + '&feed=' + feed;

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
function removeFeedback(token, feed) {
	var elemento = $("#js-feedback-" + token + "-" + feed);
	var contador = $('#js-contador-' + token + '-' + feed).text();

	elemento.removeClass('did-usr-interact');
	elemento.attr('onclick', 'addFeedback("' + token + '","' + feed + '")');

	$('#js-contador-' + token + '-' + feed).text(parseInt(contador) - 1);

	agregarFeedback(token, feed)
}

//Envia respuesta
function enviarRespuesta(token) {

	var data = $('#js-comentario-form-' + token).serialize();
	var url = basePath+'netas/responder-comentario?token=' + token;

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
	var url = basePath+'netas/like-post?token=' + token;

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