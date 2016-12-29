<?php
use yii\web\View;
use app\modules\modAdminPanel\assets\ModuleAsset;
?>

<!-- .page-header -->
<div class="page-header">
	<h2 class="page-title"><i class="ion ion-android-people"></i>Clientes</h2>
</div>
<!-- end /.page-header -->

<!-- .page-cont -->
<div class="page-cont">

	<div class="row" id="js-contenedor-tarjetas">
		<?php foreach($clientes as $cliente){?>
			<div class="col s12 m6 l4" id="card_cliente_<?=$cliente->id_cliente?>">
				<div class="card card-user">
					<div class="card-user-cont">
						<div class="row">
							<div class="col s9">
								<p class="card-user-nombre"><?= $cliente->txt_nombre?></p>
								<p class="card-user-email"><?= $cliente->txt_correo?></p>
								<p class="card-user-phone"><?= $cliente->num_telefono?></p>
							</div>
						</div>
					</div>
					<div class="card-contexto-options">
						<div>
							<input type="checkbox" id="delete-<?=$cliente->id_cliente?>" value="<?=$cliente->id_cliente?>"/>
							<label class="cliente-delete-check" for="delete-<?=$cliente->id_cliente?>"></label>
						</div>
						<a id="button_<?=$cliente->id_cliente?>" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarCliente('<?=$cliente->id_cliente?>')" href="#js-modal-post-editar">
							<i class="ion ion-android-more-vertical card-edit"></i>
						</a>
					</div>
				</div>
			</div>
		<?php }?>
	</div>	
</div>	

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
