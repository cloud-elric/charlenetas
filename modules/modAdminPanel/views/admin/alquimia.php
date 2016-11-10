<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Alquimia';
$this->icon = '<i class="ion ion-film-marker"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">
	<!-- .row -->
	<div class="row" id="js-contenedor-tarjetas">
		
		<?php
		
		if(count($postsAlquimia)==0){
			echo '<h4>Sin alquimias</h4>';
		}
		
		foreach ($postsAlquimia as $postAlquimia){
		?>
		
		<div class="col s12 m6 l4" id="card_<?=$postAlquimia->txt_token?>">
			<div class="card card-alquimia" data-token="<?=$postAlquimia->txt_token?>">
				
				<div class="card-contexto-cont">
					<h3 class="card-title"><?= $postAlquimia->txt_titulo ?></h3>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_post])->andWhere(['is', 'id_comentario_padre',null])->count("id_post") ?></span>
					</p>

				</div>

				<div class="card-contexto-options">

					<div class="alquimia-delete-check-cont">
						<input type="checkbox" id="delete-<?=$postAlquimia->txt_token?>" value="<?=$postAlquimia->txt_token?>"/>
						<label class="alquimia-delete-check" for="delete-<?=$postAlquimia->txt_token?>"></label>
					</div>

					<a id="button_<?=$postAlquimia->txt_token?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarAlquimia('<?=$postAlquimia->txt_token?>')" href="#js-modal-post-editar">
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
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post" onclick='document.getElementById("form-alquimia").reset();'>
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
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_ALQUIMIA])->andWhere(['b_habilitado'=>1])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-alquimia" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
//$postTotales -= ConstantesWeb::POSTS_MOSTRAR;
}
?>

<?php

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
      
", View::POS_END );


