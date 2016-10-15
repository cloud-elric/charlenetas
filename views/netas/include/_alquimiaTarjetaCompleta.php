<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;
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
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>
	</div>
</section>


<section class="full-pin-body full-pin-body-alquimia full-pin-body-img-vertical">


	<div class="full-pin-body-content">

		<div class="full-pin-body-content-img">
			<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=Html::encode($post->txt_imagen)?>"
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
	<div id="js-cargar-comentarios" class="comentarios-cargar-comentarios" onclick="cargarComentarios('<?=Html::encode($post->txt_token)?>', false)">
		<p>
			<span>Cargar más comentarios...</span><i class="icon icon icon-comment"></i>
		</p>
	</div>
</section>
