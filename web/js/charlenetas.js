var pages = 1;
var pagesComentarios = 0;

// Carga mas pins de los post
 function cargarMasPosts(){
	var contenedor = $('#js-contenedor-posts-tarjetas');
	var tmp = $('#js-tmp');

	tmp.load('netas/get-mas-posts?page='+pages,function(){

		if(tmp.html().trim().length>0){
			contenedor.append(tmp.html());
			pages++;
			ready();
		}else{
			alert('Sin datos para cargar');
		}

		});
}


 // Carga los comentarios de un post y los nuevos borraran los anteriores o se pondran abajo
 function cargarComentarios(token, borrarAnteriores){
	 var comentariosContenedor = $('#js-comments');
	 var urlComentarios = 'netas/cargar-comentarios?token='+token+'&page='+pagesComentarios;

	// Borra los comentarios anteriores
	 if(borrarAnteriores){
		 // Limpia el contenedor de los comentarios
		 comentariosContenedor.html('');

		 // Carga los comentarios via asincrona
		 comentariosContenedor.load(urlComentarios, function(){

			 if(comentariosContenedor.html().trim().length>0){
			 
				// Coloca un botón para cargar mas comentarios
				$('#js-comments').append('<div id="js-cargar-comentarios" onclick="cargarComentarios(\''+token+'\', false)">Cargar más</div>');

			 }

		});

	}else{

		// Carga los comentarios via asincrona

		$.ajax({
			url:urlComentarios,
			dataType:'html',
			success:function(res){
				$('#js-cargar-comentarios').before(res);
			}
			})
	}

	 pagesComentarios++;

}

 // Carga las respuestas de cada comentario
 function cargarRespuestas(token, pageRespuestas, borrarAnteriores){
	var url = 'netas/cargar-respuestas?token='+token+'&page='+pageRespuestas;

	$.ajax({
		url: url,
		dataType:'html',
		success:function(res){
		// Poner las respuestas en el contenedor adecuado

		if(borrarAnteriores){
			$('#js-respuestas-comentario-'+token).html(res);
		}else{

		}
			
		}
	
		});

}

 // Muestra un post con toda su información
 function showPostFull(token){
	 var background = $('#backScreen');
	 var content = $('#js-content');
	 var url = 'netas/cargar-post?token='+token;


	$('body').css('overflow', 'hidden');

	 background.toggle();
	 content.html('');

	 content.load(url, function(){
		 cargarComentarios(token, true);
	});
}

 // Cierra el post con toda su información
 function hidePostFull(){
	 var background = $('#backScreen');
	 background.toggle();
	 $('body').css('overflow', 'auto');
	 pagesComentarios = 0;
	 $('#js-content').html(' ');
}

 // Metodo para suscribirse a una pregunta espejo
 function suscribirseEspejo(token){
	var url = 'netas/suscripcion-espejo?token='+token;

	$.ajax({
		url:url,
		dataType:'html',
		beforeSend:function(){
			// Colocar un loading o algo asi

			$('#js-btn-suscribirse-'+token).attr('onclick', ' ');
		},
		success:function(res){

			 if(res==='subscrito'){
				// Colocar un mensaje de que usuario ya esta inscrito
				 removeSubscriptores(token);
			}else{
				addSubscriptores(token);
			}

		},
		 statusCode: {
			 403:function(){
					showModalLogin();
				},
			    404: function() {
			    	// Colocar un mensaje de que no se pudo subscribir
					removeSubscriptores(token);
			    },
			    500:function(){
			    	// Colocar un mensaje de que no se pudo subscribir
					removeSubscriptores(token);
				    }
	}});

}

	// Muestra el login en un modal
	function showModalLogin(){

alert('cargar login');

		}

 /**
 * Agrega el botón para agregar subscritores
 */
 function addSubscriptores(token){
	 var btnDesSuscribirse = '<div id="js-btn-suscribirse-'+token+'"onclick=\'desSuscribirseEspejo("'+token+'");\' style="border: 1px solid black">No me interesa la pregunta</div>';
	 var subs = $('#js-suscriptores-'+token).text();

	$('#js-suscriptores-'+token).text(parseInt(subs)+1);

	$('#js-btn-suscribirse-'+token).replaceWith(btnDesSuscribirse);
}

 /**
 * Remueve el botón para eliminar subscritores
 */
function removeSubscriptores(token){
	var btnSuscribirse = '<div id="js-btn-suscribirse-'+token+'"onclick=\'suscribirseEspejo("'+token+'");\' style="border: 1px solid black">Me interesa la pregunta</div>';
	var subs = $('#js-suscriptores-'+token).text();

	$('#js-suscriptores-'+token).text(parseInt(subs)-1);
	$('#js-btn-suscribirse-'+token).replaceWith(btnSuscribirse);
}

 /**
 * Metodo para suscribirse a una pregunta espejo
 */
 function desSuscribirseEspejo(token){
		var url = 'netas/des-suscripcion-espejo?token='+token;

		$.ajax({
			url:url,
			dataType:'html',
			beforeSend:function(){
				// Colocar un loading o algo asi

				$('#js-btn-suscribirse-'+token).attr('onclick', ' ');
			},
			success:function(res){

				if(res==='sinSubscripcion'){
					addSubscriptores(token);
				}else{
					removeSubscriptores(token);
				}

			},statusCode: {
				403:function(){
					showModalLogin();
				},
			    404: function() {
			    	// Colocar un mensaje de que no se pudo subscribir
					removeSubscriptores(token);
			    },
			    500:function(){
			    	// Colocar un mensaje de que no se pudo subscribir
					removeSubscriptores(token);
				    }
	}
		});
}

 /**
 * Guarda un comentario del usuario
 */
function enviarComentario(token){
	var data  = $('#js-comentario-form-'+token).serialize();
	var url = 'netas/comentar-post?token='+token;

	$.ajax({
		url:url,
		data:data,
		dataType:'html',
		method:'POST',
		success:function(res){
			$('#js-cargar-comentarios').before(res);
			$('#js-comentario-form-'+token+' textarea').val('');
		},
		statusCode: {
			403:function(){
				showModalLogin();
			},
		    404: function() {
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
		    },
		    500:function(){
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			    }
}
	});
}


/**
 * Guarda un comentario del usuario
 */
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
			}
		},
		statusCode: {
			403:function(){
				showModalLogin();
			},
		    404: function() {
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
		    },
		    500:function(){
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			    }
}
	});
}

// Envia respuesta
function enviarRespuesta(token){

	var data  = $('#js-comentario-form-'+token).serialize();
	var url = 'netas/responder-comentario?token='+token;

	$.ajax({
		url:url,
		data:data,
		dataType:'html',
		method:'POST',
		success:function(res){
			
			$('#js-comentario-form-'+token+' textarea').val('');
		},
		statusCode: {
			403:function(){
				showModalLogin();
			},
		    404: function() {
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
		    },
		    500:function(){
		    	// Colocar un mensaje de que no se pudo subscribir
				removeSubscriptores(token);
			    }
}
	});
}


$('.filters-toggle').on('click',function(){
  $('nav').toggleClass('mobile');
});
