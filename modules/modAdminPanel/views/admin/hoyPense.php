<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Hoy pensé';
$this->icon = '<i class="ion ion-android-bulb"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">
	<!-- .row -->
	<div class="row" id="js-contenedor-tarjetas">
		
		<?php foreach ($postsHoyPense as $postHoyPense){ ?>
	
		
		<div class="col s12 m6 l4" id="card_<?=$postHoyPense->txt_token?>">
			<div class="card card-hoy-pense" data-token="<?=$postHoyPense->txt_token?>">
				
				<div class="card-contexto-cont">
					<h3 class="card-title"><?= $postHoyPense->txt_titulo ?></h3>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find()->where(['id_post'=>$postHoyPense->id_post])->andWhere(['is', 'id_comentario_padre',null])->count("id_post") ?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
      					<input type="checkbox" id="delete-<?=$postHoyPense->txt_token?>" value="<?=$postHoyPense->txt_token?>"/>
      					<label for="delete-<?=$postHoyPense->txt_token?>"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarHoyPense('<?=$postHoyPense->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>

		<?php } ?>
		
	</div>
	<!-- end /.row -->

	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<!-- Modal Trigger -->
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
		<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
			<i class="ion ion-ios-trash-outline"></i>
		</a>
	</div>
	<!-- end /.fixed-action-btn -->

</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_HOY_PENSE])->andWhere(['b_habilitado'=>1])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
//echo "Total de  posts: ". $postTotales;
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-hoy-pense" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
//$postTotales -= ConstantesWeb::POSTS_MOSTRAR;
}
?>

<?php
	// foreach ($postsHoyPense as $postHoyPense){
	// 	echo $postHoyPense->txt_descripcion . "   ";
	// 	echo $postHoyPense->txt_imagen . "   ";
	// 	echo $postHoyPense->txt_titulo . "   ";
	// 	echo $postHoyPense->fch_creacion . "   ";
	// 	echo $postHoyPense->fch_publicacion . "   ";
		
	// 	echo"</br>";
	// }
	// echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postHoyPense->id_tipo_post])->count("id_tipo_post" . "   ");
	// echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postHoyPense->id_tipo_post])->sum("num_likes");
	// echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postHoyPense->id_tipo_post])->count("id_post");

	$bundle = ModuleAsset::register ( Yii::$app->view );
	$bundle->js [] = 'js/charlenetas-hoypense.js'; // dynamic file added
	
	$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );
	