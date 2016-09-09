<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;

	foreach ($postsMedia as $postMedia){
		echo $postMedia->txt_url . "   ";
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postMedia->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postMedia->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postMedia->id_tipo_post])->count("id_post");
	