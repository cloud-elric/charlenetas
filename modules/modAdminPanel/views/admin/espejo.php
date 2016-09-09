<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

	foreach ($postsEspejo as $postEspejo){
		echo $postEspejo->entEspejos->num_subscriptores . "   ";
		echo $postEspejo->txt_descripcion . "   ";
		echo $postEspejo->txt_imagen . "   ";
		echo $postEspejo->txt_url . "   ";
		echo $postEspejo->fch_creacion . "   ";
		echo $postEspejo->fch_publicacion . "   ";
		
		echo"</br>";
		echo"</br>";
	}
	echo "total posts= " . EntPosts::find()->where(['id_tipo_post'=>$postEspejo->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postEspejo->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postEspejo->id_tipo_post])->count("id_post");
	