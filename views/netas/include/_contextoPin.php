<?php

use app\modules\ModUsuarios\models\Utils;

?>

 <div class="pin pin-contexto" onclick="showPostFull('<?=$post->txt_token?>')">
 	<div class="pin-header pin-header-contexto"></div>
 	<div class="image">
 		<img src="assets/images/<?=$post->txt_imagen?>">
 	</div>
 	<div class="pin-content-wrapper" lang="en">
 		<h3 class="pin-titulo">
 			<?=$post->txt_titulo?>
 		</h3>
 		<p class="pin-descripcion">
 			<?=Utils::subStrTexto($post->txt_descripcion, 500)?>
 		</p>
 	</div>
  <?php
    include 'elementos/pins-social.php';
  ?>
 	<!--?=$post->fch_creacion?-->
 </div>
