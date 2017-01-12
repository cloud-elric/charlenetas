<?php
use app\models\EntAnuncios;
$fch_actual = date("Y-m-d 00:00:00");
$numAnunciosCliente = EntAnuncios::find()->where(['id_cliente'=>$numRand])->andWhere(['<=','fch_creacion', $fch_actual])->andWhere(['>=','fch_finalizacion', $fch_actual])->all();

$countPost = 0;
$countAnuncio = 0;

//$num = rand(1,5);
$num = 5;

foreach ( $listaPost as $post ) {
	if($countAnuncio > count($numAnunciosCliente)){
		$countAnuncio = 0;
	}

	if($num == $countPost && $countAnuncio < count($numAnunciosCliente) && count($listaAnuncios) > 0){

		include 'include/_anuncioPin.php';
		$countAnuncio++;

		//$num = rand($num+2,$num+6);
		$num += 5;
	}else{
	
		if($post->b_habilitado == 1){
			switch ($post->id_tipo_post) {
				case 1 : // Espejo
					include 'include/_espejoPin.php';
					$countPost++;
					break;
				case 2 : // Alquimia
					include 'include/_alquimiaPin.php';
					$countPost++;
					break;
				case 3 : // Verdadazos
					include 'include/_verdadazosPin.php';
					$countPost++;
					break;
				case 4 : // Hoy pense
					include 'include/_hoyPensePin.php';
					$countPost++;
					break;
				case 5 : // Media
					include 'include/_mediaPin.php';
					$countPost++;
					break;
				case 6 : // En contexto
					include 'include/_contextoPin.php';
					$countPost++;
					break;
				case 7 : // Solo por hoy
					include 'include/_soloPorHoyPin.php';
					$countPost++;
					break;
				case 8: // Sabias que
					include 'include/_sabiasQuePin.php';
					$countPost++;
				default :
					#include 'include/_tarjetaPrincipal.php';
					break;
			}
		}
	}
}
?>
