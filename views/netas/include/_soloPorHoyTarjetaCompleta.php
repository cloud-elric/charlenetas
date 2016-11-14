<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;
use yii\web\View;

$usuario = $post->idUsuario;

#$url = 'http://sms-tecnomovil.com/SvtSendSms?username=PIXERED&password=CARLOS&message=' . urlencode ($message) .'&numbers=' . $telefono;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">

	<h2>Solo por hoy...</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=$post->fch_creacion?></h6>
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
			<a target="_blank" href="http://www.ordenjuridico.gob.mx/Constitucion/articulos/<?=$post->entSoloPorHoys->num_articulo?>.pdf">
			Ver articulo
			</a>
		</div>
	</div>





	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
			<div class="feedback" onclick='compartirFacebook("<?=$post->txt_token?>")'>
				<i class="icon icon-facebook"></i>
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
