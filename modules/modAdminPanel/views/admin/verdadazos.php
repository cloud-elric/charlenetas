<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row">
<?php foreach ( $postsVerdadazos as $postVerdadazos ) {?>
		<div class="col s12 m6 l4">
			<div class="card card-verdadazos">
				<h3><?=$postVerdadazos->txt_descripcion?></h3>
				<p><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postVerdadazos->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?> comentarios</p>
				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box1"
							checked="checked" /> <label for="filled-in-box1"></label>
					</div>
					<i class="ion ion-android-more-vertical card-edit"></i>
				</div>
			</div>
		</div>
	</div>

<?php }?>

	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<i class="ion ion-wand"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->

<?php
foreach ( $postsVerdadazos as $postVerdadazos ) {
	echo $postVerdadazos->txt_descripcion . "   ";
	echo $postVerdadazos->txt_imagen . "   ";
	echo $postVerdadazos->num_likes . "   ";
	echo $postVerdadazos->fch_creacion . "   ";
	echo $postVerdadazos->fch_publicacion . "   ";
	
	echo "</br>";
	echo "</br>";
}
echo "total= " . EntPosts::find ()->where ( [ 
		'id_tipo_post' => $postVerdadazos->id_tipo_post 
] )->count ( "id_tipo_post" . "   " );
echo "total likes= " . EntPosts::find ()->where ( [ 
		'id_tipo_post' => $postVerdadazos->id_tipo_post 
] )->sum ( "num_likes" );

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-verdadazos.js'; // dynamic file added

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
    ", View::POS_END );