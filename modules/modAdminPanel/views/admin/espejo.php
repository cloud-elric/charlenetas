<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

$this->title = 'Espejos';
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
				<h3><?=$postEspejo->txt_descripcion?></h3>
				<p><?=empty($postEspejo->entEspejos)?0:$postEspejo->entEspejos->num_subscriptores?> susbcritores</p>
				<p class='respondido'><?=$espejoContestado?'Espejo respondido':'Espejo no respondido'?></p>
				<div class="card-options">
					<div class="card-options-check">
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

</div>
<!-- end /.page-cont -->

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-espejo.js'; // dynamic file added

$this->registerJs ( "
		$(document).ready(function(){
   			 $('.modal-trigger').leanModal();
		
  });

", View::POS_END );