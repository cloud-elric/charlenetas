<?php

/* @var $post EntPosts*/
?>

 <div class="pin pin-contexto" onclick="showPostFull('<?=$post->txt_token?>')">
 	<div class="pin-header "></div>
 	<div class="image">
 		<img data-src="assets/images/<?=$post->txt_imagen?>">
 	</div>
 	<div class="pin-content-wrapper" lang="en">
 		<h3 class="pin-titulo">
 			<?=$post->txt_titulo?>
 		</h3>
 		<p class="pin-descripcion">
 			<?=$post->txt_descripcion?>
 		</p>
 	</div>
 	<div class="pin-social">
 		<div class="pin-social-counters-wrapper">
      <div class="pin-social-interactions">
				<span>140</span>
				<i class="glyphicon glyphicon-thumbs-up margin-right-20"></i>
				<span>45</span>
				<i class="glyphicon glyphicon-comment"></i>
			</div>
 		</div>
 	</div>
 	<!--?=$post->fch_creacion?-->
 </div>
