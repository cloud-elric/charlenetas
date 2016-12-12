var pages = 1;
var pagesComentarios = 0;
var numComentarios = 0;
var comentariosShow = 0;
var comentariosRestantes = 0;
var totalPostMostrados = 0;
var totalPost = 0;

var masonryOptions = {
	itemSelector : '.pin',
	columnWidth : 250,
	gutter : 15,

};

// Carga mas pins de los post
function cargarMasPosts(postTotales, numeroPostMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts'));
	l.start();

	totalPostMostrados = (pages + 1) * 30;
	totalPost = postTotales - totalPostMostrados;

	var contenedor = $('#js-contenedor-posts-tarjetas');
	var url = basePath + 'netas/get-mas-posts?page=' + pages;

	$.ajax({
		url : url,
		success : function(res) {

			var $items = $(res);

			grid.append($items);
			grid.masonry('appended', $items);

			pages++;

			filtrarPost();

			if (totalPost <= 0) {
				$("#js-cargar-mas-posts").remove();
			} else {
				$("#js-cargar-mas-posts label").text('(' + totalPost + ')');
			}

			l.stop();
		}
	});

}

function filtrarPost() {

	$(".js-filter-tipo-post").each(function(index) {
		var elemento = $(this);
		var tipoPost = elemento.data('value');

		var opacity = 0;

		if (elemento.hasClass('filter-active')) {
			opacity = 1;
		}

		ocultarTipoPost(tipoPost, opacity)

	});
}

// Carga los comentarios de un post y los nuevos borraran los anteriores o se
// pondran abajo
function cargarComentarios(token, borrarAnteriores) {
	var comentariosContenedor = $('#js-comments');
	var urlComentarios = basePath + 'netas/cargar-comentarios?token=' + token
			+ '&page=' + pagesComentarios;

	// Carga los comentarios via asincrona

	$.ajax({
		url : urlComentarios,
		dataType : 'html',
		success : function(res) {
			$('#js-comments').append(res);
		}
	})

	calcularComentarios();

	pagesComentarios++;

}

function calcularComentarios() {

	comentariosRestantes = numComentarios - comentariosShow;

	if (comentariosRestantes < 1) {
		$('#js-cargar-comentarios').remove();
	} else {
		$('#js-cargar-comentarios span label').text(
				'(' + comentariosRestantes + ')');
	}

	numComentarios = comentariosRestantes;
}

// Carga las respuestas de cada comentario
function cargarRespuestas(token, pageRespuestas) {
	var url = basePath + 'netas/cargar-respuestas?token=' + token + '&page='
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
	var url = basePath + 'netas/cargar-post?token=' + token;

	$('body').css('overflow', 'hidden');

	background.toggle();
	content.load(url, function() {
		// content.html('');
		cargarComentarios(token, true);
	});
}


function cargarRespuestasSabiasQue(){
	$('.pin-sabias-que').each(function(index){
		var elemento = $(this);
		var token = elemento.data('post');
		var url = basePath+'netas/get-respuestas-sabias-que?token='+token;
		
		$.ajax({
			url:url,
			dataType:'JSON',
			success:function(response){
				if(response.status=='bien'){
					remplazarBoton(token, response,
					'<p class="pin-sabias-que-respuesta-succes">Respondiste correctamente</p>');
				}else if(response.status=='mal'){
					remplazarBoton(token, response,
					'<p class="pin-sabias-que-respuesta-error">Respondiste incorrectamente</p>');
				}
			}
		});
	});
}



// Muestra el post despues del logueo
function showPostAfterLogin(token) {
	var background = $('#backScreen');
	var content = $('#js-content');
	var url = basePath + 'netas/cargar-post?token=' + token;

	$('body').css('overflow', 'hidden');

	content.html('');

	if (token) {
		content.load(url, function() {
			cargarComentarios(token, true);
			$('#modal-login').closeModal();
			$('body').css('overflow', 'hidden');
		});
	} else {
		$('#modal-login').closeModal();
	}
}

