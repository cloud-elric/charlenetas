<?php
// Si existen comentarios
if (count ( $comentarios ) > 0) {

	// Se imprimen cada comentario y respuestas del comentario
	foreach ( $comentarios as $comentario ) {

		// Comentario
		echo 'Comentarios:' . $comentario->txt_comentario . "<br>";

	}
	
}