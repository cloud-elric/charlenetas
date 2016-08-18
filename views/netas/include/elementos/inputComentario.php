<?php
use yii\widgets\ActiveForm;
use app\models\EntComentariosPosts;

$comentario = new EntComentariosPosts();

$form = ActiveForm::begin([
    'id' => 'js-comentario-form-'.$token,
]) ?>
    <?= $form->field($comentario, 'txt_comentario')->textArea(['rows'=>3]) ?>
	
	<div id="js-comentar" style='border:1px solid black;' onclick="enviarComentario('<?=$token?>');">Comentar</div>
		
<?php ActiveForm::end() ?>



</form>
</div>