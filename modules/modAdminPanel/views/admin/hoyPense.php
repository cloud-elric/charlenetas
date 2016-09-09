<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

	foreach ($postsHoyPense as $postHoyPense){
		echo $postHoyPense->txt_descripcion . "   ";
		echo $postHoyPense->txt_imagen . "   ";
		echo $postHoyPense->txt_titulo . "   ";
		echo $postHoyPense->fch_creacion . "   ";
		echo $postHoyPense->fch_publicacion . "   ";
		
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postHoyPense->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postHoyPense->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postHoyPense->id_tipo_post])->count("id_post");
