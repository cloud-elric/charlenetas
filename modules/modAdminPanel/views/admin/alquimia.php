<?php

use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

	foreach ($postsAlquimia as $postAlquimia){
		echo $postAlquimia->id_post . "   ";
		echo $postAlquimia->id_tipo_post . "   ";
		echo $postAlquimia->id_usuario . "   ";
		echo $postAlquimia->id_usuario_administrador . "   ";
		echo $postAlquimia->txt_titulo . "   ";
		echo $postAlquimia->txt_token . "   ";
		echo $postAlquimia->txt_descripcion . "   ";
		echo $postAlquimia->txt_imagen . "   ";
		echo $postAlquimia->txt_url . "   ";
		echo $postAlquimia->num_likes . "   ";
		echo $postAlquimia->fch_creacion . "   ";
		echo $postAlquimia->fch_publicacion . "   ";
		echo $postAlquimia->b_habilitado . "   ";
		
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->count("id_tipo_post");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_tipo_post])->count("id_post");

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added


include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
", View::POS_END );


