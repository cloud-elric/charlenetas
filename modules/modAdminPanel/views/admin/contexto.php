<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

$this->title = '<i class="ion ion-android-share-alt"></i> Contextos';
?>
<!-- .page-cont -->
<div class="page-cont">

	<div class="row">
		
		<?php foreach ( $postsContexto as $postContexto ) {?>
			<div class="col s12 m6 l4">
				<div class="card card-contexto">
					
					<div class="card-contexto-cont">
						<p class="card-desc"><?= $postContexto->txt_descripcion?></p>
					</div>

					<div class="card-contexto-status">
						<p class="card-contexto-status-comen">
							<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find ()->where ( [ 'id_post' => $postContexto->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
						</p>
					</div>

					<div class="card-contexto-options">
						<div class="card-contexto-options-check">
							<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
							<label for="filled-in-box1"></label>
						</div>
						<i class="ion ion-android-more-vertical card-edit"></i>
					</div>

				</div>
				
			</div>
		<?php }?>

	</div>

	<!-- <div class="col s12">
		<a class="modal-trigger waves-effect waves-light btn" href="#modal1">Modal</a>
	</div> -->

	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<i class="ion ion-ios-trash-outline"></i>
		</a> <a
			class="btn-floating btn-large waves-effect waves-light btn-agregar">
			<i class="ion ion-wand"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->
<?php
// foreach ( $postsContexto as $postContexto ) {
// 	echo $postContexto->txt_descripcion . "   ";
// 	echo $postContexto->txt_imagen . "   ";
// 	// echo $postContexto->entContextos->id_contexto_padre . " ";
// 	echo $postContexto->txt_url . "   ";
// 	echo $postContexto->fch_creacion . "   ";
// 	echo $postContexto->fch_publicacion . "   ";
	
// 	echo "</br>";
// 	echo "</br>";
// }
// echo "total= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postContexto->id_tipo_post 
// ] )->count ( "id_tipo_post" . "   " );
// echo "total likes= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postContexto->id_tipo_post 
// ] )->sum ( "num_likes" );

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-contexto.js'; // dynamic file added
// $bundle->css [] = 'css/lenetas.css';

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
    ", View::POS_END );