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
	
	<div class="switch">
    <label>
      Falso
      <input data-token="<?=$post->txt_token?>" type="checkbox" onchange="validarRespuesta($(this));">
      <span class="lever"></span>
     Verdadero
    </label>
  </div>

	<?php
		#include 'elementos/pins-social.php';
	?>


	<!--?=$post->fch_creacion?-->
</div>
