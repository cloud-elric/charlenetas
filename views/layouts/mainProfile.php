<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAssetProfile;

AppAssetProfile::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

	<script> var basePath = '<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>'; </script>

	<link rel="shortcut icon" type="image/png" href="<?=Url::base()?>/favicon.png"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-profile">

<?php $this->beginBody() ?>


        <?= $content ?>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
