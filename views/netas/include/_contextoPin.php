<?php

/* @var $post EntPosts*/
?>

<div onclick="showPostFull('<?=$post->txt_token?>')" class=pin>
	<div class=image>
		<img data-src="images/437ea18b.image3.jpg">
	</div>
	<div class=description><span onclick="showPostFull('<?=$post->txt_token?>')">Ver más</span>
<?=$post->txt_descripcion?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br></div>
	<div class=credits>Sample credits</div>

</div>

<!-- <div class="pin"> -->
<!-- 	<h1>Contexto</h1>

 </div> -->

