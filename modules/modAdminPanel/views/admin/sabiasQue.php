<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

	foreach ($postsSabiasQue as $postSabiasQue){
		echo $postSabiasQue->txt_descripcion . "   ";
		echo $postSabiasQue->txt_imagen . "   ";
		if($postSabiasQue->entSabiasQue->b_verdadero == 1)
			echo "SI" . "   ";
		else 
			echo "NO" . "   ";
		echo $postSabiasQue->txt_url . "   ";
		echo $postSabiasQue->fch_creacion . "   ";
		echo $postSabiasQue->fch_publicacion . "   ";
		echo"</br>";
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postSabiasQue->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postSabiasQue->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postSabiasQue->id_tipo_post])->count("id_post");
