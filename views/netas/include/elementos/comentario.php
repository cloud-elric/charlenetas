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
		<a class="waves-effect waves-light btn btn-secondary">Responder</a>
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
							foreach ( $feedbacks as $feedback ) {
								
								// did-usr-interact
								if (Yii::$app->user->isGuest) {
									$onclick = 'showModalLogin();';
								} else {
									$onclick = 'agregarFeedback("' . $comentario->txt_token . '","' . $feedback->txt_token . '");';
								}
								
								switch ($feedback->id_tipo_feedback) {
									case 1 : // like
										$numFeed = $comentario->num_likes;
										$icon = "icon-thumbs-up";
										break;
									case 2 : // no like
										$numFeed = $comentario->num_dislikes;
										$icon = "icon-thumbs-down";
										break;
									case 3 : // troll
										$numFeed = $comentario->num_trolls;
										$icon = "icon-trollface";
										break;
									default :
										$numFeed = '0';
										break;
								}
								?>
     		 <div class="feedback js-feedback js-feedback-<?=$comentario->txt_token?>" onclick='<?=$onclick?>'
				data-token='<?=$comentario->txt_token?>'
				data-tfb='<?=$feedback->txt_token?>'>
				<i class="icon <?=$icon?>"></i> <span
					id='js-contador-<?=$comentario->txt_token?>-<?=$feedback->txt_token?>'><?=$numFeed?></span>
			</div>
      <?php }?>
    </div>
	</div>
  
  <?php if(!$respuesta){?>
  <div class="comment-reply"
		id="js-respuestas-comentario-<?=$comentario->txt_token?>"></div>

	<div id="js-cargar-mas-respuestas-<?=$comentario->txt_token?>" data-token='<?=$comentario->txt_token?>' onclick="cargarRespuestasPage($(this))">Cargar mas respuestas</div>
	
	<input type="hidden" id='js-page-respuesta-<?=$comentario->txt_token?>'  value='0'/>	
	<script>
		cargarRespuestas('<?=$comentario->txt_token?>', 0);
	</script>

	<?php }?>

</div>


