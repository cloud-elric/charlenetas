<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Sabias que';
$this->icon = '<i class="ion ion-help"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">

	<div class="row" id="js-contenedor-tarjetas">

	<?php foreach ($postsSabiasQue as $postSabiasQue){ ?>
	
		<div>
			<p>
      			<input type="checkbox" id="delete-<?=$postSabiasQue->txt_token?>" value="<?=$postSabiasQue->txt_token?>"/>
      			<label for="delete-<?=$postSabiasQue->txt_token?>">Eliminar</label>
    		</p>
		</div>
		<div class="col s12 m6 l4" id="card_<?=$postSabiasQue->txt_token?>">
			<div class="card card-sabias-que" data-token="<?=$postSabiasQue->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postSabiasQue->txt_descripcion?></p>
				</div>

				<div class="card-contexto-options">
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarSabiasQue('<?=$postSabiasQue->txt_token?>')" href="#js-modal-post-editar">
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
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_SABIAS_QUE])->andWhere(['b_habilitado'=>1])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-sabias-que" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
}
?>

<?php 	
	$bundle = ModuleAsset::register ( Yii::$app->view );
	$bundle->js [] = 'js/charlenetas-sabiasque.js'; // dynamic file added
	
	$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );
?>

