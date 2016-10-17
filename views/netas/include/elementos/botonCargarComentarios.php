<?php
use yii\helpers\Html;
use app\models\EntComentariosPosts;
use app\models\ConstantesWeb;
?>
<div id="js-cargar-comentarios" class="comentarios-cargar-comentarios"
	onclick="cargarComentarios('<?=Html::encode($post->txt_token)?>', false)">
	<p>
		<span>Cargar más comentarios...<label>(0)</label></span><i
			class="icon icon icon-comment"></i>
	</p>
</div>

<script>
var numComentarios = <?= EntComentariosPosts::find()->where(['id_post'=>$post->id_post])->andWhere(['is', 'id_comentario_padre',null])->count("id_post") ?>;
var comentariosShow = <?=ConstantesWeb::COMENTARIOS_A_MOSTRAR?>;
var comentariosRestantes = numComentarios-comentariosShow;
if(comentariosRestantes < 1){
	$('#js-cargar-comentarios').remove();
}

</script>