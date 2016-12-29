<?php
use yii\web\View;
use app\modules\modAdminPanel\assets\ModuleAsset;

$this->title = 'Clientes';
?>

<!-- .fixed-action-btn -->
<div class="fixed-action-btn horizontal">
	<!-- Modal Trigger -->
	<a class="btn-floating btn-large waves-effect waves-light btn-agregar modal-trigger" href="#js-modal-post" onclick='document.getElementById("form-cliente").reset();'>
		<i class="ion ion-wand"></i>
	</a>
	<a class="btn-floating btn-large waves-effect waves-light" onclick="deletePosts()">
		<i class="ion ion-ios-trash-outline"></i>
	</a>
</div>
<!-- end /.fixed-action-btn -->

<?php
$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-clientes.js'; // dynamic file added

$this->registerJs ( "
		cargarFormulario();
		$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });

", View::POS_END );
?>
