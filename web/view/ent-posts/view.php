<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EntPosts */

$this->title = $model->id_post;
$this->params['breadcrumbs'][] = ['label' => 'Ent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_post], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_post], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_post',
            'id_tipo_post',
            'id_usuario',
            'id_usuario_administrador',
            'txt_titulo',
            'txt_token',
            'txt_descripcion:ntext',
            'txt_imagen',
            'txt_url:url',
            'num_likes',
            'fch_creacion',
            'fch_publicacion',
            'b_habilitado',
        ],
    ]) ?>

</div>
