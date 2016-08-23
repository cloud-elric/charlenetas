<?php
/* @var $post EntPosts*/
?>
<h1>Verdadazos</h1>
<?=$post->num_likes?><br>
<?=$post->txt_imagen?><br>
<?=$post->fch_publicacion?><br>
<?=$post->txt_descripcion?><br>

<div id="js-comments"></div>

<?php
echo $this->render ( 'elementos/inputComentario', [ 
		'token' => $post->txt_token,
		'respuesta'=>false 
] );
?>
