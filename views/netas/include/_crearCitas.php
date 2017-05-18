<?php
use yii\helpers\Url;
?>

<head>
	<link rel='stylesheet' href='/fullcalendar-3.0.1/fullcalendar.css' />
	<script src='/fullcalendar-3.0.1/lib/jquery.min.js'></script>
	<script src='/fullcalendar-3.0.1/lib/moment.min.js'></script>
	<script src='/fullcalendar-3.0.1/fullcalendar.js'></script>
	
	<style>

		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}

	</style>
</head>

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
      		<form>
				<h5>Se creara una cita </h5>
<!-- 				<input type="text" id="nombreCita" name="nombreCita"> -->
				<div class="modal-footer">
					<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat" id="submitButton" >Aceptar</button>
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
