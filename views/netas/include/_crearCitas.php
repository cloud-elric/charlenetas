<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;
?>

<head>
	<link rel='stylesheet' href='/fullcalendar-3.0.1/fullcalendar.css' />
	<script src='/fullcalendar-3.0.1/lib/jquery.min.js'></script>
	<script src='/fullcalendar-3.0.1/lib/moment.min.js'></script>
	<script src='/fullcalendar-3.0.1/fullcalendar.js'></script>
	
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
<?php include 'elementos/calendario.php' ?>

<?= $this->render ('//layouts/header') ?>
<div class=" container">
	<ul class="collapsible" data-collapsible="accordion">
		<li>
		<div class="collapsible-header"><i class="material-icons">view_list</i>Lista de citas</div>
		
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'options' => [
				'tag' => 'div',
				'class' => 'collapsible-body',
			],
			'emptyTextOptions'=>[
				'class'=>'empty col m6'
			],
			'summaryOptions'=>[
				'class'=>'summary col m12 right-align'
			],
			'itemOptions'=>[
				'class'=>'row'
			],
			'itemView' => function ($model, $key, $index, $widget) {
				return $this->render('_list_citas',['model' => $model]);
			}, 
			'layout'=>'{items}<div class="row">{summary}</div><div class="row"><div class="col m12 center-align">{pager}</div></div>'
		]); ?>
		
		</li>
	</ul>
</div>

<input id="fecha" type="hidden" value="">
<input id="hora1" type="hidden" value="">
<input id="hora2" type="hidden" value="">
<input id="creditos" type="hidden" value="">

<!-- .crear-cita -->
<div class="crear-cita js-crear-cita" data-id="<?= Yii::$app->user->identity->id_usuario?>">

	<h4><span>Crear cita</span></h4>
	<div id='calendar'></div>

</div>
<!-- end - .crear-cita -->

<!-- .fixed-action-btn -->
<div id="js_btn_fin" class="fixed-action-btn horizontal" data-id="0">
	<button id="modalFinalizar" class="btn-floating more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in">
		<span class="ladda-label">Finalizar</span>
	</button>
</div>
<!-- end /.fixed-action-btn -->

	<a class="modal-trigger modal-cita waves-effect waves-light btn" href="#modal1" style="display: none">Modal</a>
	<!-- Modal Structure -->
  	<div id="modal1" class="modal">
    	<div class="modal-content">
      		<h4>Crear Cita</h4>
			<form id="formUser2">
				<h5>Háblame de tí</h5>

				<div id="txt_sexo" class="input-field col s12">
					<select>
						<option name="txt_sexo" value="" disabled selected><?= $formUser ? $formUser->txt_sexo : 'Elige una opción' ?></option>
						<option name="txt_sexo" value="Hombre">Hombre</option>
						<option name="txt_sexo" value="Mujer">Mujer</option>
					</select>
					<label>Sexo</label>	
				</div>
 
				<div id="txt_genero" class="input-field col s12">
					<select>
						<option name="txt_genero" value="" disabled selected><?= $formUser ? $formUser->txt_genero : 'Elige una opción' ?></option>
						<option name="txt_genero" value="Masculino">Masculino</option>
						<option name="txt_genero" value="Femenino">Femenino</option>
						<option name="txt_genero" value="Otro">Otro</option>
					</select>
					<label>Género</label>	
				</div>

				<div id="txt_religion" class="input-field col s12">
					<select>
						<option name="txt_religion" value="" disabled selected><?= $formUser ? $formUser->txt_religion : 'Elige una opción' ?></option>
						<option name="txt_religion" value="Catolica">Catolica</option>
						<option name="txt_religion" value="Cristiana">Cristiana</option>
						<option name="txt_religion" value="Musulmana">Musulmana</option>
					</select>
					<label>Religión</label>	
				</div>
				
				<label>Estado civil</label>	
	 			<input type="text" id="txt_estado_civil" name="txt_estado_civil" value="<?= $formUser ? $formUser->txt_estado_civil : '' ?>">
				
				<label>Edad</label>	
	 			<input type="text" id="txt_edad" name="txt_edad" value="<?= $formUser ? $formUser->txt_edad : '' ?>">
				
				<label>Nacionalidad</label>	
	 			<input type="text" id="txt_nacionalidad" name="txt_nacionalidad" value="<?= $formUser ? $formUser->txt_nacionalidad : '' ?>">
				
				<label>Domicilio</label>	
	 			<input type="text" id="txt_domicilio" name="txt_domicilio" value="<?= $formUser ? $formUser->txt_domicilio : '' ?>">
				
				<label>Palabra que te define (solo una)</label>	
	 			<input type="text" id="txt_palabra" name="txt_palabra" value="<?= $formUser ? $formUser->txt_palabra : '' ?>">
				
				<label>Ocupación</label>	
	 			<input type="text" id="txt_ocupacion" name="txt_ocupacion" value="<?= $formUser ? $formUser->txt_ocupacion : '' ?>">

				<h5>Cuéntame al problema</h5>
				<label>Cual es tu pregunta?</label>	
	 			<input type="text" id="txt_pregunta" name="txt_pregunta" value="<?= $formUser ? $formUser->txt_pregunta : '' ?>">
				
				<label>Como sería el final feliz de tu pregunta?</label>	
	 			<input type="text" id="txt_final_pregunta" name="txt_final_pregunta" value="<?= $formUser ? $formUser->txt_final_pregunta : '' ?>">
				
				<div class="modal-footer">
					<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat ladda-button" data-style="zoom-in" id="submitButtonLlenar" >Aceptar</button>
					<button type="reset" class=" modal-action modal-close waves-effect waves-light btn-flat ladda-button" data-style="zoom-in" id="submitButtonCancelar" >Cancelar</button>
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

	<a class="modal-trigger modal-finalizar waves-effect waves-light btn" href="#modal3" style="display: none">Modal</a>
	<!-- Modal Structure -->
  	<div id="modal3" class="modal">
    	<div class="modal-content">
      		<p>Estas apunto de agendar una cita.</p>
			<p>Revisa tus datos.</p>
	  	</div>
		<div class="modal-footer">
			<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat ladda-button" data-style="zoom-in" id="submitFinalizarCita" >Aceptar</button>
			<button type="submit" class=" modal-action modal-close waves-effect waves-light btn-flat ladda-button" data-style="zoom-in" >Cancelar</button>
		</div>
	</div>
	
	<?php 
		$this->registerJsFile('@web/js/calendario.js',['depends' => [\app\assets\AppAsset::className()]]);
	?>

