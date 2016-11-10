<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CatTiposUsuarios;
use app\models\EntActions;

$this->title = 'Crear Rol';
$this->icon = '<i class="ion ion-android-people"></i>';
?>

<!-- .page-cont -->
<div class="page-cont">

	<?php
	$tipoUsuarios = new CatTiposUsuarios();

	$form = ActiveForm::begin ( [ 
			'options' => [ 
					'enctype' => 'multipart/form-data' 
					],
			'id' => 'almacenar-usuarios',
			'action' => 'almacenar-usuarios'
			] );

	?>
		<div class='row'>
			
			<!-- Crear Rol -->
			<div class="cs6">

				<div class="card crear-usuario">

					<div class="card-cont">

						<div class="row">
							
							<!-- Nombre -->
							<div class="input-field col s12 m12">
								<?= $form->field($tipoUsuarios, 'txt_nombre')->textInput(['maxlength' => true,'class'=>'validate'])?>
							</div>

							<!-- Descripción -->
							<div class="input-field col s12 m12">
								<?= $form->field($tipoUsuarios, 'txt_descripcion')->textInput(['maxlength' => true, 'class'=>'validate'])?>
							</div>

							<!-- Asignar Roles -->
							<div class="col s12 m12 col-roles">
								
								<h5>Asignar roles</h5>
										
								<div class="row">

									<?php 
									$tiposActions = EntActions::find()->all();
									foreach($tiposActions as $actions){
									?>
									<div class="col s12 m6 l4 col-checkbox">

										<input type="checkbox" id="asignar-<?= $actions->txt_action ?>" value="<?= $actions->id_action ?>"/>
										<label for="asignar-<?= $actions->txt_action ?>"><?= $actions->txt_action ?></label>

										<!-- <label for="asignar-<?= $actions->txt_action ?>">Asignar</label>

										<p><?= $actions->txt_action ?></p> -->
									</div>
									<?php } ?>

								</div>
								
								
								
								<!-- <button type="button"  value="Asignar"> -->
								<button class="btn btn-submit btn-asignar waves-effect waves-light" onclick="almacenarRoles()">
									Asignar
								</button>					

							</div>

						</div>
					
					</div>

				</div>

			</div>

			<div class="col s12 12 center-align">
				<?= Html::submitButton('<span class="ladda-label">Crear</span>',['id'=>'js-btn-crear-usuarios', 'class'=>'btn btn-submit waves-effect waves-light ladda-button', 'data-style'=>'zoom-in'])?>
			</div>

		</div>
		
	<?php
	ActiveForm::end ();
	?>

		
</div>
<!-- end - .page-cont -->