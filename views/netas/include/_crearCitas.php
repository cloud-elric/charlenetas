
<head>
	
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



<?= $this->render ('//layouts/header') ?>

<?php //if($creditos->numero_creditos > 0){ ?>
	<h4><span>Crear cita</span></h4>

	<div id='calendar'></div>
	<br/>
	
	<a class="modal-trigger waves-effect waves-light btn" href="#modal1" style="display: none">Modal</a>
	<!-- Modal Structure -->
  	<div id="modal1" class="modal">
    	<div class="modal-content">
      		<h4>Crear Cita</h4>
      		<form>
				<label>Cita: </label>
				<input type="text" id="nombreCita" name="nombreCita">
				<div class="modal-footer">
					<button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat" id="submitButton" >Guardar</button>
				</div>
	  		</form>
	  	</div>
	</div>
	
	<?php 
		$this->registerJsFile('@web/js/calendario.js',['depends' => [\app\assets\AppAsset::className()]]);
	?>

<?php //}?>
