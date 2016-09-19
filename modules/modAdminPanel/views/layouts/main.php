<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use app\modules\modAdminPanel\assets\ModuleAsset;

ModuleAsset::register($this);

$bundle = ModuleAsset::register ( Yii::$app->view );
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
<?php $this->beginBody() ?>

	<!-- .loader -->
	<div class="loader"><img src="<?= $bundle->baseUrl?>/imgs/loader.gif" alt="Loader"></div>
	
	<!-- .wrap -->
	<div class="wrap">
		
		<!-- Header -->
		<?php include 'header.php'; ?>
		
		<!-- Nav -->
		<?php include 'nav.php'; ?>
		
		<!-- .page -->
		<div class="page">

			
			<!-- .page-header -->
			<div class="page-header">
				<h2 class="page-title"><i class="ion ion-home"></i><?=$this->title?></h2>
			</div>
			<!-- end /.page-header -->
			<?= $content ?>
			
		</div>
		<!-- end /.page -->
		
		<!-- Footer -->
		<?php include 'footer.php'; ?>

	</div>
	<!-- end /.wrap -->
	
	<?=$this->render('@app/modules/modAdminPanel/views/admin/templates/modalPost');?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
