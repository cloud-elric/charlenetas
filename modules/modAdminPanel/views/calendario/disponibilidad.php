<?php
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
$this->title = 'Agenda';
$this->icon = '<i class="ion ion-film-marker"></i>';
?>
<style>
.ui-timepicker-wrapper {
	overflow-y: auto;
	max-height: 150px;
	width: 6.5em;
	background: #fff;
	border: 1px solid #ddd;
	-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);
	-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);
	box-shadow:0 5px 10px rgba(0,0,0,0.2);
	outline: none;
	z-index: 10001;
	margin: 0;
}

.ui-timepicker-wrapper.ui-timepicker-with-duration {
	width: 13em;
}

.ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-30,
.ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-60 {
	width: 11em;
}

.ui-timepicker-list {
	margin: 0;
	padding: 0;
	list-style: none;
}

.ui-timepicker-duration {
	margin-left: 5px; color: #888;
}

.ui-timepicker-list:hover .ui-timepicker-duration {
	color: #888;
}

.ui-timepicker-list li {
	padding: 3px 0 3px 5px;
	cursor: pointer;
	white-space: nowrap;
	color: #000;
	list-style: none;
	margin: 0;
}

.ui-timepicker-list:hover .ui-timepicker-selected {
	background: #fff; color: #000;
}

li.ui-timepicker-selected,
.ui-timepicker-list li:hover,
.ui-timepicker-list .ui-timepicker-selected:hover {
	background: #1980EC; color: #fff;
}

li.ui-timepicker-selected .ui-timepicker-duration,
.ui-timepicker-list li:hover .ui-timepicker-duration {
	color: #ccc;
}

.ui-timepicker-list li.ui-timepicker-disabled,
.ui-timepicker-list li.ui-timepicker-disabled:hover,
.ui-timepicker-list li.ui-timepicker-selected.ui-timepicker-disabled {
	color: #888;
	cursor: default;
}

.ui-timepicker-list li.ui-timepicker-disabled:hover,
.ui-timepicker-list li.ui-timepicker-selected.ui-timepicker-disabled {
	background: #f2f2f2;
}
</style>

<div class="container">
<!-- .page-cont -->
<div class="page-cont js-calendario" data-id="<?= Yii::$app->user->identity->id_usuario ?>">

	<div id='calendar'></div>

</div>
<!-- end /.page-cont -->

<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<!-- Modal Trigger -->
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post">
			<i class="ion ion-wand"></i>
		</a>
		
	</div>
	<!-- end /.fixed-action-btn -->

</div>
<?php
$bundle = ModuleAsset::register ( Yii::$app->view );


$bundle->css [] = 'https://raw.githubusercontent.com/jonthornton/jquery-timepicker/master/jquery.timepicker.css';
$bundle->js [] = 'http://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js';
$bundle->js [] = 'js/charlenetas-calendario-disponibilidad.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
      
", View::POS_END );