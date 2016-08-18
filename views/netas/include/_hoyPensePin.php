<?php 
use app\modules\ModUsuarios\models\Utils;

/* @var $post EntPosts*/
?>

<div onclick="showPostFull('<?=$post->txt_token?>')" class=pin>
	<div class=image>
		<img data-src="images/8675367f.image5.jpg">
	</div>
	<div class=description><?=$post->txt_titulo?><br>
<?=Utils::subStrTexto($post->txt_descripcion, 500)?><br><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>
</div>
	<div class=credits>Sample credits</div>

</div>

<!-- <div class="pin"> -->
<!-- <h1>Hoy pense</h1> 

 </div> -->

