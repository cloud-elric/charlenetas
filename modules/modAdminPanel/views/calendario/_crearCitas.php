<?php

$this->title = 'Agenda';
$this->icon = '<i class="ion ion-film-marker"></i>';
?>
<div class="container">
	<!-- .page-cont -->
	<div class="page-cont js-calendario" data-id="<?= Yii::$app->user->identity->id_usuario ?>">

		<div id='calendar'></div>

	</div>
	<!-- end /.page-cont -->
	
	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<div id="modalFinalizar" class="btn-floating more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in">
			<span class="ladda-label">Finalizar</span>
		</div>
	</div>
	<!-- end /.fixed-action-btn -->
</div>