<?php
use yii\web\View;
use yii\helpers\Url;
use app\models\ConstantesWeb;
use app\models\EntPosts;
use app\models\ModUsuariosEntUsuarios;
use yii\helpers\Html;

$this->title = 'Charlenetas';
?>
<?=$this->render('//layouts/header')?>
<?=$this->render('//layouts/nav', ['tiposPost'=>$tiposPost])?>

<div class="container-fluid">
	<div class="pins-grid-container">
		<div class="grid" id="js-contenedor-posts-tarjetas">

			<?php
			if (!Yii::$app->user->isGuest) {
				$idUser = Yii::$app->user->identity->id_usuario;
				$idTipo = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$idUser])->one();
				
				if($idTipo->id_tipo_usuario == 2){
			
					include 'masPosts.php';
				}else{
			?>
					<div id="js-creador-espejo" class="pin pin-agregar-espejo">
						<div class="pin-header pin-header-agregar-espejo"></div>
						<div class="image">
							<img src="<?=Url::base()?>/webAssets/images/espejo.png">
						</div>
						<div class="pin-content-wrapper" lang="en">
							<a href="#modal-pregunta-espejo" class="btn pin-titulo"
								id="js-preguntar-espejo" <?=Yii::$app->user->isGuest?'onclick="showModalLogin();"':'onclick="agregarPregunta();"'?>>Pregunta al espejo</a>
						</div>
					</div>
			<?php 
					include 'masPosts.php';
				}
			}else{
			?>
				<div class="pin pin-agregar-espejo">
						<div class="pin-header pin-header-agregar-espejo"></div>
						<div class="image">
							<img src="<?=Url::base()?>/webAssets/images/espejo.png">
						</div>
						<div class="pin-content-wrapper" lang="en">
							<a href="#modal-pregunta-espejo" class="btn pin-titulo"
								id="js-preguntar-espejo" <?=Yii::$app->user->isGuest?'onclick="showModalLogin();"':'onclick="agregarPregunta();"'?>>Pregunta al espejo</a>
						</div>
					</div>
			<?php
					include 'masPosts.php';
					
					
					//foreach($listaAnuncios as $anuncio){
			?>
						
			<?php 
					//}
					
					
			}
			?>
  </div>
	</div>
</div>

<?php

$postTotales = EntPosts::find()->Where(['b_habilitado'=>1])->count("id_post"); 
//echo $postTotales;
if($postTotales>ConstantesWeb::PINS_A_MOSTRAR){

?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::PINS_A_MOSTRAR?>)"><span class="ladda-label">Cargar mas 
	entradas...<label>(<?=$postTotales - ConstantesWeb::PINS_A_MOSTRAR?>)</label></span></div>

<?php
}
?>

<div id="js-tmp" style="display: none;"></div>

<div id="backScreen">
	<div id="wrapper" style="height:100%">
		<i onclick="hidePostFull()" class="icon-close"></i>
		<div id="js-content" class="full-pin-content">
			<div style="
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    position: relative;
">
<div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>

  </div>
		
		</div>
	</div>
</div>
<!-- Modal Structure -->
<div id="modal-login" class="modal modal-login-register">
	<div class="modal-content">

		<section class="wrap">

			<!-- .section -->
			<section class="section">

				<div class="sing-up"><h4>¿Ya tienes una cuenta?</h4>

					<p>Logueate usando tu Email y contraseña con la cual te
						registraste.</p>
					
					<div class="btn btn-login-register" data-account="singup">Login</div>
				</div>
				<div class="login">
				<h4>¿No tienes una cuenta?</h4>
					<p>Registrate es gratis ahora y siempre.</p>
					<div class="btn btn-login-register" data-account="login">Registrarse</div>
				</div>

				<div class="anim-account">
					<div class="green darken-1" id="js-message-sign-up"
						style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; padding: 40px 30px; color: white; ">
						<h1>Activa tu cuenta.</h1>
						<p style="color: white;">Para activar tu cuenta se ha enviado un
							correo electronico a la dirección proporcionada.</p>
					</div>
					<div class="green darken-1" id="js-message-recovery"
						style="display:none;position: absolute; width: 100%; height: 100%; top: 0; left: 0; padding: 40px 30px; color: white; ">
						<h1>Revisa tu email.</h1>
						<p style="color: white;">Se ha enviado a la dirección proporcionada un link para recuperar su password.</p>
					</div>
					<!-- Close -->
					<span class="anim-account-close"><i class="icon-close"></i></span>
					<!-- Tabs -->
					<div class="anim-account-tab">
						<p class="anim-account-tab-item btn-login-register active" data-account="singup">Login</p>
						<p class="anim-account-tab-item btn-login-register" data-account="login">Registrarse</p>
						
					</div>
					<!-- Login / SignUp -->
					<div class="account-singup" id="js-contenedor-crear-cuenta"></div>
					<div class="account-login" id="js-contenedor-login"></div>
					<div class="account-recovery-pass" style="display:none;" id="js-contenedor-recovery"></div>
					<div class="account-activar" style="display:none;" id="js-contenedor-activar"></div>
				</div>
			</section>
			<!-- end / .section -->
		</section>
	</div>
</div>

<!-- Modal para pregunta en el espejo-->

<div id="modal-pregunta-espejo" class="modal">
	<div class="modal-content">

	</div>
</div>

<a class="waves-effect waves-light btn modal-trigger"
	href="#modal-login" style="display: none;" id="js-modal-lgoin-con"></a>


<a class="waves-effect waves-light btn modal-trigger"
	href="#modal-pregunta-espejo" style="display: none;" id="js-modal-espejo"></a>



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

if (Yii::$app->user->isGuest) {
	$this->registerJs ( "
  loadLogin();
loadSign();
loadRecuperarPass();
loadReenviarEmailActivacion();
$('ul.tabs').tabs();

  ", View::POS_END );
}else{
	$this->registerJs ( "
  loadEspejoPreguntar()
$('ul.tabs').tabs();	
  ", View::POS_END );
	
}

if (! empty ( $token )) {
	$this->registerJs ( "
  		showPostFull('".$token."');
	", View::POS_END, 'mostarPost' );
}
?>

<?php
$isCuentaActivada = Yii::$app->session->getFlash ( 'cuentaActivada' );
if (! empty ($isCuentaActivada)) {
	$this->registerJs ( "
  		mensajeCuentaActivada('".Yii::$app->session->getFlash ( 'cuentaActivada' )."');
	", View::POS_END, 'cuentaActivada' );
}
?>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>


<?php 

include "include/elementos/tutorial.php";

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

?>

 