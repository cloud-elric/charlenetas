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

// 	$espejosSinResponder = [];
// 	$espejosRespondidos = [];

// 	foreach ( $postsEspejo as $postEspejo ) {
// 		//$espejo = $postEspejo->entEspejos;
// 		$espejo = $postEspejo->entRespuestasEspejo;
		
// 		if($espejo){
// 			//$espejosSinResponder[]= $postEspejo;
// 			$espejosRespondidos[]= $postEspejo;
// 		}else{
// 			//$espejosRespondidos[]= $postEspejo;
// 			$espejosSinResponder[]= $postEspejo;
// 		}
// 	} ?>
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
			<div id="contenedor1">
			<?php 
			foreach($espejosSinResp as $espejoSinResponder){
				$espejoSinResp = EntPosts::find()->where(['id_post'=>$espejoSinResponder->id_post])->one();
			?>	
			
			<div class="col s12 m6 l4" id="card_<?=$espejoSinResp->txt_token?>">
			<div class="card card-espejo"
				data-token="<?=$espejoSinResp->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$espejoSinResp->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($espejoSinResp->entEspejos)?0:$espejoSinResp->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span>Espejo no respondido</span>
					</p>
				</div>
				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$espejoSinResp->txt_token?>"
							value="<?=$espejoSinResp->txt_token?>" /> <label
							class="espejo-delete-check"
							for="delete-<?=$espejoSinResp->txt_token?>"></label>
					</div>
					<a id="button_<?=$espejoSinResp->txt_token?>"
						class="waves-effect waves-light modal-trigger"
						onclick="abrirModalResponderEspejo('<?=$espejoSinResp->txt_token?>')"
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
			<?php
			$totalSinResponder = count($totalEspejosSinResp);
			if ($totalSinResponder > ConstantesWeb::POSTS_MOSTRAR) {
			?>
				<div class="more-entries waves-effect waves-light btn ladda-button"
					data-style="zoom-in" id="js-cargar-mas-posts-espejo1"
					onclick="cargarMasPostsSinResp(<?=$totalSinResponder?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);">
					<span class="ladda-label">Cargar mas entradas...<label>(<?=$totalSinResponder - ConstantesWeb::POSTS_MOSTRAR?>)</label></span>
				</div>
			<?php
			}
			?>
			
			</div>
			<div id="test2" class="col s12">
			<div id="contenedor1">
			<?php 
			foreach($espejosResp as $espejoRespondidos){
				$espejoResp = EntPosts::find()->where(['id_post'=>$espejoRespondidos->id_post])->one();
			?>	
			
			<div class="col s12 m6 l4" id="card_<?=$espejoResp->txt_token?>">
			<div class="card card-espejo"
				data-token="<?=$espejoResp->txt_token?>">

				<div class="card-contexto-cont">
					<p class="card-desc"><?=$espejoResp->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($espejoResp->entEspejos)?0:$espejoResp->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span>Espejo respondido</span>
					</p>
				</div>
				<div class="card-contexto-options">
					<div>
						<input type="checkbox" id="delete-<?=$espejoResp->txt_token?>"
							value="<?=$espejoResp->txt_token?>" /> <label
							class="espejo-delete-check"
							for="delete-<?=$espejoResp->txt_token?>"></label>
					</div>
					<a id="button_<?=$espejoResp->txt_token?>"
						class="waves-effect waves-light modal-trigger"
						onclick="abrirModalResponderEspejo('<?=$espejoResp->txt_token?>')"
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
			<?php
			$totalResponder = count($totalEspejosResp);
			if ($totalResponder > ConstantesWeb::POSTS_MOSTRAR) {
			?>
				<div class="more-entries waves-effect waves-light btn ladda-button"
					data-style="zoom-in" id="js-cargar-mas-posts-espejo2"
					onclick="cargarMasPostsResp(<?=$totalResponder?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);">
					<span class="ladda-label">Cargar mas entradas...<label>(<?=$totalResponder - ConstantesWeb::POSTS_MOSTRAR?>)</label></span>
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
if (! empty ( $token )) {
	$this->registerJs ( "
  		showPostFull('".$token."');
	", View::POS_END, 'mostarPost' );
}

// $postTotales = EntPosts::find ()->where ( [ 
// 		'id_tipo_post' => ConstantesWeb::POST_TYPE_ESPEJO 
// ] )->andWhere ( [ 
// 		'b_habilitado' => 1 
// ] )->count ( 'id_usuario' );
// if ($postTotales > ConstantesWeb::POSTS_MOSTRAR) {
	// echo "Total de posts: ". $postTotales;
	?>

 <!-- <div class="more-entries waves-effect waves-light btn ladda-button"
	data-style="zoom-in" id="js-cargar-mas-posts-espejo"
	onclick="cargarMasPosts(<?php //echo $postTotales?>,<?php //echo ConstantesWeb::POSTS_MOSTRAR?>);">
	<span class="ladda-label">Cargar mas entradas...<label>(<?php //echo $postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span>
</div> -->

<?php
	// $postTotales -= ConstantesWeb::POSTS_MOSTRAR;
//}
?>

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-espejo.js'; // dynamic file added

$this->registerJs ( "
		$(document).ready(function(){
   			 $('.modal-trigger').leanModal();
		
  });

", View::POS_END );