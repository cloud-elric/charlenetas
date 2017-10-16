<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

	<script> var basePath = '<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>'; </script>
	<script>var basePathFace = 'http://charlenetas.com/';</script>

	<link rel="shortcut icon" type="image/png" href="<?=Url::base()?>/favicon.png"/>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88754507-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<script>

logInWithFacebook = function() {

	var boton = document.getElementById("btn-facebook");
	var l = Ladda.create(boton);
 	l.start();
	
	FB.login(function(response) {
		if (response.authResponse) {

			// Now you can redirect the user or do an AJAX request to
			// a PHP script that grabs the signed request from the cookie.
		}
		checkLoginState();
		l.stop();
	}, {
		scope : '<?=Yii::$app->params ['modUsuarios'] ['facebook'] ['permisosForzosos']?>',
		auth_type : 'rerequest'
	});
	
	return false;
};

function statusChangeCallback(response) {
	//empresasunitec@outlook.com
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {

		FB.api('/me/permissions', function(response) {
			var declined = [];
			for (i = 0; i < response.data.length; i++) {
				if (response.data[i].status == 'declined') {
					declined.push(response.data[i].permission)
				}
			}
			if(declined.toString()=="email"){
				
				mostrarMensaje("Parece que no aceptaste la solicitud de Facebook o no nos compartiste tu correo electrónico.");
				
			}else{
				// Logged into your app and Facebook.
				$.ajax({

					url:'<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] )?>callback-facebook',

					success:function(response){

						if(response.status=="success"){
							var token = $('#js-token-post').val();
							cargarFuncionalidadRespuestas();
							showPostAfterLogin(token);
							cargarCerrarSesion();
							//loadEspejoPreguntar();
							mensajeCuentaActivada("Bienvenido netanauta");
							
							cargarRespuestasSabiasQue();
							
							$('#js-preguntar-espejo').attr('onclick', 'agregarPregunta();');
							}
						}
					});
				//window.location.replace('http://notei.com.mx/test/wwwCharlenetas/web/callback-facebook');
				//window.location.replace('http://notei.com.mx/test/wwwComiteConcursante/index.php/usrUsuarios/callbackFacebook/t/3c391e5c9feec1f95282a36bdd5d41ba');
//				window.location
//						.replace('https://hazclicconmexico.comitefotomx.com/concursar/usrUsuarios/callbackFacebook/t/3c391e5c9feec1f95282a36bdd5d41ba');
			}
		});

		
	} else if (response.status === 'not_authorized') {
		alert("Rechazo ingresar mediante Facebook");
		// The person is logged into Facebook, but not your app.
	} else {
		
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
	}
}

function checkLoginState() {

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
		
	});
}

window.fbAsyncInit = function() {
	FB.init({
		//appId : '1029875693761281',
		//appId:'171096896693553',
		appId:'1779986862262300',
		cookie : true, // enable cookies to allow the server to access
		// the session
		xfbml : true, // parse social plugins on this page
		version : 'v2.6' // use any version
	});

};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
		return;
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<div class="animsition">
<?php $this->beginBody() ?>


        <?= $content ?>


<?php $this->endBody() ?>
</div>

<script>
  $(document).ready(function() {
    $('.animsition').animsition({transition: function(url){}});
  });

  window.onbeforeunload=function(){
	  $('.animsition').animsition('out' , $('.animsition'), '');
	}
  </script>
</body>
</html>
<?php $this->endPage() ?>
