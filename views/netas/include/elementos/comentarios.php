<!-- @TODO 1.0 implementar la foto del usuario dinamicamente solo si esta logeado al crear nuevo comentario-->
<!-- @TODO 2.0 implementar la foto del usuario dinamicamente para cada post-->

<div class="new-comment" id="new-comment" data-token='<?=$post->txt_token?>'>


  <!-- TODO 1.0 -->
<?php 
   echo $this->render ( 'elementos/inputComentario', [
  		'token' => $post->txt_token,
  		'respuesta'=>false
  ] );
   ?>
</div>


