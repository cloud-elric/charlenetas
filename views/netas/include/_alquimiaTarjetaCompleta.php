

<section class="full-pin-header">

	<h2>Alquimia</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<img src="assets/images/usr-avatar.png" alt="" />
		</div>

		<div class="post-date">
			<?=$post->fch_creacion?>
		</div>

	</div>

</section>



<section class="full-pin-body full-pin-body-alquimia">
	<img src="assets/images/<?=$post->txt_imagen?>" alt="Alquimia - Películas que transforman" />
	<h3><?=$post->txt_titulo?></h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>

	<div class="pin-alquimia-grades">
		<span>Calificacion Charlenetas</span>

		<!-- //TODO:: poner el "for2 para por cada numero de calificción total poner las estrellas -->
		<div class="star-wrapper">
			<i class="icon-star"></i>
			<i class="icon-star"></i>
			<i class="icon-star"></i>
			<i class="icon-star"></i><?=$post->entAlquimias->num_calificacion_admin?>
		</div>

		<span>Los usuarios</span>
		<div class="star-wrapper">
			<i class="icon-star"></i>
			<i class="icon-star"></i>
			<i class="icon-star"></i>
			<i class="icon-star-empty"></i><?=$post->entAlquimias->num_calificacion_usuario?>
		</div>

		<span>Tu calificación</span>
		<div class="star-wrapper calificable">
			<i class="icon-star calificada"></i>
			<i class="icon-star calificada"></i>
			<i class="icon-star calificada"></i>
			<i class="icon-star-half calificada"></i><?=$post->entAlquimias->num_calificacion_usuario?>
		</div>
	</div>

</section>


<section class="full-pin-social">

	<div class="coment-new">
		<?php

		echo $this->render ( 'elementos/inputComentario', [
				'token' => $post->txt_token
		] );

		?>
	</div>

	<div class="comment-reply">
		<?php

		echo $this->render ( 'elementos/inputComentario', [
				'token' => $post->txt_token
		] );

		?>
	</div>


	<div id="js-comments"></div>
</section>
