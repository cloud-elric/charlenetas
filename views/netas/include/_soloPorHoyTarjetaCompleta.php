<?php
use yii\helpers\Html;
?>
<section class="full-pin-header">

	<h2>Solo por hoy...</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=$post->fch_creacion?></h6>
		</div>

		<div class="post-publisher-avatar">
			<img src="assets/images/usr-avatar.png" alt="" />
		</div>

	</div>

</section>


<section class="full-pin-body full-pin-body-solo-por-hoy full-pin-body-img-vertical">
	<h3>...no violare la constitución</h3>
	<img src="assets/images/<?=$post->txt_imagen?>" alt="Solo por hoy no violare la constitucion" />

	<p>
		<?=$post->txt_descripcion?>
	</p>
	http:://constitucion.com.mx<?=$post->entSoloPorHoys->num_articulo?>

	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
			<div class="feedback did-usr-interact">
				<i class="icon icon-facebook"></i>
			</div>
			<div class="feedback">
				<i class="icon icon-twitter"></i>
			</div>
		</div>
		<div class="full-pin-body-footer-feedbacks">
			<?php 
				if (Yii::$app->user->isGuest) {
					$onclick = 'showModalLogin();';
				}else{
					$onclick = 'likePost("'.$post->txt_token.'");';
				}
				?>
			<div class="feedback js-feedback-like" onclick='<?=$onclick?>'>
				<span  id='js-like-<?=$post->txt_token?>'><?=Html::encode($post->num_likes)?></span> <i class="icon icon-thumbs-up"></i>
			</div>
		</div>
	</div>

</section>

<section class="full-pin-social">
	<div id="js-comments">
		<?php
		include 'elementos/comentarios.php';
		?>
	</div>
	<div id="js-cargar-comentarios" onclick="cargarComentarios('<?=Html::encode($post->txt_token)?>', false)">Cargar más comentarios</div>
</section>
