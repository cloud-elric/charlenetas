<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Espejo';
$this->icon = '<i class="ion ion-eye"></i>';
?>

<?php

	$espejosSinResponder = [];
	$espejosRespondidos = [];

	foreach ( $postsEspejo as $postEspejo ) {
		$espejo = $postEspejo->entEspejos;
		
		if($espejo){
			$espejosSinResponder[]= $postEspejo;
		}else{
			$espejosRespondidos[]= $postEspejo;
		}
		} ?>
<!-- .page-cont -->
<div class="page-cont">
	<div class="row" id="js-contenedor-tarjetas">
	
	
		<div class="row">
			<div class="col s6">
				<ul class="tabs">
					<li class="tab col s3"><a class="active" href="#test1">Sin responder</a></li>
					<li class="tab col s3"><a href="#test2">Respondidos</a></li>
				</ul>
			</div>
			<div id="test1" class="col s12">
			<?php 
			foreach($espejosSinResponder as $espejoSinResponder){
			?>	
			
			<div class="col s12 m6 l4" id="card_<?=$espejoSinResponder->txt_token?>">
			<div class="card card-espejo"
				data-token="<?=$espejoSinResponder->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$espejoSinResponder->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($espejoSinResponder->entEspejos)?0:$espejoSinResponder->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span>Espejo no respondido</span>
					</p>
				</div>
				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$espejoSinResponder->txt_token?>"
							value="<?=$espejoSinResponder->txt_token?>" /> <label
							class="espejo-delete-check"
							for="delete-<?=$espejoSinResponder->txt_token?>"></label>
					</div>
					<a id="button_<?=$espejoSinResponder->txt_token?>"
						class="waves-effect waves-light modal-trigger"
						onclick="abrirModalResponderEspejo('<?=$espejoSinResponder->txt_token?>')"
						href="#js-modal-post-editar"> <i
						class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>
				
			<?php 
			}
			?>

			</div>
			<div id="test2" class="col s12">
			<?php 
			foreach($espejosRespondidos as $espejoRespondidos){
			?>	
			
			<div class="col s12 m6 l4" id="card_<?=$espejoRespondidos->txt_token?>">
			<div class="card card-espejo"
				data-token="<?=$espejoRespondidos->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$espejoRespondidos->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($espejoRespondidos->entEspejos)?0:$espejoRespondidos->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span>Espejo respondido</span>
					</p>
				</div>
				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$espejoRespondidos->txt_token?>"
							value="<?=$espejoRespondidos->txt_token?>" /> <label
							class="espejo-delete-check"
							for="delete-<?=$espejoRespondidos->txt_token?>"></label>
					</div>
					<a id="button_<?=$espejoRespondidos->txt_token?>"
						class="waves-effect waves-light modal-trigger"
						onclick="abrirModalResponderEspejo('<?=$espejoRespondidos->txt_token?>')"
						href="#js-modal-post-editar"> <i
						class="ion ion-android-more-vertical card-edit"></i>
					</a>
				</div>
			</div>
		</div>
				
			<?php 
			}
			?>

			</div>
		</div>

	</div>
	<!-- end /.row -->

	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light"
			onclick="deletePosts()"> <i class="ion ion-ios-trash-outline"></i>
		</a>
	</div>
	<!-- end /.fixed-action-btn -->

</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find ()->where ( [ 
		'id_tipo_post' => ConstantesWeb::POST_TYPE_ESPEJO 
] )->andWhere ( [ 
		'b_habilitado' => 1 
] )->count ( 'id_usuario' );
if ($postTotales > ConstantesWeb::POSTS_MOSTRAR) {
	// echo "Total de posts: ". $postTotales;
	?>

<div class="more-entries waves-effect waves-light btn ladda-button"
	data-style="zoom-in" id="js-cargar-mas-posts-espejo"
	onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);">
	<span class="ladda-label">Cargar mas entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span>
</div>

<?php
	// $postTotales -= ConstantesWeb::POSTS_MOSTRAR;
}
?>

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-espejo.js'; // dynamic file added

$this->registerJs ( "
		$(document).ready(function(){
   			 $('.modal-trigger').leanModal();
		
  });

", View::POS_END );