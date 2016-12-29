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
    <script> var basePath = '<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>'; </script>
    
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
	<a class="modal-trigger js-crear waves-effect waves-ligth btn" href="#modal2" style="display: none">Modal</a>
	<!-- Modal structure -->
	<div id="modal2" class="modal">
		<div class="modal-content">
			<h4>Crear <span>Cita</span></h4>
			<form>
				<div class="row">
					<div class="col s12 m12">
						
						<label>Cita: </label>
						<input type="text" id="nombreCita" name="nombreCita">
						<div>
							<button type="submit" class="btn btn-submit waves-effect" id="submitButton">Guardar</button>
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>
	
	<!-- Modal para eliminar citas en calendario -->
 	<a class="modal-trigger js-eliminar waves-effect waves-light btn" href="#modal3" style="display: none">Modal</a>

  	<!-- Modal Structure -->
  	<div id="modal3" class="modal modal-calendario">
    	<div class="modal-content">
      		<h4><span>Deseas</span> Eliminar <span>la cita del calendario</span></h4>
    	</div>
    	<div class="modal-footer">
      		<button type="button" id="Cancelar" class="btn btn-submit modal-footer-btn-cancelar waves-effect">Cancelar</button>
      		<button type="button" id="Aceptar" value="true" class="btn btn-submit modal-footer-btn-aceptar waves-effect">Aceptar</button>
    	</div>
  </div>
  
    <!-- Modal para eliminar post en adminPanel -->
 	<a class="modal-trigger js-eliminar-post waves-effect waves-light btn" href="#modal4" style="display: none">Modal</a>
  
    <!-- Modal Structure -->
  	<div id="modal4" class="modal modal-eliminar-post">
    	<div class="modal-content">
      		<h4><span>Deseas</span> Eliminar <span>el post</span></h4>
    	</div>
    	<div class="modal-footer">
      		<button type="button" id="Cancelar-post" class="btn btn-submit modal-footer-btn-cancelar waves-effect">Cancelar</button>
      		<button type="button" id="Aceptar-post" value="true" class="btn btn-submit modal-footer-btn-aceptar waves-effect">Aceptar</button>
    	</div>
  	</div>
  	
  	<!-- Modal para eliminar clientes en adminPanel -->
 	<a class="modal-trigger js-eliminar-cliente waves-effect waves-light btn" href="#modal5" style="display: none">Modal</a>
  
    <!-- Modal Structure -->
  	<div id="modal5" class="modal modal-eliminar-cliente">
    	<div class="modal-content">
      		<h4><span>Deseas</span> Eliminar <span>el cliente</span></h4>
    	</div>
    	<div class="modal-footer">
      		<button type="button" id="Cancelar-cliente" class="btn btn-submit modal-footer-btn-cancelar waves-effect">Cancelar</button>
      		<button type="button" id="Aceptar-cliente" value="true" class="btn btn-submit modal-footer-btn-aceptar waves-effect">Aceptar</button>
    	</div>
  	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
