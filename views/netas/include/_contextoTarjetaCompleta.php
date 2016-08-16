<?php 
/* @var $post EntPosts*/
?>
<div class="pin">
<h1>Contexto</h1>
<?=$post->txt_descripcion?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>
<?php
include '_comentariosRespuestasPost.php';
?>
</div>

