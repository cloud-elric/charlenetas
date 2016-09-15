<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>
<!-- .page -->
<div class="page">
	<!-- .page-header -->
	<div class="page-header">
		<h2 class="page-title">
			<i class="ion ion-card"></i> Alquimia
		</h2>
	</div>
	<!-- end /.page-header -->
	<!-- .page-cont -->
	<div class="page-cont">
		<div class="row">
		<?php foreach ( $postsAlquimia as $postAlquimia ) {?>
			<div class="col s12 m6 l4">
				<div class="card card-alquimia">
					<h3><?=$postAlquimia->txt_titulo?></h3>
					<p><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postAlquimia->id_post ] )->andWhere([ 'is','id_comentario_padre',null ])->count ( "id_post" )?> comentarios</p>
					<div class="card-options">
						<div class="card-options-check">
							<input type="checkbox" class="filled-in" id="filled-in-box1"
								checked="checked" /> <label for="filled-in-box1"></label>
						</div>
						<i class="ion ion-android-more-vertical card-edit"></i>
						<!-- <i class="ion ion-edit card-edit"></i> -->
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
</div>
<!-- end /.page -->
<?php
foreach ( $postsAlquimia as $postAlquimia ) {
	$postAlquimia->txt_titulo . "   ";
	$postAlquimia->txt_token . "   ";
	$postAlquimia->txt_descripcion . "   ";
	$postAlquimia->txt_imagen . "   ";
	$postAlquimia->txt_url . "   ";
	$postAlquimia->num_likes . "   ";
	$postAlquimia->fch_creacion . "   ";
	$postAlquimia->fch_publicacion . "   ";
	$postAlquimia->b_habilitado . "   ";
	
	"</br>";
}
"total= " . EntPosts::find ()->where ( [ 
		'id_tipo_post' => $postAlquimia->id_tipo_post 
] )->count ( "id_tipo_post" );
"total likes= " . EntPosts::find ()->where ( [ 
		'id_tipo_post' => $postAlquimia->id_tipo_post 
] )->sum ( "num_likes" );
"total comentarios= " . EntComentariosPosts::find ()->where ( [ 
		'id_post' => $postAlquimia->id_post 
] )->count ( "id_post" );

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
", View::POS_END );


