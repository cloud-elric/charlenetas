<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CatTiposUsuarios;
use app\models\EntActions;
?>

<h4>Crear Usuarios</h4>

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

		<?= $form->field($tipoUsuarios, 'txt_nombre')->textInput(['maxlength' => true])?>

		<?= $form->field($tipoUsuarios, 'txt_descripcion')->textInput(['maxlength' => true])?>
	</div>
	
	<?= Html::submitButton('<span class="ladda-label">Crear</span>',['id'=>'js-btn-crear-usuarios', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'data-style'=>'zoom-in'])?>

	<h4>Asignar roles</h4>
	<?php 
	$tiposActions = EntActions::find()->all();
	foreach($tiposActions as $actions){
	?>
	<div>
		<div>
			<p>
   		 		<input type="checkbox" id="asignar-<?= $actions->txt_action ?>" value="<?= $actions->id_action ?>"/>
    			<label for="asignar-<?= $actions->txt_action ?>">Asignar</label>
  			</p>
		</div>
		<div>
			<?= $actions->txt_action ?>
		</div>
	</div>
	
	<div>
		<button onclick="almacenarRoles()"Crear</button>
	</div>
	
	<?php } ?>
	
<?php
ActiveForm::end ();
?>
