<?php



// Si existen comentarios
if (count ( $comentarios ) > 0) {
	
	// Se imprimen cada comentario
	foreach ( $comentarios as $comentario ) {
		
		// Comentario
		echo $this->render ( 'include/elementos/comentario', [ 
				'comentario' => $comentario,
				'feedbacks' => $feedbacks,
				'respuesta'=>$respuestas?true:false
		] );
	}
}