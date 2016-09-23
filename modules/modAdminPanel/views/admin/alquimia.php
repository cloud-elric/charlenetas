<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

$this->title = '<i class="ion ion-ios-videocam"></i> Alquimia';
?>

<!-- .page-cont -->
<div class="page-cont">
	<!-- .row -->
	<div class="row" id="js-contenedor-tarjetas">
		
		<?php
		foreach ($postsAlquimia as $postAlquimia){
		?>

		<div class="col s12 m6 l4" id="card_<?=$postAlquimia->txt_token?>">
			<div class="card card-alquimia" data-token="<?=$postAlquimia->txt_token?>">
				
				<div class="card-contexto-cont">
					<h3 class="card-title"><?= $postAlquimia->txt_titulo ?></h3>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_post])->count("id_post") ?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div class="card-contexto-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
						<label for="filled-in-box1"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarAlquimia('<?=$postAlquimia->txt_token?>')" href="#js-modal-post-editar">
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
	// foreach ($postsAlquimia as $postAlquimia){
	// 	//echo $postAlquimia->entAlquimias;
	// 	echo $postAlquimia->id_post . "   ";
	// 	echo $postAlquimia->id_tipo_post . "   ";
	// 	echo $postAlquimia->id_usuario . "   ";
	// 	echo $postAlquimia->id_usuario_administrador . "   ";
	// 	echo $postAlquimia->txt_titulo . "   ";
	// 	echo $postAlquimia->txt_token . "   ";
	// 	echo $postAlquimia->txt_descripcion . "   ";
	// 	echo $postAlquimia->txt_imagen . "   ";
	// 	echo $postAlquimia->txt_url . "   ";
	// 	echo $postAlquimia->num_likes . "   ";
	// 	echo $postAlquimia->fch_creacion . "   ";
	// 	echo $postAlquimia->fch_publicacion . "   ";
	// 	echo $postAlquimia->b_habilitado . "   ";
		
	// 	echo"</br>";
	// }
	// echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->count("id_tipo_post");
	// echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->sum("num_likes");
	// echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_tipo_post])->count("id_post");


$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
      
", View::POS_END );


