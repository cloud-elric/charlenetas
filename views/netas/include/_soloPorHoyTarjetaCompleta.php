<?php 
/* @var $post EntPosts*/
?>

<?=$post->txt_descripcion?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>
http:://constitucion.com.mx<?=$post->entSoloPorHoys->num_articulo?>/<br></div>
	
<div id="js-comments">


</div>

<?php 

	echo $this->render( 'elementos/inputComentario', ['token'=>$post->txt_token]);

?>