<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

	foreach ($postsContexto as $postContexto){
		echo $postContexto->txt_descripcion . "   ";
		echo $postContexto->txt_imagen . "   ";
		//echo $postContexto->entContextos->id_contexto_padre . "   ";
		echo $postContexto->txt_url . "   ";
		echo $postContexto->fch_creacion . "   ";
		echo $postContexto->fch_publicacion . "   ";
		
		echo"</br>";
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postContexto->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postContexto->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postContexto->id_tipo_post])->count("id_post");
	