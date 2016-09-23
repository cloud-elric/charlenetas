<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\modules\ModUsuarios\models\Utils;

$this->title = '<i class="ion ion-images"></i> Media';
?>
<!-- .page-cont -->
<div class="page-cont">

	<div class="row">
	<?php foreach ($postsMedia as $postMedia){?>
		<div class="col s12 m6 l4">
			<div class="card card-media">
				
				<div class="card-contexto-cont">
					<img src="http://img.youtube.com/vi/<?=Utils::getIdVideoYoutube($postMedia->txt_url)?>/mqdefault.jpg">
				</div>

				<div class="card-contexto-options">
					<div class="card-contexto-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box6"
							checked="checked" /> <label for="filled-in-box6"></label>
					</div>
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
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-media.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );