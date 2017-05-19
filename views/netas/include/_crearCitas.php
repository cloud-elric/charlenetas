<?php
use yii\helpers\Url;
?>

<head>
	<link rel='stylesheet' href='/fullcalendar-3.0.1/fullcalendar.css' />
	<script src='/fullcalendar-3.0.1/lib/jquery.min.js'></script>
	<script src='/fullcalendar-3.0.1/lib/moment.min.js'></script>
	<script src='/fullcalendar-3.0.1/fullcalendar.js'></script>
	
	<style>

		body {
			margin: 40px 10px;
			padding: 0;
			font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
			font-size: 14px;
		}

		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}

	</style>
</head>
<script>var valForm = <?= $formUser?1:0 ?> </script>
<?php include 'elementos/calendario.php'?>

<?= $this->render ('//layouts/header') ?>

<!-- .crear-cita -->
<div class="crear-cita js-crear-cita" data-id="<?= Yii::$app->user->identity->id_usuario?>">

	<h4><span>Crear cita</span></h4>
	<div id='calendar'></div>

</div>
<!-- end - .crear-cita -->


<?php //if($creditos->numero_creditos > 0){ ?>

	<!-- <div id='calendar'></div>
	<br/> -->
	
	<a class="modal-trigger modal-cita waves-effect waves-light btn" href="#modal1" style="display: none">Modal</a>
	<!-- Modal Structure -->
  	<div id="modal1" class="modal">
    	<div class="modal-content">
      		<h4>Crear Cita</h4>
			<form id="formUser2">
				<h5>Llenar formulario </h5>
				<label>Campo1</label>	
	 			<input type="text" id="Campo1" name="Campo1" value="<?= $formUser ? $formUser->txt_campo1 : '' ?>">
				<label>Campo2</label>	
	 			<input type="text" id="Campo2" name="Campo2" value="<?= $formUser ? $formUser->txt_campo2 : '' ?>">
				<label>Campo3</label>	
	 			<input type="text" id="Campo3" name="Campo3" value="<?= $formUser ? $formUser->txt_campo3 : '' ?>">
				<div class="modal-footer">
					<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat" id="submitButtonLlenar" >Aceptar</button>
					<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat" id="submitButtonCancelar" >Cancelar</button>
				</div>
			</form>
	  	</div>
	</div>

	<a class="modal-trigger modal-creditos waves-effect waves-light btn" href="#modal2" style="display: none">Modal</a>
	<!-- Modal Structure -->
  	<div id="modal2" class="modal">
    	<div class="modal-content">
      		<h4>No tienes los creditos suficientes</h4>
	  	</div>
	</div>
	
	<?php 
		$this->registerJsFile('@web/js/calendario.js',['depends' => [\app\assets\AppAsset::className()]]);
	?>

<?php //}?>

<?php include "elementos/tutorial.php"?>
