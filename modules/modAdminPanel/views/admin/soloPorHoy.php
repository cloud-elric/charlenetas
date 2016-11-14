<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;
$this->title = 'Solo por hoy';
$this->icon = '<i class="ion ion-android-warning"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">


	<div class="row" id="js-contenedor-tarjetas">
	<?php foreach ($postsSoloPorHoy as $postSoloPorHoy){?>

		<div class="col s12 m6 l4" id="card_<?=$postSoloPorHoy->txt_token?>">
			<div class="card card-solo-por-hoy" data-token="<?=$postSoloPorHoy->txt_token?>">
				

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSoloPorHoy->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-comen">
						<i class="ion icon icon-comment"></i> <span><?=EntComentariosPosts::find ()->where ( [ 'id_post' => $postSoloPorHoy->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div>
      					<input type="checkbox" id="delete-<?=$postSoloPorHoy->txt_token?>" value="<?=$postSoloPorHoy->txt_token?>"/>
      					<label for="delete-<?=$postSoloPorHoy->txt_token?>"></label>
					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSoloPorHoy('<?=$postSoloPorHoy->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>

			</div>
		</div>
		<?php }?>

		<!-- <div class="col s12">
			<a class="modal-trigger waves-effect waves-light btn" href="#modal1">Modal</a>
		</div> -->

	</div>



	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
		<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
			<i class="ion ion-ios-trash-outline"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_SOLO_POR_HOY])->andWhere(['b_habilitado'=>1])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-solo-por-hoy" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
}
?>

<?php

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-soloporhoy.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );