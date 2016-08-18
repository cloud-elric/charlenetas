<?php 
/* @var $post EntPosts*/
?>
<h1>Hoy pense</h1>
<?=$post->txt_titulo?><br>
<?=$post->txt_descripcion?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>

<div id="js-comments">


</div>

<?php 

	echo $this->render( 'elementos/inputComentario', ['token'=>$post->txt_token]);

?>