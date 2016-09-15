<?php

namespace app\models;

class ConstantesWeb {
	// Tipos de post
	const POST_TYPE_ESPEJO = 1;
	const POST_TYPE_ALQUIMIA = 2;
	const POST_TYPE_VERDADAZOS = 3;
	const POST_TYPE_HOY_PENSE = 4;
	const POST_TYPE_MEDIA = 5;
	const POST_TYPE_CONTEXTO = 6;
	const POST_TYPE_SOLO_POR_HOY = 7;
	const POST_TYPE_SABIAS_QUE = 8;
	const USUARIOS_MOSTRAR = 10;
	const POSTS_MOSTRAR = 10;


	// Calificación maxima para alquimia
	const MAX_CALIFICACION_ALQUIMIA = 5;

	// Número de pines a mostrar
	const PINS_A_MOSTRAR = 20;

	// Número de comentarios a mostrar
	const COMENTARIOS_A_MOSTRAR = 5;

	// Número de estrellas que se mostraran como maximo
	const ESTRELLAS_MAXIMAS = 5;

	// Número de respuestas a mostrar
	const NUMERO_DE_RESPUESTAS = 5;

	// url para conseguir la imagen de un video de youtube
	const URL_IMG_VIDEO_YOUTUBE = 'http://img.youtube.com/vi/{idVideo}/{typeImg}.jpg';

	// Imagen de youtube por defecto
	const IMG_YOUTUBE_FULL_SIZE_THUMB = '0';

	// Imagen de youtube por defecto
	const IMG_YOUTUBE_FULL_SIZE_THUMB_2 = 'default';

	// Imagen de youtube mediana
	const IMG_YOUTUBE_MEDIUM_DEFAULT = 'mqdefault';

	// Imagen de youtube de maxima resolución
	const IMG_YOUTUBE_HIGH_RES = 'maxresdefault';

	// Imagen de youtube pequeña
	const IMG_YOUTUBE_SMALL_THUMB = '1';

	// Imagen de youtube pequeña
	const IMG_YOUTUBE_SMALL_THUMB_2 = '2';

	// Imagen de youtube pequeña
	const IMG_YOUTUBE_SMALL_THUMB_3 = '3';
}
