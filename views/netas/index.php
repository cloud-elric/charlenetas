<?php
use yii\web\View;
use yii\helpers\Url;
use app\models\ConstantesWeb;
use app\models\EntPosts;
?>
<?=$this->render('//layouts/header')?>
<?=$this->render('//layouts/nav', ['tiposPost'=>$tiposPost])?>

<div class=container-fluid>
	<div class="pins-grid-container">
		<div class="grid" id="js-contenedor-posts-tarjetas">

			<div class="pin pin-agregar-espejo">
				<div class="pin-header pin-header-agregar-espejo"></div>
				<div class="image">
					<img src="<?=Url::base()?>/webAssets/images/espejo.jpg">
				</div>
				<div class="pin-content-wrapper" lang="en">
					<a href="#modal-pregunta-espejo" class="btn pin-titulo"
						id="js-preguntar-espejo" <?=Yii::$app->user->isGuest?'onclick="showModalLogin();"':'onclick="agregarPregunta();"'?>>Pregunta al espejo</a>
				</div>
			</div>
			<?php
			include 'masPosts.php';
			?>
  </div>
	</div>
</div>

<?php
$postTotales = EntPosts::find()->count("id_post"); 
if($postTotales>=ConstantesWeb::PINS_A_MOSTRAR){
	# echo "Total de  posts: ". $postTotales;
?>

<div class="more-entries waves-effect waves-light btn ladda-button" data-style="zoom-in"
	id="js-cargar-mas-posts" onclick="cargarMasPosts(<?=$postTotales?>,<?=ConstantesWeb::PINS_A_MOSTRAR?>);"><span class="ladda-label">Cargar mas
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
					<!-- Tabs -->
					<div class="anim-account-tab">
						<p class="anim-account-tab-item btn-login-register active" data-account="singup">Login</p>
						<p class="anim-account-tab-item btn-login-register" data-account="login">Registrarse</p>
					</div>
					<!-- Login / SignUp -->
					<div class="account-singup" id="js-contenedor-crear-cuenta"></div>
					<div class="account-login" id="js-contenedor-login"></div>
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
<?php

if (Yii::$app->user->isGuest) {
	$this->registerJs ( "
  loadLogin();
loadSign();
$('ul.tabs').tabs();

  ", View::POS_END );
}else{
	$this->registerJs ( "
  loadEspejoPreguntar()
$('ul.tabs').tabs();	
  ", View::POS_END );
	
}

if (! empty ( $token )) {
	?>
<script>
  		showPostFull('".$token."');
  </script>
<?php
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

