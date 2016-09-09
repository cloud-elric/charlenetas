<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntPosts */

$this->title = 'Create Ent Posts';
$this->params['breadcrumbs'][] = ['label' => 'Ent Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
