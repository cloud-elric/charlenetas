
<section class="full-pin-header">

	<h2>Contexto</h2>
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



<section class="full-pin-body full-pin-body-contexto">
	<div class="full-pin-contexto-tabs-menu">
		<ul class="tabs">
			<li class="tab col s3"><a class="active" href="#test1">Titulo del contexto</a></li>
			<li class="tab col s3"><a href="#test2">Titulo del contexto</a></li>
			<li class="tab col s3"><a href="#test3">Titulo del contexto</a></li>
			<li class="tab col s3"><a href="#test4">Titulo del contexto</a></li>
		</ul>
	</div>

	<div class="full-pin-body-contexto-tabs">

		    <div id="test1" class="contexto-data-tab full-pin-body-img-vertical">
					<img src="assets/images/<?=$post->txt_imagen?>" alt="En Contexto - contradicciones de nuestros funcionarios" />
					<h3><?=$post->txt_titulo?></h3>
					<p>
						<?=$post->txt_descripcion?>
					</p>
		    </div>
		    <div id="test2" class="contexto-data-tab full-pin-body-img-vertical">
					<img src="assets/images/usr-avatar.png" alt="En Contexto - contradicciones de nuestros funcionarios" />
					<h3><?=$post->txt_titulo?></h3>
					<p>
						<?=$post->txt_descripcion?>
					</p>
		    </div>
		    <div id="test3" class="contexto-data-tab full-pin-body-img-vertical">
					<img src="assets/images/<?=$post->txt_imagen?>" alt="En Contexto - contradicciones de nuestros funcionarios" />
					<h3><?=$post->txt_titulo?></h3>
					<p>
						<?=$post->txt_descripcion?>
					</p>
		    </div>
		    <div id="test4" class="contexto-data-tab full-pin-body-img-vertical">
					<img src="assets/images/<?=$post->txt_imagen?>" alt="En Contexto - contradicciones de nuestros funcionarios" />
					<h3><?=$post->txt_titulo?></h3>
					<p>
						<?=$post->txt_descripcion?>
					</p>
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

<script>
		$(document).ready(function(){
			 $('ul.tabs').tabs();
		 });
</script>
