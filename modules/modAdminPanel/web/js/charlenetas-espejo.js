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


//Eliminar posts
function deletePosts(){
	var del = document.getElementsByTagName('input');
	var token;
	
	$('.modal-trigger.js-eliminar-post').trigger('click');
	$('#Aceptar-post').on('click', function(e){
		e.preventDefault();
	
		$("input:checked").each(function(){
			console.log($(this).val());
			token = $(this).val();
			console.log("token"+token);
			//alert(token);
			$('#card_'+ token).remove();
			$('.lean-overlay').trigger("click");
			var ajax=$.ajax({
				url: basePath+'adminPanel/admin/deshabilitar-post?tokenPost='+token,
				type : 'GET'
			});
		});
	});
	$('#Cancelar-post').on('click', function(e){
		$('.lean-overlay').trigger("click");
	});
}

var pages = 1;
var totalPostMostrados = 0;
var totalPost = 0;

//Carga mas pins de los post
function cargarMasPostsSinResp(postTotales, numeroPostMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts-espejo1'));
 	l.start();
	 	
	totalPostMostrados = (pages+1)*10;
	totalPost = postTotales - totalPostMostrados;
	
	var contenedor = $('#contenedor1');
	var url = basePath+'adminPanel/admin/get-mas-posts-espejo-sin-resp?page=' + pages;
	
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
				$("#js-cargar-mas-posts-espejo1").remove();
			}else{
				$("#js-cargar-mas-posts-espejo1 label").text('('+totalPost+')');
			}
			
			l.stop();
		}
	});

}

var pages2 = 1;
var totalPostMostrados2 = 0;
var totalPost2 = 0;

//Carga mas pins de los post
function cargarMasPostsResp(postTotales2, numeroPostMostrar2) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-posts-espejo2'));
 	l.start();
	 	
	totalPostMostrados2 = (pages2+1)*10;
	totalPost2 = postTotales2 - totalPostMostrados2;
	
	var contenedor2 = $('#test2');
	var url = basePath+'adminPanel/admin/get-mas-posts-espejo-resp?page=' + pages2;
	
	$.ajax({
		url : url,
		success : function(res) {

			var $items = $(res);

			contenedor2.append($items);
			//contenedor.masonry('appended', $items);

			pages2++;

			//filtrarPost();
			
			if(totalPost2 <= 0){
				console.log(totalPost2);
				$("#js-cargar-mas-posts-espejo2").remove();
			}else{
				$("#js-cargar-mas-posts-espejo2 label").text('('+totalPost2+')');
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
			var l = Ladda.create(document.getElementById('responder_espejo'));
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
						
						$('#card_'+response.tk+' .card-espejo .respondido span').text('Espejo respondido');
						
						if(!response.e){
							$('#card_'+response.tk).clone().appendTo( "#test2" );
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

//$(document).ready(function(){
//	$('.card-espejo').on('click', function(e) {
//		console.log(e);
//		if (e.target.localName == 'i' || e.target.localName == 'label' || e.target.localName == 'input') {
//			e.stopPropagation();
//			return;
//		}
//		
//		var token = $(this).data('token');
//		showPostFull(token)
//	});	
//});

$(document).on({
	'click' : function(e){
		if (e.target.localName == 'i' || e.target.localName == 'label' || e.target.localName == 'input') {
			e.stopPropagation();
			return;
		}
		
		var token = $(this).data('token');
		showPostFull(token)
	}
}, '.card-espejo');


//$(document).on({
//	'paste' : function(e) {
//
//		e.preventDefault();
//		var text = '';
//		if (e.clipboardData || e.originalEvent.clipboardData) {
//			text = (e.originalEvent || e).clipboardData.getData('text/plain');
//		} else if (window.clipboardData) {
//			text = window.clipboardData.getData('Text');
//		}
//		if (document.queryCommandSupported('insertText')) {
//			document.execCommand('insertText', false, text);
//		} else {
//			document.execCommand('paste', false, text);
//		}
//	}
//}, '.obras-escritas-text-edit');
