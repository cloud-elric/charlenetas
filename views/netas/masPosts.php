
<?php
foreach ( $listaPost as $post ) {
	
	switch ($post->id_tipo_post) {
		case 1 : // Espejo
			include 'include/_espejoPin.php';
			break;
		case 2 : // Alquimia
			include 'include/_alquimiaPin.php';
			break;
		case 3 : // Verdadazos
			include 'include/_verdadazosPin.php';
			break;
		case 4 : // Hoy pense
			include 'include/_hoyPensePin.php';
			break;
		case 5 : // Media
			include 'include/_mediaPin.php';
			break;
		case 6 : // En contexto
			include 'include/_contextoPin.php';
			break;
		case 7 : // Solo por hoy
			include 'include/_soloPorHoyPin.php';
			break;
		case 8: // Sabias que
			include 'include/_sabiasQuePin.php';
		default :
			include 'include/_tarjetaPrincipal.php';
			break;
	}
}
?>
