<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

	foreach ($postsSoloPorHoy as $postSoloPorHoy){
		echo $postSoloPorHoy->txt_descripcion . "   ";
		echo $postSoloPorHoy->txt_imagen . "   ";
		echo $postSoloPorHoy->entSoloPorHoys->num_articulo . "   ";
		echo $postSoloPorHoy->txt_url . "   ";
		echo $postSoloPorHoy->fch_creacion . "   ";
		echo $postSoloPorHoy->fch_publicacion . "   ";
		echo"</br>";
		echo"</br>";
	}
	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postSoloPorHoy->id_tipo_post])->count("id_tipo_post" . "   ");
	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postSoloPorHoy->id_tipo_post])->sum("num_likes");
	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postSoloPorHoy->id_tipo_post])->count("id_post");
	
	$bundle = ModuleAsset::register ( Yii::$app->view );
	$bundle->js [] = 'js/charlenetas-soloporhoy.js'; // dynamic file added
	
	
	include 'templates/modalPost.php';
	
	$this->registerJs ( "
		cargarFormulario();
    ", View::POS_END );