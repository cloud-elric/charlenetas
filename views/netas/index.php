<?php
use yii\web\View;
use yii\helpers\Url;
use app\models\ConstantesWeb;
use app\models\EntPosts;
use app\models\ModUsuariosEntUsuarios;

$this->title = 'Charlenetas';
?>
<?=$this->render('//layouts/header')?>
<?=$this->render('//layouts/nav', ['tiposPost'=>$tiposPost])?>

<div class=container-fluid>
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


<!-- .modal -->
<div id="modal-tutoriales" class="modal-tuto">

	<!-- .modal-content -->
	<div class="modal-content owl-carousel-tutoriales">

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Bienvenid@ a Charlenetas!</h3>

			<p>
				Una comunidad virtual libre de censura, creada para compartir reflexiones entre Netanautas. ¿Te enseñamos a navegar? ó ¿Cómo navegar? ó Aprende a navegar! (y aquí opciones que digan “saltar tutorial” y “no volver a mostrar”)
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Conviérte en un Netanauta</h3>

			<p>
				Inscríbete Gratis y comparte tus opiniones! 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Oculta lo que no quieras ver</h3>

			<p>
				Da click en las secciones que no quieres ver o actívalas nuevamente para filtrar las Netas que quieras ocultar o leer
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Espejo</h3>

			<p>
				¿Tienes un problema y quieres un Consejo? – Puedes preguntar aquí 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Alquimia</h3>

			<p>
				Te recomendamos películas de fuerte contenido que te transformarán 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Hoy pense</h3>

			<p>
				Lee y comparte opiniones personales sobre temas sociales 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Sabías qué</h3>

			<p>
				Pon a prueba tus conocimientos, responde y sorpréndete con el resultado 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Solo por hoy</h3>

			<p>
				Conoce tus derechos y aprende a exigirlos 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Verdadazos</h3>

			<p>
				Debate con frases que exponen la cruda realidad sobre desigualdades de género 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Contexto</h3>

			<p>
				Obtén una visión completa con noticias relacionadas 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Media</h3>

			<p>
				Mira los episodios del Programa Atando Cabos y mucho más 
			</p>

		</div>

		<div class="item">
			
			<div class="screen-ayuda-corousel-item-imagen">
				<img src="http://placehold.it/300x300" alt="">
			</div>

			<h3>Workshops</h3>

			<p>
				Conoce cursos, conferencias y talleres disponibles
			</p>

			<!-- <span id="modal-tutoriales-finalizar" class="modal-tutoriales-finalizar">
				<i class="ion ion-android-done"></i>
			</span> -->

		</div>


	</div>
	<!-- end - .modal-content -->

	<!-- Brn Close -->
	<span id="modal-tutoriales-close" class="modal-close">
		<i class="icon-close"></i>
	</span>

	<!-- <i class="material-icons medium icon-demo">trending_flat</i> -->

</div>
<!-- end - .modal -->