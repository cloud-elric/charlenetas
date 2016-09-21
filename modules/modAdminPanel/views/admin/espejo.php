<?php
use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;

$this->title = 'Espejos';
?>
<!-- .page-cont -->
<div class="page-cont">
	<div class="row">
	<?php
	foreach ( $postsEspejo as $postEspejo ) {
		$espejo = $postEspejo->entEspejos;
		$espejoContestado = false;
		if (! empty ( $espejo->entRespuestasEspejo )) {
			$espejoContestado = true;
		}
		?>
		<div class="col s12 m6 l4">
			<div class="card card-espejo" data-token="<?=$postEspejo->txt_token?>">
				<h3><?=$postEspejo->txt_descripcion?></h3>
				<p><?=$postEspejo->entEspejos->num_subscriptores?> susbcritores</p>
				<?=$espejoContestado?'Espejo respondido':'Espejo no respondido'?>
				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box3"
							checked="checked" /> <label for="filled-in-box3"></label>

					</div>
					<i class="ion ion-android-more-vertical card-edit"></i>
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