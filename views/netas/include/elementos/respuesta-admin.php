<?php
// Obtenemos la respuesta para el post
$respuesta = $post->entRespuestasEspejo;

// Si ya se contesto la pregunta
if (! empty ( $respuesta )) {
	echo $respuesta->txt_respuesta . '<br>';
	echo $respuesta->fch_publicacion_respuesta . '<br>';

	// Este dato imprime 1 si el usuario quien pregunto esta de acuerdo con la respuesta y 0 para no estar de acuerdo
	echo $respuesta->b_de_acuerdo . '<br>';
} else {
	echo 'Pregunta no contestada aún';
}
?>


<div class="respuesta-header">
  <div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=$post->fch_publicacion_respuesta?></h6>
		</div>

		<div class="post-publisher-avatar">
      <img src="assets/images/usr-avatar.png" alt="Avatar de NetaAdmin que respondio en el Espejo" />
		</div>

	</div>
</div>

<div class="respuesta-body">
  <div class="comment">

  </div>
</div>

<div class="respuesta-footer">
  <div class="respuesta-feedbacks">
    <div class="feedback">
      <i class="icon icon-thumbs-up"></i>
      <span>345</span>
    </div>
  </div>

</div>
