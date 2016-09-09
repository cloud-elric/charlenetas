<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
$usuario = $post->idUsuario;
$alquimia = $post->entAlquimias;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">
	<h2>Alquimia</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: <?=Html::encode($usuario->txt_username)?></h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_publicacion))?></h6>
		</div>
		<div class="post-publisher-avatar">
<!-- 			<img src="assets/images/usr-avatar.png" alt="" />  -->
			<?=Html::img(Html::encode($usuario->getImageProfile()), ['width'=>'27px'])?>
		</div>
	</div>
</section>
<section
	class="full-pin-body full-pin-body-alquimia full-pin-body-img-vertical">
	<img src="assets/images/<?=Html::encode($post->txt_imagen)?>"
		alt="Alquimia - Películas que transforman" />
	<h3><?=Html::encode($post->txt_titulo)?></h3>
	<p>
		<?=Html::encode($post->txt_descripcion)?>
	</p>
	<div class="pin-alquimia-grades">
		<?php include 'elementos/pintar-estrellas.php'?>
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
