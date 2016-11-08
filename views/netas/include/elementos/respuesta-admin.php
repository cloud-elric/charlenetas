<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;


	?>

<div class="respuesta-header">
	<div class="post-publisher-data">
		<div class="post-publisher">
			<h6>Publicado por: Charlene</h6>
			<h6><?=Utils::changeFormatDate(Html::encode($respuesta->fch_publicacion_respuesta))?></h6>
		</div>

		<div class="post-publisher-avatar">
      <?=Html::img ( $respuesta->idUsuarioAdmin->getImageProfile (), [ 'width' => '27px','alt'=>'Avatar de NetaAdmin que respondio en el Espejo'] )?>
		</div>

	</div>
</div>

<?php
	if ($respuesta) {
		?>
<div class="respuesta-body">
	<div class="respuesta">
		<?=Html::encode($respuesta->txt_respuesta)?>
  </div>
</div>

<div class="respuesta-footer">

	<?php if(!Yii::$app->user->isGuest && $respuesta->idPost->idPost->id_usuario == Yii::$app->user->identity->id_usuario){?>
	
		<div class="me-gusta" onclick='agregarAcuerdo("<?=$respuesta->idPost->idPost->txt_token?>",1)'>
			<input type="button" value="Me gusta"/>
		</div>
		<div class="no-me-gusta" onclick='agregarAcuerdo("<?=$respuesta->idPost->idPost->txt_token?>",0)'>
			<input type="button" value="No me gusta"/>
		</div>
	<?php }?>
		
<!-- 	<div class="respuesta-feedbacks"> -->
<!-- 		<div class="feedback"> -->
<!-- 			<i class="icon icon-thumbs-up"></i> <span>345</span> -->
<!-- 		</div> -->
<!-- 	</div> -->

</div>

<?php
		// Este dato imprime 1 si el usuario quien pregunto esta de acuerdo con la respuesta y 0 para no estar de acuerdo
		echo Html::encode ( $respuesta->b_de_acuerdo ) . '<br>';
	} else {
		echo 'Pregunta no contestada aún';
	}
?>
