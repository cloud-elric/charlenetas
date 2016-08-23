
<h1>Alquimia</h1>

<?=$post->txt_titulo?><br>
<?=$post->txt_descripcion?><br>

<?=$post->id_usuario_administrador?><br>
<?=$post->fch_creacion?><br>
<?=$post->txt_imagen?><br>
<?=$post->entAlquimias->num_calificacion_admin?><br>
<?=$post->entAlquimias->num_calificacion_usuario?><br>

<div id="js-comments"></div>

<?php

echo $this->render ( 'elementos/inputComentario', [ 
		'token' => $post->txt_token,
		'respuesta'=>false
] );

?>