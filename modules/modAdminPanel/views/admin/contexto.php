<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Contexto';
$this->icon = '<i class="ion ion-network"></i>';
?>
<!-- .page-cont -->
<div class="page-cont">
	
	<!-- .contexto-search -->
	<div class="contexto-search">
	<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data',
				'class' => 'contexto-search-form'
		],
 		'method'=>'get',
		'layout' => 'horizontal',
		'id' => 'form-search',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label ' 
				],
				'options' => [ 
						'class' => 'input-field col s6 m3' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );
?>

<?=Html::input('text', 'searchTags','',['placeholder'=>'Buscar por tag'])?>

<?= Html::submitButton('Buscar tag<i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php ActiveForm::end();

include 'templates/formato-fecha.php';

?>
	</div>
	<!-- end - .contexto-search -->

	<div class="row" id="js-contenedor-tarjetas">
		
		<?php foreach ( $postsContexto as $postContexto ) {?>
			<div class="col s12 m6 l4">
				<div class="card card-contexto" data-token="<?=$postContexto->txt_token?>">
					
					<div class="card-contexto-cont" id="card_<?=$postContexto->txt_token?>">
						<h3 class="card-title"><?= $postContexto->txt_descripcion?></h3>
					</div>

					<div class="card-contexto-status">
						<p class="card-contexto-status-comen">
							<i class="ion icon icon-comment"></i> <span><?= EntComentariosPosts::find ()->where ( [ 'id_post' => $postContexto->id_tipo_post ] )->andWhere ( [ 'is','id_comentario_padre',null ] )->count ( "id_post" )?></span>
						</p>
						<?php 
						if($postContexto->entContextos->idContextoPadre){
						?>
							<button  id="btn-aso-<?=$postContexto->txt_token?>" class="btn btn-sin-asociar" onclick="deseleccionarAsociar($(this));" data-token=<?=$postContexto->txt_token?>>Desasociar</button>
						<?php 
							}else{
								?>
							<button id="btn-aso-<?=$postContexto->txt_token?>" class="btn btn-sin-asociar" onclick="seleccionarAsociar($(this));" data-token=<?=$postContexto->txt_token?>>Asociar</button>	
						<?php 		
							}
						?>
					</div>

					<div class="card-contexto-options">
						<?php 
						if($postContexto->entContextos->idContextoPadre){
							$contextoPadre = $postContexto->entContextos->idContextoPadre->idPost;
						?>
						
						<a class="card-contexto-options-extra" href="">
						<i class="ion ion-network tooltipped" data-position="top" data-delay="50" data-tooltip="<?=$contextoPadre->txt_titulo?>"></i></a>
						<?php
						}
						?>
						
						<a id="button_<?=$postContexto->txt_token?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarContexto('<?=$postContexto->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>
					</div>

				</div>
				
			</div>
		<?php }?>

	</div>
	
	
	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<!-- Modal Trigger -->
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post" onclick='document.getElementById("form-contexto").reset();'>
			<i class="ion ion-wand"></i>
		</a>
	</div>
	<!-- end /.fixed-action-btn -->


</div>
<!-- end /.page-cont -->
<?php

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-contexto.js'; // dynamic file added
// $bundle->css [] = 'css/lenetas.css';

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    	$('.modal-trigger').leanModal();
  });
    ", View::POS_END );