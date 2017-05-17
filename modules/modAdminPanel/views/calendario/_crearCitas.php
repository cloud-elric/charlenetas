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

</div>