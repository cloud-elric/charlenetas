<?php
use yii\helpers\Url;
?>

<!-- <div class="pin pin-anuncio pin-anuncio-250-250"> -->
<?php if($num == 5 || $num == 15 || $num == 25 ){?>
	<div class="pin pin-anuncio pin-anuncio-250-250">
		<div class="pin-header pin-header-anuncio"></div>
		<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen?>)"></div>
	</div>
<?php }else{?>
	<div class="pin pin-anuncio pin-anuncio-250-400">
		<div class="pin-header pin-header-anuncio"></div>
		<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen2?>)"></div>
	</div>
<?php }?>
	