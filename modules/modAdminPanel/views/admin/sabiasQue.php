<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

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

?>

	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
	</div>

<?php 	
	$bundle = ModuleAsset::register ( Yii::$app->view );
	$bundle->js [] = 'js/charlenetas-sabiasque.js'; // dynamic file added
	
	$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );
?>