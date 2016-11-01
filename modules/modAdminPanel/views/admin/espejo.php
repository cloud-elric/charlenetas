<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
use app\models\ConstantesWeb;

$this->title = 'Espejo';
$this->icon = '<i class="ion ion-eye"></i>';
?>
<!-- .page-cont -->
<div class="page-cont">
	<div class="row" id="js-contenedor-tarjetas">
	<?php
	foreach ( $postsEspejo as $postEspejo ) {
		$espejo = $postEspejo->entEspejos;
		$espejoContestado = false;
		if (! empty ( $espejo->entRespuestasEspejo )) {
			$espejoContestado = true;
		}
		?>
		<div class="col s12 m6 l4" id="card_<?=$postEspejo->txt_token?>">
			<div class="card card-espejo" data-token="<?=$postEspejo->txt_token?>">
				<p>
      				<input type="checkbox" id="delete-<?=$postEspejo->txt_token?>" value="<?=$postEspejo->txt_token?>"/>
      				<label for="delete-<?=$postEspejo->txt_token?>">Eliminar</label>
    			</p>
				<div class="card-contexto-cont">
					<p class="card-desc"><?=$postEspejo->txt_descripcion?></p>
				</div>

				<div class="card-contexto-status">
					<p class="card-contexto-status-susbs">
						<i class="ion ion-person-stalker"></i> <span><?=empty($postEspejo->entEspejos)?0:$postEspejo->entEspejos->num_subscriptores?></span>
					</p>
					<p class="card-contexto-status-comen respondido">
						<i class="ion icon icon-comment"></i> <span><?=$espejoContestado?'Espejo respondido':'Espejo no respondido'?></span>
					</p>
				</div>

				<div class="card-contexto-options">
					<div class="card-contexto-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>

					</div>
					<a class="waves-effect waves-light modal-trigger" onclick="abrirModalResponderEspejo('<?=$postEspejo->txt_token?>')" href="#js-modal-post-editar">
						<i class="ion ion-android-more-vertical card-edit"></i>
					</a>				
				</div>
			</div>
		</div>


		<?php } ?>
		
	</div>
	<!-- end /.row -->
	<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
		<i class="ion ion-trash"></i>
	</a>

</div>
<!-- end /.page-cont -->

<?php
$postTotales = EntPosts::find()->where(['id_tipo_post'=>ConstantesWeb::POST_TYPE_ESPEJO])->count('id_usuario'); 
if($postTotales>ConstantesWeb::POSTS_MOSTRAR){
//echo "Total de  posts: ". $postTotales;
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts-espejo" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::POSTS_MOSTRAR?>);"><span class="ladda-label">Cargar mas
	entradas...<label>(<?=$postTotales - ConstantesWeb::POSTS_MOSTRAR?>)</label></span></div>

<?php
//$postTotales -= ConstantesWeb::POSTS_MOSTRAR;
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