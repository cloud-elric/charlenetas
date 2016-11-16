<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;

$classInputComentario = 'js-reply-comentario';
$dataTokenReply = 'data-token="' . $comentario->txt_token . '"';
?>

<div class="comment">
	<div class="comment-header">
		<!-- TODO 2.0 implementar la foto del usuario dinamicamente -->
		<div class="comment-usr">
      		<?=Html::img ( $comentario->idUsuario->getImageProfile (), [ 'width' => '50px' ] )?>
      		<h5><?=$comentario->idUsuario->txt_username?></h5>
		</div>
		<div class="comment-date">
			<h6><?=Utils::changeFormatDate(Html::encode($comentario->fch_comentario))?></h6>
		</div>
	</div>
	<div class="comment-body">
		<p>
       		<?=$comentario->txt_comentario?>
    	</p>
	</div>



	<div class="comment-footer">


		<?php if(!$respuesta){?>
		<div class="new-comment <?=$classInputComentario?>"
			<?=$dataTokenReply?>>
	   			<?php
			echo $this->render ( 'inputComentario', [
					'token' => $comentario->txt_token,
					'respuesta' => true
			] );
			?>
		</div>
		<?php

}
		?>
    <div class="comment-feedbacks">
   	 		<?php
   	 		include 'feedbacks-comentario.php';
   	 		?>
    </div>
	</div>

  <?php if(!$respuesta){?>
  <div class="comment-reply"
		id="js-respuestas-comentario-<?=$comentario->txt_token?>"></div>

	<div id="js-cargar-mas-respuestas-<?=$comentario->txt_token?>" class="comentarios-cargar-comentarios" data-token='<?=$comentario->txt_token?>' onclick="cargarRespuestasPage($(this))">
	<?php if($comentario->entComentariosPosts){?>
		<p>
			<span>Cargar mas respuestas...</span><i class="icon icon icon-comment"></i>
		</p>
	<?php }?>	
	</div>

	<input type="hidden" id='js-page-respuesta-<?=$comentario->txt_token?>'  value='0'/>
	<script>
		cargarRespuestas('<?=$comentario->txt_token?>', 0);
	</script>

	<?php }?>

</div>
