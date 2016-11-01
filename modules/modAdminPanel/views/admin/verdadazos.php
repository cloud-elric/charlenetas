<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Verdadazos';
$this->icon = '<i class="ion ion-android-done-all"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row" id="js-contenedor-tarjetas">
<?php foreach ( $postsVerdadazos as $postVerdadazos ) {?>
		<div class="col s12 m6 l4" id="card_<?=$postVerdadazos->txt_token?>">

			<div class="card card-verdadazos" data-token="<?=$postVerdadazos->txt_token?>">
				<p>
      				<input type="checkbox" id="delete-<?=$postVerdadazos->txt_token?>" value="<?=$postVerdadazos->txt_token?>"/>
      				<label for="delete-<?=$postVerdadazos->txt_token?>">Eliminar</label>
    			</p>
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
		<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
			<i class="ion ion-trash"></i>
		</a>
	</div>


</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_VERDADAZOS])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
//echo "Total de  posts: ". $postTotales;
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-verdadazos" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
//$postTotales -= ConstantesWeb::POSTS_MOSTRAR;
}
?>

<?php

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-verdadazos.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );