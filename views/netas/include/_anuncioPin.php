<?php
use yii\helpers\Url;
?>

<div class="pin pin-sabias-que">
	<div class="pin-header pin-header-sabias-que"></div>
	
	<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen?>)">
		<p class="pin-descripcion">
			ESTO ES UN ANUNCIO <?=$listaAnuncios[$countAnuncio]->id_anuncio?>
		</p>
		<div class="pin-link">
			<a class="waves-effect waves-light btn btn-secondary"
			href="#"
			target="_blank">Ver nota</a>
		</div>
	</div>
</div>
