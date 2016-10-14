<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<link rel="shortcut icon" type="image/png" href="<?=Url::base()?>/favicon.png"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="animsition">
<?php $this->beginBody() ?>


        <?= $content ?>


<?php $this->endBody() ?>
</div>

<script>
  $(document).ready(function() {
    $('.animsition').animsition();
  });

  window.onbeforeunload=function(){
	  $('.animsition').animsition('out' , $('.animsition'), '');
	}
  </script>
</body>
</html>
<?php $this->endPage() ?>
