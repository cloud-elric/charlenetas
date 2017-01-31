<?php
use yii\helpers\Url;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-header -->
<div class="page-header">
	<h2 class="page-title" id="page-title-cliente" data-id="<?= $cliente->id_cliente ?>"><i class="ion ion-android-people"></i>Anuncios <?= $cliente->txt_nombre ?></h2>
</div>
<!-- end /.page-header -->

<!-- .page-cont -->
<div class="page-cont">
	<div class="row" id="js-contenedor-tarjetas">
		<?php foreach($anuncios as $anuncio){ ?>
			<div class="col s12 m6 l4" id="card_anuncio_<?=$anuncio->id_anuncio?>">
				<div id="card_anuncio_url<?=$anuncio->id_anuncio?>" class="card card-media" data-token="<?=$anuncio->id_anuncio?>" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?= $anuncio->txt_imagen ?>)">
					<div class="card-contexto-options">
						<div>
			   				<input type="checkbox" id="delete_anuncio_<?=$anuncio->id_anuncio?>" value="<?=$anuncio->id_anuncio?>"/>
      						<label for="delete_anuncio_<?=$anuncio->id_anuncio?>"></label>
						</div>
						<a class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarAnuncio('<?= $anuncio->id_anuncio ?>')" href="#js-modal-post-editar">
							<i class="ion ion-android-more-vertical card-edit"></i>
						</a>
					</div>
				</div>
			</div>
		<?php }?>
	</div>	
</div>	
		
<!-- .fixed-action-btn -->
<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
		<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
			<i class="ion ion-ios-trash-outline"></i>
		</a>
	</div>
<!-- end /.fixed-action-btn -->

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-anuncios.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
		});
    ", View::POS_END );