// Cierra el post con toda su información
function hidePostFull() {
	var content = $('#js-content');
	content
			.html('<div style="display: flex;align-items: center;justify-content: center;height: 100%;position: relative;">'
					+ '<div class="preloader-wrapper big active">'
					+ '<div class="spinner-layer spinner-blue-only">'
					+ '<div class="circle-clipper left">'
					+ '<div class="circle"></div>'
					+ '</div><div class="gap-patch">'
					+ '<div class="circle"></div>'
					+ '</div><div class="circle-clipper right">'
					+ '<div class="circle"></div>'
					+ '</div>'
					+ '</div>'
					+ '</div>' + '</div>');
	var background = $('#backScreen');
	background.toggle();
	$('body').css('overflow', 'auto');
	pagesComentarios = 0;
	numComentarios = 0;
	comentariosShow = 0;
	comentariosRestantes = 0;
	$('#js-content').html();
}

/**
 * Carga todas notificaciones para que las vizualisen los ususarios y
 */
function cargarNotificaciones() {
	var url = basePath + 'netas/notificaciones';

	$.ajax({
		url : url,
		dataType : 'html',
		succes : function(res) {

		}
	});
}

// setInterval(cargarNotificaciones, 1000);

// Metodo para suscribirse a una pregunta espejo
function suscribirseEspejo(token) {
	var url = basePath + 'netas/suscripcion-espejo?token=' + token;

	$.ajax({
		url : url,
		dataType : 'html',
		beforeSend : function() {
			// Colocar un loading o algo asi

			$('#js-subs-like-' + token).attr('onclick', ' ');
			addSubscriptores(token);
		},
		success : function(res) {

			if (res === 'subscrito') {
				// Colocar un mensaje de que usuario ya esta inscrito
				// desSuscribirseEspejo(
				removeSubscriptores(token);
				$('#js-subs-like-' + token).attr('onclick',
						'suscribirseEspejo("' + token + '")');
			} else {
				$('#js-subs-like-' + token).attr('onclick',
						'desSuscribirseEspejo("' + token + '")');
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

	var subs = $('#js-suscriptores-' + token).text();

	$('#js-suscriptores-' + token).text(parseInt(subs) + 1);
	$('#js-subs-like-' + token).addClass('did-usr-interact');

}

/**
 * Muestra mensaje de cuenta activada
 * 
 * @param $mensaje
 */
function mensajeCuentaActivada($mensaje) {
	toastr.options = {

		"debug" : false,
		"newestOnTop" : false,
		"progressBar" : false,
		"positionClass" : "toast-top-full-width",
		"preventDuplicates" : false,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "fadeIn",
		"hideMethod" : "fadeOut"
	}

	// Display an info toast with no title
	toastr.success('<i class="material-icons">done</i>' + $mensaje)
}

function mensajeError(mensaje) {
	toastr.options = {

		"debug" : false,
		"newestOnTop" : false,
		"progressBar" : false,
		"positionClass" : "toast-top-full-width",
		"preventDuplicates" : false,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "fadeIn",
		"hideMethod" : "fadeOut"
	}

	// Display an info toast with no title
	toastr.error(mensaje)
}

function mensajeWarning(mensaje) {
	toastr.options = {

		"debug" : false,
		"newestOnTop" : false,
		"progressBar" : false,
		"positionClass" : "toast-top-full-width",
		"preventDuplicates" : false,
		"onclick" : null,
		"showDuration" : "300",
		"hideDuration" : "1000",
		"timeOut" : "5000",
		"extendedTimeOut" : "1000",
		"showEasing" : "swing",
		"hideEasing" : "linear",
		"showMethod" : "fadeIn",
		"hideMethod" : "fadeOut"
	}

	// Display an info toast with no title
	// toastr.warning(mensaje)
	toastr.warning('<i class="material-icons">report_problem</i>' + mensaje)
}

/**
 * Remueve el botón para eliminar subscritores
 */
function removeSubscriptores(token) {

	var subs = $('#js-suscriptores-' + token).text();

	$('#js-suscriptores-' + token).text(parseInt(subs) - 1);
	$('#js-subs-like-' + token).removeClass('did-usr-interact');
}

/**
 * Metodo para suscribirse a una pregunta espejo
 */
function desSuscribirseEspejo(token) {
	var url = basePath + 'netas/des-suscripcion-espejo?token=' + token;

	$.ajax({
		url : url,
		dataType : 'html',
		beforeSend : function() {
			// Colocar un loading o algo asi

			$('#js-subs-like-' + token).attr('onclick', ' ');
			removeSubscriptores(token);
		},
		success : function(res) {

			if (res === 'sinSubscripcion') {
				addSubscriptores(token);
				$('#js-subs-like-' + token).attr('onclick',
						'desSuscribirseEspejo("' + token + '")');
			} else {
				$('#js-subs-like-' + token).attr('onclick',
						'suscribirseEspejo("' + token + '")');
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
 * Guarda si al usuario le gusto o no la respuesta del admin en b_de_acuerdo de
 * la tabla ent_espuestas_espejo
 */
function agregarAcuerdo(token, feed) {
	var url = basePath + 'netas/agregar-acuerdo?token=' + token + '&feed='
			+ feed;

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
 * Guarda un comentario del usuario
 */
function enviarComentario(token) {
	var data = $('#js-comentario-form-' + token).serialize();
	var url = basePath + 'netas/comentar-post?token=' + token;
	
	var button = document.getElementById('js-responder-'+token);
	var l = Ladda.create(button);
 	l.start();
	
	$.ajax({
		url : url,
		data : data,
		dataType : 'html',
		method : 'POST',
		success : function(res) {
			$('#new-comment').after(res);
			$('#js-comentario-form-' + token + ' textarea').val('');
			l.stop();
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
	var url = basePath + 'netas/agregar-feedback?token=' + token + '&feed='
			+ feed;

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
	elemento.attr('onclick', 'revisarFeedbacks("' + token + '","' + feed + '")');

	$('#js-contador-' + token + '-' + feed).text(parseInt(contador) - 1);

	agregarFeedback(token, feed)
}

/**
 * Revisa que solo un feedback este activo 
 * @returns
 */
function revisarFeedbacks(token, feed){
	var feedbacks = $('.comment-feedbacks').children('div');
	//console.log(feedbacks);
	var no;
	for(i = 0; i < feedbacks.length; i++){
		
		if($(feedbacks[i]).hasClass('did-usr-interact')){
			//console.log("si");
			removeFeedback($(feedbacks[i]).attr('data-token'), $(feedbacks[i]).attr('data-tfb'));
		}else if($(feedbacks[i]).attr('data-token') == token && $(feedbacks[i]).attr('data-tfb') == feed){
			//console.log("no");
			addFeedback(token, feed);
		}	
	}
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

function encenderEstrellasGeneral(estrellasAEncender, token) {
	$('#js-alquimia-' + token + ' .star-wrapper:eq(1) .icon-star').each(
			function(index) {

				var estrella = $(this);
				var calificacion = estrella.data('value');

				estrella.addClass('icon-star-empty');

				if (estrellasAEncender >= calificacion) {
					estrella.removeClass('icon-star-empty');
				}
			});

	$('#js-content .star-wrapper:eq(1) .icon-star').each(function(index) {

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
	var url = basePath + 'netas/calificar-alquimia?token=' + token
			+ '&calificacion=' + calificacion;
	$.ajax({
		url : url,
		success : function(response) {
			if (response.hasOwnProperty('status')
					&& response.status == 'success') {

				encenderEstrellasGeneral(response.num_calificacion, token);
			} else {
				// Muestra los errores
				$('#form-alquimia').yiiActiveForm('updateMessages', response,
						true);
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

// Envia respuesta
function enviarRespuesta(token) {

	var data = $('#js-comentario-form-' + token).serialize();
	var url = basePath + 'netas/responder-comentario?token=' + token;
	
	var button = document.getElementById('js-responder-'+token);
	var l = Ladda.create(button);
 	l.start();

	$.ajax({
		url : url,
		data : data,
		dataType : 'html',
		method : 'POST',
		success : function(res) {

			$('#js-comentario-form-' + token + ' textarea').val('');
			$('#js-respuestas-comentario-' + token).prepend(res);
			l.stop();
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
	var url = basePath + 'netas/like-post?token=' + token;

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
	// var url = 'http://notei.com.mx/test/wwwCharlenetas/web/login';
	// var url = 'http://localhost/charlenetas/web/login';
	var url = basePath + 'login';
	var contentModal = $('#modal-login .modal-content #js-contenedor-login');

	$.ajax({
		url : url,
		success : function(res) {
			contentModal.html(res);

		}
	})
}

function loadReenviarEmailActivacion(){
	
	var url = basePath + 'peticion-activar';
	var contentModal = $('#modal-login .modal-content #js-contenedor-activar');
	$.ajax({
		url : url,
		success : function(res) {
			contentModal.html(res);
		}
	})
	
}

function loadRecuperarPass() {
	var url = basePath + 'peticion-pass';
	var contentModal = $('#modal-login .modal-content #js-contenedor-recovery');
	$.ajax({
		url : url,
		success : function(res) {
			contentModal.html(res);
		}
	})
}

/**
 * Carga Registro de usuario
 */
function loadSign() {
	// var url = 'http://notei.com.mx/test/wwwCharlenetas/web/login';
	// var url = 'http://localhost/charlenetas/web/login';
	var url = basePath + 'sign-up';
	var contentModal = $('#modal-login .modal-content #js-contenedor-crear-cuenta');

	$.ajax({
		url : url,
		success : function(res) {
			contentModal.html(res);

		}
	})
}

// Muestra el login en un modal
function showModalLogin() {
	$(".account-recovery-pass").hide();
	$(".account-singup").hide();
	$('#js-message-sign-up').hide();
	$('#js-message-recovery').hide();
	$('.account-activar').hide();
	$('.anim-account').animate({
		left : '-1%'
	}, 300, function() {
		// $(".account-login .animated").animate({ "opacity": "0" }, 0,
		// function() {
		$(".account-login .animated").animate({
			"opacity" : "0"
		}, 0);
		$(".anim-account").animate({
			"left" : "2%"
		}, 350);
		$(".account-login").show();
		$(".account-login .animated").each(function(index) {
			$(this).addClass("delay-" + (index) + " fadeInUp");
		});
	});

	$('#js-modal-lgoin-con').trigger('click');

	document.getElementById("sign-form").reset();

}

// Carga todos los tipos para que funcione la pagina una vez logueado el usuario
function cargarHabilidadesUsuario() {
	cargarFeeds();
	cargarCalificacion();
	cargarInputComentario();
	cargarInputRespuestas();
	cargarHabilidadLike();
	loadEspejoPreguntar();

	$('#js-preguntar-espejo').attr('onclick', 'agregarPregunta();');
}

function agregarPregunta() {
	$('#js-modal-espejo').trigger('click');
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
	var url = basePath + 'netas/get-calificacion-usuario?token=' + token;

	$.ajax({
		url : url,
		success : function(resp) {
			encenderEstrellas(resp);
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
	var url = basePath + 'netas/cargar-input-comentario?token='
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
	$('.js-reply-comentario').each(
			function() {
				var reply = $(this);
				var url = basePath + 'netas/cargar-input-respuesta?token='
						+ reply.data('token');

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
function cambiarClassPin(elemento, opacity) {

	if (opacity == 1) {
		elemento.addClass('pin');
		elemento.css('display', 'block');
	} else {
		elemento.removeClass('pin');
		elemento.css('display', 'none');
	}
}

/**
 * Carga el espejo para preguntar
 */
function loadEspejoPreguntar() {
	var url = basePath + 'netas/agregar-espejo';
	var contenedor = $('#modal-pregunta-espejo .modal-content');
	$.ajax({
		url : url,
		success : function(res) {
			contenedor.html(res);
		}
	});
}

/**
 * Oculta o aparece a los tipo post
 * 
 * @param idTipoPost
 */
function ocultarTipoPost(tipoPost, opacity) {

	switch (tipoPost) {
	case 1: // espejo
		var elemento = $('.pin-espejo');
		cambiarClassPin(elemento, opacity);
		break;
	case 2: // Alquimia
		var elemento = $('.pin-alquimia');
		cambiarClassPin(elemento, opacity);
		break;
	case 3: // Verdadazos
		var elemento = $('.pin-verdadazos');
		cambiarClassPin(elemento, opacity);
		break;
	case 4: // Hoy pense
		var elemento = $('.pin-hoy-pense');
		cambiarClassPin(elemento, opacity);
		break;
	case 5: // Media
		var elemento = $('.pin-media');
		cambiarClassPin(elemento, opacity);
		break;
	case 6: // Contexto
		var elemento = $('.pin-contexto');
		cambiarClassPin(elemento, opacity);
		break;
	case 7: // Solo por hoy
		var elemento = $('.pin-solo-por-hoy');
		cambiarClassPin(elemento, opacity);
		break;
	case 8: // Sabias que
		var elemento = $('.pin-sabias-que');
		cambiarClassPin(elemento, opacity);
		break;

	default:
		alert('No especificado');
		break;
	}

}

var grid;

// Click para cada item
$(document).on({
	'click' : function(e) {
		e.preventDefault();
		
			$(".account-login").hide();
			$(".account-recovery-pass .animated").animate({
				"opacity" : "0"
			}, "slow", function() {

				$(".account-recovery-pass").show();
				$(".account-recovery-pass .animated").each(function(index) {
					$(this).addClass("delay-" + (index) + " fadeInUp");
				});
			});

		

	}
}, '#js-olvide-mi-contrasenia');

//Click para cada item
$(document).on({
	'click' : function(e) {
		e.preventDefault();
		
			$(".account-login").hide();
			$(".account-activar .animated").animate({
				"opacity" : "0"
			}, "slow", function() {

				$(".account-activar").show();
				$(".account-activar .animated").each(function(index) {
					$(this).addClass("delay-" + (index) + " fadeInUp");
				});
			});

		

	}
}, '#js-enviar-activacion');

// Click para cada item
$(document).on({
	'click' : function(e) {
		e.preventDefault();

		$(".account-recovery-pass").hide();
		$(".account-login .animated").animate({
			"opacity" : "0"
		}, "slow", function() {

			$(".account-login").show();
			$(".account-login .animated").each(function(index) {
				$(this).addClass("delay-" + (index) + " fadeInUp");
			});
		});

	}
}, '#iniciar-sesion');

$(document).on({
	'click' : function(e) {
		e.preventDefault();

		$(".account-activar").hide();
		$(".account-login .animated").animate({
			"opacity" : "0"
		}, "slow", function() {

			$(".account-login").show();
			$(".account-login .animated").each(function(index) {
				$(this).addClass("delay-" + (index) + " fadeInUp");
			});
		});

	}
}, '#iniciar-sesion-activar');

// Modal
var modal = document.getElementById('modal-tutoriales');
var modalOpen = document.getElementById("modal-tutoriales-open");
var modalClose = document.getElementById("modal-tutoriales-close");

$(document).ready(function() {

	$('.modal-content .wrap').on('click', function(e) {
		console.log(e.target.className);
		if (e.target.className == 'section') {
			e.preventDefault();
			$('.lean-overlay').trigger('click');

		}

	});

	$('.pin-solo-por-hoy').on('click', function(e) {
		console.log(e.target.localName);
		if (e.target.localName == 'a') {
			e.stopPropagation();
			return;
		}
		// var token = $(this).data('token');
		// showPostFull(token)
	});

	$("#js-ingresar-cerrar-sesion").on("click", function(e) {
		e.preventDefault();
	});

	grid = $('.grid').masonry(masonryOptions);

	setInterval(function() {
		grid.masonry('reloadItems');
		grid.masonry('layout');
	}, 500);

	$('#js-login').on('click', function(e) {
		e.preventDefault();
	});

	// $('.btn').on('click', function(e) {
	// e.preventDefault();
	// });

	$('#backScreen').on('click', function(e) {
		if (e.target !== this) {
			return;
		}

		hidePostFull();
	});

	$('.modal-trigger').leanModal({
		complete : function() {
			// $('body').css('overflow', 'hidden');
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

	});
	grid.on('layoutComplete', function(event, laidOutItems) {

	});

	// 
	// 
	// 

	/**
	 * Modal
	 */
	// Open Modal
	$(modalOpen).on("click", function(){
		modal.style.display = "flex";
	});
	// Close Modal
	$(modalClose).on("click", function(){
		modal.style.display = "none";
	});


	$('.owl-carousel-tutoriales').owlCarousel({
		center: true,
		margin: 0,
		loop: true,
		nav: true,
		items: 1,
		responsive:{
			0:{
				touchDrag: true,
				mouseDrag: true
			},
			600:{
				touchDrag: false,
				mouseDrag: false
			},
			1000:{
				touchDrag: false,
				mouseDrag: false
			}
		}
	});


}); // end - READY
// Close Modal de Tutoriales
window.onclick = function(event) {
	// Modal - Close
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
// Close Modal de Tutoriales
$(window).bind("click touchstart", function(){
	// Modal - Close
	if (event.target == modal) {
		modal.style.display = "none";
	}
});

function validarRespuesta(element) {

	var valor = element.val();
	var token = element.data("token");
	var url = basePath + 'netas/validar-respuesta?respuesta=' + valor
			+ '&token=' + token;

	$
			.ajax({
				url : url,
				dataType : 'json',
				success : function(resp) {
					if (resp.status == "noLogin") {
						showModalLogin();
					} else if (resp.status == "success") {
						mensajeCuentaActivada('Respuesta correcta');
						remplazarBoton(token, resp,
								'<p class="pin-sabias-que-respuesta-succes">Respondiste correctamente</p>');
					} else if (resp.status == "respondido") {
						mensajeCuentaActivada('Ya contestaste esta pregunta');
						remplazarBoton(token, resp,
								'<p class="pin-sabias-que-respuesta-succes">Ya contestaste esta pregunta</p>');
					} else {
						mensajeWarning('Respuesta incorrecta');
						remplazarBoton(token, resp,
								'<p class="pin-sabias-que-respuesta-error">Respondiste incorrectamente</p>');
					}
				},
				statusCode : {
					403 : function() {
						showModalLogin();
					},
					404 : function() {

					},
					500 : function() {

					}
				},
				error : function() {
					element.prop("checked", false);
				}

			});
}

function remplazarBoton(token, resp, text) {
	var nota = '<div class="pin-link">'
			+ '<a class="waves-effect waves-light btn btn-secondary" href="'
			+ resp.txt_url + '" target="_blank">Ver nota</a>' + '</div>';
	$('#js-sabias-que-pin-' + token + ' .pin-content-wrapper').append(nota);
	$('#js-sabias-que-pin-' + token + ' .switch.pin-content-wrapper-switch')
			.remove();

	$('#js-sabias-que-pin-' + token).append(text);
}

function cargarCerrarSesion() {
	var cerrarSesion = '<a id="js-ingresar-cerrar-sesion" href="' + basePath
			+ 'site/logout">Cerrar sesión</a>';
	$("#js-ingresar-cerrar-sesion").replaceWith(cerrarSesion);
}

$('.filters-toggle').on('click', function() {
	$('nav').toggleClass('mobile');
});

function compartirFacebook(token) {

	var image = $('.full-pin-body-content-img img').attr('src');
	var description = $(".full-pin-body-content-text h3").text()
			+ $(".full-pin-body-content-text p").text();
	var title = $('.full-pin-header h2').text();
	console.log(image);
	FB.ui({
		method : 'feed',
		name : title,
		link : basePath + 'netas/index?token=' + token,
		picture : basePathFace + image,
		caption : 'Charlenetas',
		description : description

	}, function(response) {
		if (response && response.post_id) {
		} else {
		}
	});
}

$('.anim-account-close').on('click', function() {
	$('.lean-overlay').trigger('click');
});


function cargarFuncionalidadRespuestas(){
	$('.js-respuesta-check').each(function(index){
		$(this).attr('onclick','validarRespuesta($(this));')
	});
	
}
/**
 * Copiar 
 */
function copiarClipboard(){
	console.log("dentro de la funcion");
	var clipboard = new Clipboard('#copy-button');

	clipboard.on('success', function(e) {
		mensajeCuentaActivada("Enlace copiado");
		console.info('Action:', e.action);
	    console.info('Text:', e.text);
	    console.info('Trigger:', e.trigger);

	    e.clearSelection();
	    clipboard.destroy();
	});

//	clipboard.on('error', function(e) {
//	    console.error('Action:', e.action);
//	    console.error('Trigger:', e.trigger);
//	});
}

function deshabilitarBotonSabias(elemento){
	
	
	
	showModalLogin();
	
	elemento.prop('checked', false);
}


!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

