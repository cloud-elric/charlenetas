<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;

$usuario = $post->idUsuario;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">

	<h2>Verdadazos</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_creacion))?></h6>
		</div>

		<div class="post-publisher-avatar">
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>

	</div>

</section>

<section
	class="full-pin-body full-pin-body-alquimia full-pin-body-img-horizontal">
	<h3><?=$post->txt_titulo?></h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>
	<img style="width: 100%;" src="<?=Url::base()?>/uploads/imagenesPosts/<?=Html::encode($post->txt_imagen)?>"
		alt="Verdadazos - Netas bien duras" />
	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
			<div class="feedback " onclick='compartirFacebook("<?=$post->txt_token?>")'>
				<i class="icon icon-facebook"></i>
			</div>
			<div class="feedback" id="copy-button" data-clipboard-target="#link-<?=$post->txt_token?>" onClick="copiarClipboard()">
				<i class="material-icons">tab_unselected</i>
				<h6 style="opacity:0; position:fixed; width:0; height:0; overflow:overflow; top:-1px; left:-1px" id="link-<?=$post->txt_token?>"><?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>netas/index?token=<?=$post->txt_token?></h6>
			</div>
<!-- 			<div class="feedback"> -->
<!-- 				<i class="icon icon-twitter"></i> -->
<!-- 			</div> -->
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
