<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
$usuario = $post->idUsuario;
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
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>

	</div>

</section>


<section class="full-pin-body full-pin-body-solo-por-hoy full-pin-body-img-vertical">


	<div class="full-pin-body-content">

		<h3>...no violare la constitución</h3>

		<div class="full-pin-body-content-img">
			<img src="webAssets/images/<?=$post->txt_imagen?>" alt="Solo por hoy no violare la constitucion" />
		</div>


		<div class="full-pin-body-content-text">
			<h3><?=Html::encode($post->txt_titulo)?></h3>
			<p>
				<?=Html::encode($post->txt_descripcion)?>
			</p>
			http:://constitucion.com.mx<?=$post->entSoloPorHoys->num_articulo?>
		</div>
	</div>





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
	<div id="js-cargar-comentarios" onclick="cargarComentarios('<?=Html::encode($post->txt_token)?>', false)">Cargar más comentarios</div>
</section>
