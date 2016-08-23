

<section class="full-pin-header">

	<h2>Alquimia</h2>
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



<section class="full-pin-body full-pin-body-alquimia full-pin-body-img-vertical">
	<img src="assets/images/<?=$post->txt_imagen?>" alt="Alquimia - Películas que transforman" />
	<h3><?=$post->txt_titulo?></h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>

	<div class="pin-alquimia-grades">

		<?php include 'elementos/pintar-estrellas.php' ?>

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
			<div class="feedback">
				<span>345</span>
				<i class="icon icon-thumbs-up"></i>
			</div>
		</div>
	</div>

</section>




<section class="full-pin-social">

	<div id="//-js-comments">

		<?php
		include 'elementos/comentarios.php'
		?>

	</div>


</section>
