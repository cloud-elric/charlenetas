<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ent Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ent Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_post',
            'id_tipo_post',
            'id_usuario',
            'id_usuario_administrador',
            'txt_titulo',
            // 'txt_token',
            // 'txt_descripcion:ntext',
            // 'txt_imagen',
            // 'txt_url:url',
            // 'num_likes',
            // 'fch_creacion',
            // 'fch_publicacion',
            // 'b_habilitado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