<?php //}?>

<?php include "elementos/tutorial.php" ?>

<div id="div_nuevo" style="display: none;position:fixed;top:0;left: 0;right: 0;bottom: 0;background-color: rgba(0, 0, 0, 0.39);z-index: 4;">

</div>


<a class="waves-effect waves-light btn modal-trigger"
	href="#modal-creditos" style="display: none;" id="js-modal-creditos"></a>

<div id="modal-creditos" class="modal">
	<form id="js-form-pagar">
		<input type="hidden" name="producto" value="" id="js-form-pagar-producto">
		<input type="hidden" name="formaPago" value="" id="js-form-pagar-formaPago">		
	</form>

	<div class="modal-content">
		<br>
		<div class="row">
			<div class="col m12">
				<span>
					Consigue créditos con los cuales podrás cambiar por citas o preguntas al espejo.
				</span>
			</div>
		</div>
		<div class="headers-steps">
			<div class="row">
				<div class="col m3">
					<h5 class="header-label-step header-label-step-1 active">
						Seleccionar producto
					</h5>	
				</div>
				<div class="col m3">
					<h5 class="header-label-step header-label-step-2">
						Forma de pago
					</h5>	
				</div>

				<div class="col m3">
					<h5 class="header-label-step header-label-step-3">
						Revisar información
					</h5>	
				</div>

			
			</div>
		</div>


		<div class="step step-1 active">
			<div class="row">

			<?php 
			foreach($productos as $producto){
			?>
				<div class="col m4 l4">
					<div class="card-panel teal center-align">
						<h1 class="white-text">
							<?=$producto->txt_name?>
						</h1>
						
						<p class="white-text">
							<i class="ion ion-social-usd"></i>
							<?=$producto->num_price?>
						</p>

						<p>
							<?=Html::a('Seleccionar', [''], ['class'=>'waves-effect waves-light btn blue darken-1 js-seleccionar-producto-boton', 'data-token'=>$producto->txt_product_number]);?>
						</p>
					</div>
				</div>

			<?php }?>	

			</div> 

		 </div>

		 <div class="step step-2">
		 	<div class="row">
			 	<?php 
				 foreach($formasPago as $formaPago){
				 ?>
				 <div class="col m6">
					 <div data-token="<?=$formaPago->txt_payment_type_number?>" class="img-forma-pago js-seleccinar-forma-pago" style="background-image:url('<?=Url::base()?>/images/<?=$formaPago->txt_icon_url?>')">

					 </div>
				 	
				 </div>
				 <?php }?>
			 </div>
			 <div class="row">
				 <div class="col m3 offset-m6">
					 <div class="waves-effect waves-light btn blue darken-1 js-back-step-1" >Atras</div>
				 </div>
			 </div>
		 </div>

		 <div class="step step-3">
		 	<div class="row">
				 <div class="container container-pago">
				 	<div class="progress">
     				 <div class="indeterminate"></div>
  				</div>
				 </div>
			 	
			 </div>

			  <div class="row">
				 <div class="col m3 offset-m6">
					 <div class="waves-effect waves-light btn blue darken-1 js-back-step-2" >Atras</div>
				 </div>
			 </div>
		 </div>

		 <div class="step step-4">
			<div class="row">

			 </div>
		 </div>

	</div>
</div>	

<?php

$this->registerCssFile ( '@web/css/charlenetas-custom.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		],

] );

$this->registerJsFile ( '@web/js/wizard-pago.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		],

] );

$this->registerJsFile ( '@web/plugins/printArea/jquery.PrintArea.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		],

] );

$this->registerJsFile ( 'https://openpay.s3.amazonaws.com/openpay.v1.min.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		],

] );

$this->registerJsFile ( 'https://openpay.s3.amazonaws.com/openpay-data.v1.min.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		],

] );