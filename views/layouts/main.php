<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div style='border:2px solid black'>
<?php
// Si el usuario esta autenticado
if(!Yii::$app->user->isGuest){
<<<<<<< HEAD
echo Html::img(Yii::$app->params ['modUsuarios'] ['pathImageProfile'].Yii::$app->user->identity->txt_imagen);
=======
echo Html::img(Yii::$app->user->identity->getImageProfile());	
>>>>>>> master
echo Yii::$app->user->identity->nombreCompleto.'<br>';
echo Html::a('Cerrar sesión', ['site/logout']);
}?>
</div>
<?php $this->beginBody() ?>


        <?= $content ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
