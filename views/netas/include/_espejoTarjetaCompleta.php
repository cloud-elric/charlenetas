<?php
use yii\helpers\Html;
use app\modules\ModUsuarios\models\Utils;
use app\models\ConstantesWeb;
use app\models\EntRespuestasEspejo;
use app\models\EntEspejos;
$usuario = $post->idUsuario;

$postEspejos = new EntEspejos();
$espejo = $postEspejos->find()->where(['id_post'=>$post->id_post])->one();
?>
<input type="hidden" id="js-token-post" value="<?=$post->txt_token?>" />
<section class="full-pin-header">

	<h2>El Espejo</h2>
	<div class="post-publisher-data">
		<div class="post-publisher">
			<?php 
			if($espejo->b_anonimo == 0){	
			?>
				<h6>Publicado por: <?=$post->idUsuario->nombreCompleto?></h6>
			<?php 
			}else{
			?>
				<h6>Publicado por: Netanauta</h6>
			<?php 
			}
			?>
			<h6><?=Utils::changeFormatDate(Html::encode($post->fch_creacion))?></h6>
		</div>

		<div class="post-publisher-avatar">
			<?=Html::img(Html::encode($usuario->getImageProfile()))?>
		</div>

	</div>

</section>

<section class="full-pin-body full-pin-body-espejo">
	<h3>
		<!--?=$post->txt_titulo?-->
	</h3>
	<p>
		<?=$post->txt_descripcion?>
	</p>

	<div class="full-pin-body-footer">
		<div class="full-pin-body-footer-sharebar">
		<div class="feedback" id="copy-button" data-clipboard-target="#link-<?=$post->txt_token?>" onClick="copiarClipboard()">
				<i class="material-icons">tab_unselected</i>
				<h6 style="opacity:0; position:fixed; width:0; height:0; overflow:overflow; top:-1px; left:-1px" id="link-<?=$post->txt_token?>"><?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>netas/index?token=<?=$post->txt_token?></h6>
			</div>
		</div>
		<div class="full-pin-body-footer-feedbacks">
			<?php
				include 'elementos/espejo-suscribir.php';
			?>
		</div>
	</div>

</section>
<?php
// Obtenemos la respuesta para el post
$respuesta = $post->entRespuestasEspejo;

// Si el admin ya  contesto la pregunta
if (! empty ( $respuesta )) {
	?>

<section class="full-pin-respuesta">


	<?php

	include 'elementos/respuesta-admin.php';?>

</section>
<?php }else{
	$respuesta = new EntRespuestasEspejo();
}

?>
