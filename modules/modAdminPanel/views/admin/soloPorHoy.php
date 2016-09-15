<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row">
<?php foreach ($postsSoloPorHoy as $postSoloPorHoy){?>
						<div class="col s12 m6 l4">
			<div class="card card-solo-por-hoy">
				<h3><?=$postSoloPorHoy->txt_descripcion?></h3>
				<p><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postSoloPorHoy->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?> comentarios</p>
				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>
					</div>
					<i class="ion ion-android-more-vertical card-edit"></i>
				</div>
			</div>
		</div>
<?php }?>

						<!-- <div class="col s12">
							<a class="modal-trigger waves-effect waves-light btn" href="#modal1">Modal</a>
						</div> -->

	</div>



	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<i class="ion ion-wand"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->

<?php
// foreach ( $postsSoloPorHoy as $postSoloPorHoy ) {
// 	echo $postSoloPorHoy->txt_descripcion . "   ";
// 	echo $postSoloPorHoy->txt_imagen . "   ";
// 	echo $postSoloPorHoy->entSoloPorHoys->num_articulo . "   ";
// 	echo $postSoloPorHoy->txt_url . "   ";
// 	echo $postSoloPorHoy->fch_creacion . "   ";
// 	echo $postSoloPorHoy->fch_publicacion . "   ";
// 	echo "</br>";
// 	echo "</br>";
// }
// echo "total= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postSoloPorHoy->id_tipo_post 
// ] )->count ( "id_tipo_post" . "   " );
// echo "total likes= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postSoloPorHoy->id_tipo_post 
// ] )->sum ( "num_likes" );
// echo "total comentarios= " . EntComentariosPosts::find ()->where ( [ 
// 		'id_post' => $postSoloPorHoy->id_tipo_post 
// ] )->andWhere ( [ 
// 		'is',
// 		'id_comentario_padre',
// 		null 
// ] )->count ( "id_post" );

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-soloporhoy.js'; // dynamic file added

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
    ", View::POS_END );