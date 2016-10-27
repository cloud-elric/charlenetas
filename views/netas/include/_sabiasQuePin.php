<?php
/* @var $post EntPosts*/
?>

<div class="pin pin-sabias-que" data-post="<?=$post->txt_token?>">
	<div class="pin-header"></div>
	<div class="image">
		<img data-src="webAssets/images/<?=$post->txt_imagen?>">
	</div>
	<div class="pin-content-wrapper" lang="en">
		<p class="pin-descripcion">
			<?=$post->txt_descripcion?>
		</p>
		<a href="<?=$post->txt_url?>"></a>
	</div>
	
	<form>
	<div class="switch pin-content-wrapper-switch">
		
		<input type="radio" value="true" >Verdadero
		<input type="radio" value="False" >Falso
		
		<!-- <label>
		Falso
		<input data-token="<?=$post->txt_token?>" type="checkbox" class="js-respuesta-check" onchange="validarRespuesta($(this));">
		<span class="lever"></span>
		Verdadero
		</label> -->
	</div>
	</form>

	<?php
		#include 'elementos/pins-social.php';
	?>


	<!--?=$post->fch_creacion?-->
</div>
