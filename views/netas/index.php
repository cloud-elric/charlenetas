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
					<h3 class="pin-titulo">Agrega espejo (Corregir texto)</h3>
					<p class="pin-descripcion">Descripción (Corregir texto)</p>

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
		
<!-- 		<ul class="tabs"> -->
<!-- 			<li class="tab col s3"><a class="active" href="#js-contenedor-login">Iniciar sesión</a></li> -->
<!-- 			<li class="tab col s3"><a href="#js-contenedor-crear-cuenta">Registrarse</a></li> -->
<!-- 		</ul> -->
		
<!-- 			<div id="js-contenedor-login"> -->
<!-- 			</div> -->
<!-- 			<div id="js-contenedor-crear-cuenta"> -->
<!-- 			:D -->
<!-- 			</div> -->

<section class="wrap">

			<!-- .section -->
			<section class="section">
				<div class="sing-up">
					<h4>¿No tienes una cuenta?</h4>
					<p>
						Registrate es gratis ahora y siempre.
					</p>
					<div class="btn btn-login-register" data-account="singup">Sing Up</div>
				</div>
				<div class="login">
					<h4>¿Ya tienes una cuenta?</h4>
					<p>
						Logueate usando tu Email y contraseña con la cual te registraste.
					</p>
					<div class="btn btn-login-register" data-account="login">Login</div>
				</div>

				<div class="anim-account">
					<div class="account-singup" id="js-contenedor-crear-cuenta"> 
<!-- 						<h4 class="animated">Registrarse</h4> -->
<!-- 						<div class="row"> -->
<!-- 							<form class="col s12"> -->
<!-- 								<div class="row"> -->

<!-- 									<div class="input-field col s12 animated"> -->
<!-- 										<input id="name" type="text" class="validate"> -->
<!-- 										<label for="name">Name</label> -->
<!-- 									</div> -->

<!-- 									<div class="input-field col s12 animated"> -->
<!-- 										<input id="username" type="text" class="validate"> -->
<!-- 										<label for="username">Username</label> -->
<!-- 									</div> -->

<!-- 									<div class="input-field col s12 animated"> -->
<!-- 										<input id="password" type="password" class="validate"> -->
<!-- 										<label for="password">Password</label> -->
<!-- 									</div> -->

<!-- 								</div> -->
<!-- 							</form> -->
<!--  						</div>  -->
					</div>
					<div class="account-login" id="js-contenedor-login">
<!-- 						<h4 class="animated">Login</h4> -->

<!-- 						<div class="row"> -->
<!-- 							<form class="col s12"> -->
<!-- 								<div class="row"> -->

<!-- 									<div class="input-field col s12 animated"> -->
<!-- 										<input id="username" type="text" class="validate"> -->
<!-- 										<label for="username">Username</label> -->
<!-- 									</div> -->

<!-- 									<div class="input-field col s12 animated"> -->
<!-- 										<input id="password" type="password" class="validate"> -->
<!-- 										<label for="password">Password</label> -->
<!-- 									</div> -->

<!-- 								</div> -->
<!-- 							</form> -->
<!-- 						</div> -->
					</div>
				</div>
			</section>
			<!-- end / .section -->
			</section>
	</div>
</div>

<a class="waves-effect waves-light btn modal-trigger"
	href="#modal-login" style="display: none;"></a>

<?php
if (Yii::$app->user->isGuest) {
	$this->registerJs ( "
  loadLogin();
loadSign();
$('ul.tabs').tabs();

  ", View::POS_END );
}

if(!empty($token)){
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

