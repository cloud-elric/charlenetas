<?php
 	foreach($post as $p){
		echo "id: " . $p->id_post . " ";
		echo "token: " . $p->txt_token . "\n";
 	}
 	foreach($comentarios as $comentario){
 		echo $comentario->txt_comentario;
 	}
 	
	