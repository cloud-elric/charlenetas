<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-header -->
<div class="page-header">
	<h2 class="page-title"><i class="ion ion-crop"></i> Hoy Pense</h2>
</div>
<!-- end /.page-header -->

<!-- .page-cont -->
<div class="page-cont">
	<!-- .row -->
	<div class="row" id="js-contenedor-tarjetas">
		
		<?php
		foreach ($postsHoyPense as $postHoyPense){
		?>
		
		<div class="col s12 m6 l4" id="card_<?=$postHoyPense->txt_token?>">
			<div class="card card-hoy-pense" data-token="<?=$postHoyPense->txt_token?>">
				<h3><?= $postHoyPense->txt_titulo ?></h3>
				<p><?= EntComentariosPosts::find()->where(['id_post'=>$postHoyPense->id_post])->count("id_post") ?> Comentario(s)</p>
				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
						<label for="filled-in-box1"></label>
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
	</div>
	<!-- end /.fixed-action-btn -->

</div>
<!-- end /.page-cont -->

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
	