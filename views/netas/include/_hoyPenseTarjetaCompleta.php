<<<<<<< HEAD

<section class="full-pin-header">

	<h2>Hoy Pense</h2>
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
=======
<?php
/* @var $post EntPosts*/
?>
<h1>Hoy pense</h1>
<?=$post->txt_titulo?><br>
<?=$post->txt_descripcion?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>

<div id="js-comments"></div>

<?php

echo $this->render ( 'elementos/inputComentario', [ 
		'token' => $post->txt_token,
		'respuesta'=>false 
] );
>>>>>>> master



<section class="full-pin-body full-pin-body-hoy-pense full-pin-body-img-vertical">
	<h3><?=$post->txt_titulo?></h3>
	<img src="assets/images/<?=$post->txt_imagen?>" alt="Alquimia - Películas que transforman" />	
	<p>
		<?=$post->txt_descripcion?>
	</p>

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
