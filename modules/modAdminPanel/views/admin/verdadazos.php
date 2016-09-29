<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

$this->title = 'Verdadazos';
$this->icon = '<i class="ion ion-android-done-all"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row" id="js-contenedor-tarjetas">
<?php foreach ( $postsVerdadazos as $postVerdadazos ) {?>
		<div class="col s12 m6 l4" id="card_<?=$postVerdadazos->txt_token?>">

			<div class="card card-verdadazos" data-token="<?=$postVerdadazos->txt_token?>">
				
				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postVerdadazos->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postVerdadazos->id_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarVerdadazos('<?=$postVerdadazos->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>

	<?php }?>

	</div>
	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->

<?php
// foreach ( $postsVerdadazos as $postVerdadazos ) {
// 	echo $postVerdadazos->txt_descripcion . "   ";
// 	echo $postVerdadazos->txt_imagen . "   ";
// 	echo $postVerdadazos->num_likes . "   ";
// 	echo $postVerdadazos->fch_creacion . "   ";
// 	echo $postVerdadazos->fch_publicacion . "   ";
	
// 	echo "</br>";
// 	echo "</br>";
// }
// echo "total= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postVerdadazos->id_tipo_post 
// ] )->count ( "id_tipo_post" . "   " );
// echo "total likes= " . EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => $postVerdadazos->id_tipo_post 
// ] )->sum ( "num_likes" );

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-verdadazos.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );