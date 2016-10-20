<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\modules\ModUsuarios\models\Utils;
use app\models\ConstantesWeb;

$this->title = 'Media';
$this->icon = '<i class="ion ion-images"></i>';
?>
<!-- .page-cont -->
<div class="page-cont">


	<div class="row" id="js-contenedor-tarjetas">
	<?php foreach ($postsMedia as $postMedia){?>
	
	<div class="col s12 m6 l4" id="card_<?=$postMedia->txt_token?>">
			<div class="card card-media" data-token="<?=$postMedia->txt_token?>" style="background-image: url(http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($postMedia->txt_url)?>/mqdefault.jpg)">
				<!-- <h3> -->
					<!-- <img src="http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($postMedia->txt_url)?>/mqdefault.jpg"> -->
				<!-- </h3> -->

				<div class="card-contexto-options">
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarMedia('<?=$postMedia->txt_token?>')" href="#js-modal-post-editar">
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
	</div>

</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_MEDIA])->count('id_usuario'); 
if($postTotales>=ConstantesWeb::POSTS_MOSTRAR){
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-media" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...</span></div>

<?php
}
?>

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-media.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );