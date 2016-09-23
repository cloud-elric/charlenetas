<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row">

	<?php foreach ($postsSabiasQue as $postSabiasQue){ ?>
	
		<div class="col s12 m6 l4">
			<div class="card card-sabias-que" data-token="<?=$postSabiasQue->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSabiasQue->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postSabiasQue->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div class="card-contexto-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSabiasQue('<?=$postSabiasQue->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>
<?php }?>

</div>



	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->
	<?php	
		//echo $postSabiasQue->txt_descripcion . "   ";
		//echo $postSabiasQue->txt_imagen . "   ";
		//if($postSabiasQue->entSabiasQue->b_verdadero == 1)
//			//echo "SI" . "   ";
	//	else 
		//	echo "NO" . "   ";
//		echo $postSabiasQue->txt_url . "   ";
	//	echo $postSabiasQue->fch_creacion . "   ";
		//echo $postSabiasQue->fch_publicacion . "   ";
//		echo"</br>";
//		echo"</br>";
//	}
//	echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postSabiasQue->id_tipo_post])->count("id_tipo_post" . "   ");
//	echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postSabiasQue->id_tipo_post])->sum("num_likes");
//	echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postSabiasQue->id_tipo_post])->count("id_post");

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