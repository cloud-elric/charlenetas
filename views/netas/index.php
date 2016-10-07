<?php
use yii\web\View;
use yii\helpers\Url;
?>
<?=$this->render('//layouts/header')?>
<?=$this->render('//layouts/nav', ['tiposPost'=>$tiposPost])?>

<div class=container-fluid>
	<div class="pins-grid-container">
		<div class="grid" id="js-contenedor-posts-tarjetas">

			<div class="pin pin-agregar-espejo">
				<div class="pin-header pin-header-agregar-espejo"></div>
				<div class="image">
					<img src="<?=Url::base()?>/webAssets/images/espejo.png">
				</div>
				<div class="pin-content-wrapper" lang="en">
					<a href="#modal-pregunta-espejo" class="btn pin-titulo"
						id="js-preguntar-espejo">Pregunta al espejo</a>
				</div>
			</div>
			<?php
			include 'masPosts.php';
			?>
  </div>
	</div>
</div>

<div class="more-entries waves-effect waves-light btn"
	id="js-cargar-mas-posts" onclick="cargarMasPosts();">Cargar mas
	entradas</div>

<div id="js-tmp" style="display: none;"></div>

<div id="backScreen">
	<div id="wrapper">
		<i onclick="hidePostFull()" class="icon-close"></i>
		<div id="js-content" class="full-pin-content"></div>
	</div>
</div>
<!-- Modal Structure -->
<div id="modal-login" class="modal modal-login-register">
	<div class="modal-content">

		<section class="wrap">

			<!-- .section -->
			<section class="section">
				
				<div class="sing-up">
					<h4>¿Ya tienes una cuenta?</h4>

					<p>Logueate usando tu Email y contraseña con la cual te
						registraste.</p>
					<div class="btn btn-login-register" data-account="singup">Login</div>
				</div>
				<div class="login">
					<h4>¿No tienes una cuenta?</h4>
					<p>Registrate es gratis ahora y siempre.</p>
					<div class="btn btn-login-register" data-account="login">Sing Up</div>
				</div>

				<div class="anim-account">
				<div class="green darken-1" id="js-message-sign-up" style="
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    padding: 40px 30px;
    color:white;
    display:none;                              
">
  <h1>Activa tu cuenta.</h1><p style="color:white;">Para activar tu cuenta se ha enviado un correo electronico a la dirección proporcionada.</p>
</div>
					<div class="account-singup" id="js-contenedor-crear-cuenta"></div>
					<div class="account-login" id="js-contenedor-login"></div>
				</div>
			</section>
			<!-- end / .section -->
		</section>
	</div>
</div>

<!-- <!-- Modal para pregunta en el espejo -->
-->
<!-- <div id="modal-pregunta-espejo" class="modal"> -->
<!-- 	<div class="modal-content"> -->

<!-- 	</div> -->
<!-- </div> -->

<a class="waves-effect waves-light btn modal-trigger"
	href="#modal-login" style="display: none;"></a>

<?php

$this->registerJs ( "
//loadEspejoPreguntar();
  ", View::POS_END, 'espejo' );

if (Yii::$app->user->isGuest) {
	$this->registerJs ( "
  loadLogin();
loadSign();
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

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

