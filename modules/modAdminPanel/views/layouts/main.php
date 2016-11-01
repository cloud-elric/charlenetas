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
				<h2 class="page-title"><?=$this->icon.' '.$this->title?></h2>
			</div>
			<!-- end /.page-header -->

			<?= $content ?>
			
		</div>
		<!-- end /.page -->
		
		<!-- Footer -->
		<?php include 'footer.php'; ?>

	</div>
	<!-- end /.wrap -->
	<?=$this->render('@app/modules/modAdminPanel/views/admin/templates/modalPostFull');?>
	
	<?=$this->render('@app/modules/modAdminPanel/views/admin/templates/modalPost');?>
	
	<?=$this->render('@app/modules/modAdminPanel/views/admin/templates/modalEditar');?>
	
	<!-- Modal para crear citas en calendario -->
	<a class="modal-trigger waves-effect waves-ligth btn" href="#modal2" style="display: none">Modal</a>
	<!-- Modal structure -->
	<div id="modal2" class="modal">
		<div class="modal-content">
			<h4>Crear Cita Admin</h4>
			<form>
				<label>Cita: </label>
				<input type="text" id="nombreCita" name="nombreCita">
				<div>
					<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" id="submitButton">Guardar</button>
				</div>
			</form>
		</div>
	</div>
	
	<!-- Modal para eliminar citas en calendario -->
 	<a class="modal-trigger js-eliminar waves-effect waves-light btn" href="#modal3" style="display: none">Modal</a>

  	<!-- Modal Structure -->
  	<div id="modal3" class="modal">
    	<div class="modal-content">
      		<p>Deseas Eliminar la cita del calendario</p>
    	</div>
    	<div class="modal-footer">
      		<button type="button" id="Aceptar" value="true" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
      		<button type="button" id="Cancelar" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</button>
    	</div>
  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
