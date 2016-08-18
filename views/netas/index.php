
<div class=container-fluid >
	<div class="pins-grid-container">
		<div class=pins-grid id="js-contenedor-posts-tarjetas">
				<?php
				include 'masPosts.php';
				?>
		</div>
	</div>
</div>





<div >
<?php
#include 'masPosts.php';
?>
</div>
<div style="border: 1px solid black" id="js-cargar-mas-posts"
	onclick="cargarMasPosts();">Cargar mas</div>

<div id="js-tmp" style="display: none;"></div>

<div id="backScreen">
	<div id="wrapper">
		<span class="closeBackScreen" onclick="hidePostFull()">X</span>
		<div id="js-content"></div>
		<div id="js-comments"></div>
	</div>
</div>

<script>
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


		}else{
			alert('Sin datos para cargar');
		}

		});
}

/**
 * Carga los comentarios de un post y los nuevos borraran los anteriores o se pondran abajo
 */

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

		 comentariosContenedor.html('');
		 comentariosContenedor.load(urlComentarios, function(){
			// Coloca un botón para cargar mas comentarios
			$('#js-comments').append('<div id="js-cargar-comentarios" onclick="cargarComentarios(\''+token+'\', false)">Cargar más</div>');
		});

	}else{

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
}

</script>
