<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;
use yii\web\View;

$usuario = $post->idUsuario;

#$url = 'http://sms-tecnomovil.com/SvtSendSms?username=PIXERED&password=CARLOS&message=' . urlencode ($message) .'&numbers=' . $telefono;
?>

<style type="text/css">
	.pin-link{
		display: inline-block;
		margin-left: 15%;
    margin-top: 20px;
	}
</style>

<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">

	<h2>Sólo por hoy...</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_creacion))?></h6>
		</div>

		<div class="post-publisher-avatar">
			<?php 
			#if(!Yii::$app->user->isGuest) { ?>
						<?=Html::img(Html::encode($usuario->getImageProfile()))?>
			<?php #}?>			
		</div>

	</div>

</section>


<section class="full-pin-body full-pin-body-solo-por-hoy full-pin-body-img-vertical">


	<div class="full-pin-body-content">

		<h3>...no violare la constitución</h3>

		<div class="full-pin-body-content-img">
			<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=Html::encode($post->txt_imagen)?>" alt="Solo por hoy no violare la constitucion" />
		</div>


		<div class="full-pin-body-content-text">
			<h3><?=Html::encode($post->txt_titulo)?></h3>
			<p>
				<?=Html::encode($post->txt_descripcion)?>
			</p>
			
			<div class="pin-link">
				<a target="_blank" class="waves-effect waves-light btn btn-secondary" href="http://www.ordenjuridico.gob.mx/Constitucion/articulos/<?=$post->entSoloPorHoys->num_articulo?>.pdf">
				Ver articulo contitucional
				</a>
			</div>
			
			<div class="pin-link">
				<a class="waves-effect waves-light btn btn-secondary" href="<?=$post->txt_url?>" target="_blank">Ver nota periodística</a>
			</div>
			
		</div>
	</div>





	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
			<div class="feedback" onclick='compartirFacebook("<?=$post->txt_token?>")'>
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
