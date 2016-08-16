<?php 
/* @var $post EntPosts*/
?>
<div class="pin">
<h1>Verdadazos</h1>
<?=$post->num_likes?><br>
<?=$post->txt_imagen?><br>
<?=$post->fch_publicacion?><br>
<?=$post->txt_descripcion?><br>
<?php
include '_comentariosRespuestasPost.php';
?>
</div>

