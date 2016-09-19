<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>
<!-- .page-cont -->
<div class="page-cont">

	<div class="row">
		<div class="col s12 cards-container">

			<?php foreach ( $postsContexto as $postContexto ) {?>

				<div class="card card-contexto">
					<h3><?= $postContexto->txt_descripcion?></h3>
					<p>
						<?= EntComentariosPosts::find ()->where ( [ 'id_post' => $postContexto->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?> Comentarios
					</p>
					<div class="card-options">
						<div class="card-options-check">
							<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
							<label for="filled-in-box1"></label>
						</div>
						<i class="ion ion-android-more-vertical card-edit"></i>
					</div>

					<div class="card-options-nav">
						Algo
					</div>

				</div>
				
			<?php }?>

		</div>
	</div>

	<!-- <div class="col s12">
		<a class="modal-trigger waves-effect waves-light btn" href="#modal1">Modal</a>
	</div> -->

	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<!-- <i class="ion ion-wand"></i> --> <i
			class="ion ion-ios-trash-outline"></i>
		</a> <a
			class="btn-floating btn-large waves-effect waves-light btn-agregar">
			<i class="material-icons">add</i>
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
$bundle->css [] = 'css/lenetas.css';
$bundle->css [] = 'css/animate.css';

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
    ", View::POS_END );