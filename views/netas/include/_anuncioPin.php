<?php
use yii\helpers\Url;
?>

<!-- <div class="pin pin-anuncio pin-anuncio-250-250"> -->
<?php if($num == 4 || $num == 12 || $num == 24 ){?>
	<div class="pin pin-anuncio pin-anuncio-250-250">
		<div class="pin-header pin-header-anuncio"></div>
		<?php if($listaAnuncios[$countAnuncio]->txt_url){?>
		<a href="<?= $listaAnuncios[$countAnuncio]->txt_url ?>" target="_blank">
			<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen?>)"></div>
		</a>
		<?php }else{ ?>
			<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen?>)"></div>
		<?php }?>
	</div>
<?php }else{?>
	<div class="pin pin-anuncio pin-anuncio-250-400">
		<div class="pin-header pin-header-anuncio"></div>
		<?php if($listaAnuncios[$countAnuncio]->txt_url){?>
		<a href="<?= $listaAnuncios[$countAnuncio]->txt_url ?>" target="_blank">
			<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen2?>)"></div>
		</a>
		<?php }else{ ?>
			<div class="pin-content-wrapper" lang="en" style="background-image: url(<?=Url::base()?>/uploads/imagenesAnuncios/<?=$listaAnuncios[$countAnuncio]->txt_imagen2?>)"></div>
		<?php }?>
	</div>
<?php }?>
	