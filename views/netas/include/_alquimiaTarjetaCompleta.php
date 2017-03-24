<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;
use yii\web\View;

$usuario = $post->idUsuario;
$alquimia = $post->entAlquimias;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header" data-image="<?= $post->txt_imagen?>">
	<h2>Alquimia</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: <?=Html::encode($usuario->txt_username)?></h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_publicacion))?></h6>
		</div>
		<div class="post-publisher-avatar">
<!-- 			<img src="assets/images/usr-avatar.png" alt="" />  -->
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>
	</div>
</section>


<section class="full-pin-body full-pin-body-alquimia full-pin-body-img-vertical">


	<div class="full-pin-body-content">

		<div class="full-pin-body-content-img full-pin-body-content-img-<?= $post->txt_token ?>">
			<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=Html::encode($post->txt_imagen)?>" data-token="img-token-<?=$post->txt_imagen?>"
				alt="Alquimia - Películas que transforman" />
		</div>


		<div class="full-pin-body-content-text">
			<h3><?=Html::encode($post->txt_titulo)?></h3>
			<p>
				<?=Html::encode($post->txt_descripcion)?>
			</p>
			<div class="pin-alquimia-grades">
				<?php include 'elementos/pintar-estrellas.php';?>
			</div>
		</div>
	</div>

	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
<!-- 		did-usr-interact -->
			<div class="feedback" onclick='compartirFacebook("<?=$post->txt_token?>")'>
				<i class="icon icon-facebook"></i>
			</div>

			<div class="feedback" onClick="compartirTwitter('<?=Html::encode($post->txt_titulo)?>')">

					<i class="icon icon-twitter"></i>
			</div>
			<div class="feedback" onClick="compartirPinterest()">
				<i class="icon ion-social-pinterest"></i>
			</div>
			<div class="feedback" id="copy-button" data-clipboard-target="#link-<?=$post->txt_token?>" onClick="copiarClipboard()">
				<i class="material-icons">tab_unselected</i>
				<h6 style="opacity:0; position:fixed; width:0; height:0; overflow:overflow; top:-1px; left:-1px" id="link-<?=$post->txt_token?>"><?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>netas/index?token=<?=$post->txt_token?></h6>
			</div>
		</div>
		<div class="full-pin-body-footer-feedbacks">
			<?php
				include 'elementos/like-post.php';
			?>
		</div>
	</div>
</section>



<section class="full-pin-social">
	<div id="js-comments">
		<?php
		include 'elementos/comentarios.php';
		?>
	</div>
	<?php
		include 'elementos/botonCargarComentarios.php';
		?>
</section>

