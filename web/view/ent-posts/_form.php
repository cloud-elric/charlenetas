<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ent-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tipo_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_usuario_administrador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'txt_imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txt_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_likes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fch_creacion')->textInput() ?>

    <?= $form->field($model, 'fch_publicacion')->textInput() ?>

    <?= $form->field($model, 'b_habilitado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
