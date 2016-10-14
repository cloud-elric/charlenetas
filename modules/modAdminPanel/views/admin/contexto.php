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

	<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
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
					</div>

					<div class="card-contexto-options">
						<i class="ion ion-android-more-vertical"></i>
						<a id="button_<?=$postContexto->txt_token?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarAlquimia('<?=$postContexto->txt_token?>')" href="#js-modal-post-editar">
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