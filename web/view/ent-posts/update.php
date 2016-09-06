<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntPosts */

$this->title = 'Update Ent Posts: ' . $model->id_post;
$this->params['breadcrumbs'][] = ['label' => 'Ent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_post, 'url' => ['view', 'id' => $model->id_post]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ent-posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
