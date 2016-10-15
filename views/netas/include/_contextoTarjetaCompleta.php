<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use yii\helpers\Url;
$usuario = $post->idUsuario;
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">
	<h2>Contexto
	</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: <?=Html::encode($usuario->txt_username)?></h6>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_publicacion))?></h6>
		</div>

		<div class="post-publisher-avatar">
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>

	</div>
</section>

<section class="full-pin-body full-pin-body-contexto">


	<div class="full-pin-contexto-tabs-menu">
		<ul class="tabs">
			<li class="tab col s3"><a class="active" href="#test1"><?=Html::encode($post->txt_titulo)?></a></li>
			<?php
			$i = 2;

			if($post->entContextos){
				$contestosHijos = $post->entContextos->entContextos;
			}else{
				$contestosHijos = [];
			}
			foreach ( $contestosHijos  as $contextoHijo ) {
				$hijo = $contextoHijo->idPost;
				?>
			<li class="tab col s3"><a href="#test<?=$i?>"><?=$hijo->txt_titulo?></a></li>
		<?php
				$i ++;
			}
			?>
		</ul>
	</div>

	<div class="full-pin-body-contexto-tabs">
		<div id="test1" class="contexto-data-tab full-pin-body-img-vertical">

			<div class="full-pin-body-content">
				<div class="full-pin-body-content-img">
					<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$post->txt_imagen?>"
						alt="<?=$post->txt_titulo?>" />
				</div>
				<div class="full-pin-body-content-text">
					<h3><?=$post->txt_titulo?></h3>
					<p>
						<?=$post->txt_descripcion?>
					</p>
				</div>
			</div>

		</div>

		<?php
			$i = 2;
			foreach ( $contestosHijos  as $contextoHijo ) {
				$hijo = $contextoHijo->idPost;
			?>
		<div id="test<?=$i?>" class="contexto-data-tab full-pin-body-img-vertical">

			<div class="full-pin-body-content">
				<div class="full-pin-body-content-img">
					<img src="<?=Url::base()?>/uploads/imagenesPosts/<?=$hijo->txt_imagen?>"
						alt="<?=$hijo->txt_titulo?>" />
				</div>
				<div class="full-pin-body-content-text">
					<h3><?=$hijo->txt_titulo?></h3>
					<p>
						<?=$hijo->txt_descripcion?>
					</p>
				</div>
			</div>

		</div>
		<?php
			$i++;
			}?>
	</div>
	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
			<div class="feedback did-usr-interact" onclick='compartirFacebook("<?=$post->txt_token?>")'>
				<i class="icon icon-facebook"></i>
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
	<div id="js-cargar-comentarios" class="comentarios-cargar-comentarios" onclick="cargarComentarios('<?=Html::encode($post->txt_token)?>', false)">
		<p>
			<span>Cargar más comentarios...</span><i class="icon icon icon-comment"></i>
		</p>
	</div>
</section>

<script>
		$(document).ready(function(){
			 $('ul.tabs').tabs();
		 });
</script>
