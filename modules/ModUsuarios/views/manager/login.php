<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params ['breadcrumbs'] [] = $this->title;

if (Yii::$app->params ['modUsuarios'] ['facebook'] ['usarLoginFacebook']) {
	?>
<script>

logInWithFacebook = function() {
	FB.login(function(response) {
		if (response.authResponse) {

			// Now you can redirect the user or do an AJAX request to
			// a PHP script that grabs the signed request from the cookie.
		}
		checkLoginState();
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
				
				alert("Parece que no aceptaste la solicitud de Facebook o no nos compartiste tu correo electrónico.");
				
			}else{
				// Logged into your app and Facebook.
				$.ajax({
					url:'http://notei.com.mx/test/wwwCharlenetas/web/callback-facebook',
					success:function(response){

						if(response.status=="success"){
							alert('Logueado');
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

<?php }?>

<h4 class="animated">Login</h4>

<div class="row">
	<?php
	$form = ActiveForm::begin ( [
			// 'enableAjaxValidation' => true,
			'enableClientValidation' => true,
			// 'validationUrl' => Url::base().'/netas/validacion-usuario',
			'layout' => 'horizontal',
			'id' => 'login-form',
			'class' => 'col s12',
			'fieldConfig' => [ 
					'template' => "<div class='row'>{input}\n{label}\n{error}</div>",
					'horizontalCssClasses' => [ 
							'error' => 'mdl-textfield__error' 
					],
					'labelOptions' => [ 
							'class' => 'mdl-textfield__label' 
					],
					'options' => [ 
							'class' => 'input-field col s12 animated' 
					] 
			],
			'errorCssClass' => 'invalid' 
	] );
	?>
	<div class="row">
		<?= $form->field($model, 'username')->textInput(['autofocus' => true])?>
		<?= $form->field($model, 'password')->passwordInput()?>
		<div class="center">
			<?= Html::submitButton('<span class="ladda-label">Login</span>',['id'=>'js-login-submit', 'class'=>'btn waves-effect waves-light center ladda-button', 'name' => 'login-button', 'data-style'=>'zoom-in'])?>
		</div>
	</div>
<?php ActiveForm::end(); ?>

<?php if(Yii::$app->params ['modUsuarios'] ['facebook'] ['usarLoginFacebook']){?>
	<button type="button" onClick="logInWithFacebook()"
		scope="<?=Yii::$app->params ['modUsuarios'] ['facebook'] ['permisos']?>">
		<i></i> Ingresar con Facebook
	</button>
<?php }?>
</div>