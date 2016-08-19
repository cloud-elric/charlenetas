<?php
/* @var $post EntPosts*/
?>

<div class="pin pin-espejo" onclick="showPostFull('<?=$post->txt_token?>')">

	<div class="pin-header pin-header-espejo"></div>

	<div class=image>
		<img data-src="assets/images/<?=$post->txt_imagen?>">
	</div>


<div class="pin-content-wrapper" lang="en">
	<p class="pin-descripcion">
		<?=$post->txt_descripcion?>
	</p>
</div>



<div class="pin-social">

	<div class="pin-social-usr">
		<img src="assets/images/usr-avatar.png" alt="" />
		<span>Alfie<!--?=$post->idUsuario->txt_imagen?--></span>
	</div>
	<div class="pin-social-interactions">
		<span><?=$post->entEspejos->num_subscriptores?></span>
		<i class="glyphicon glyphicon-thumbs-up margin-right-20"></i>
		<span>45</span>
		<i class="glyphicon glyphicon-comment"></i>
	</div>

</div>

</div>
