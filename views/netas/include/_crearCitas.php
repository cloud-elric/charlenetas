
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
	<?php 
		$this->registerJsFile('@web/js/calendario.js',['depends' => [\app\assets\AppAsset::className()]]);
	?>

<?php //}?>
