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
			<?= Html::submitButton('<span class="ladda-label">Login</span>',['id'=>'js-login-submit', 'class'=>'btn waves-effect waves-light center ladda-button animated', 'name' => 'login-button', 'data-style'=>'zoom-in'])?>
		</div>
	</div>
<?php ActiveForm::end(); ?>

<?php if(Yii::$app->params ['modUsuarios'] ['facebook'] ['usarLoginFacebook']){?>
	<button id="btn-facebook" type="button" class="btn btn-facebook animated ladda-button" data-style="zoom-in" onClick="logInWithFacebook()"
		scope="<?=Yii::$app->params ['modUsuarios'] ['facebook'] ['permisos']?>">
		<i></i> <span class="ladda-label">Ingresar con Facebook</span>
	</button>
<?php }?>
	<!-- <p class="link-olvide-password animated">¿Olvidaste tu contraseña?</p> -->
</div>

<script>

$(document).ready(function(){
	$('#js-login-submit').on('click', function(e){
		e.preventDefault();
		$('#login-form').submit();
	})

	$('body').on('beforeSubmit', '#login-form', function() {
		var form = $(this);
		// return false if form still have some validation errors
		if (form.find('.has-error').length) {
			return false;
		}
		
		var button = document.getElementById('js-login-submit');
		var l = Ladda.create(button);
	 	l.start();
		// submit form
		$.ajax({
			url : form.attr('action'),
			type : 'post',
			data : form.serialize(),
			success : function(response) {
				
				// Si la respuesta contiene la propiedad status y es success
				if (response.hasOwnProperty('status')
						&& response.status == 'success') {
					var token = $('#js-token-post').val();
					showPostAfterLogin(token);
					cargarCerrarSesion();
					mensajeCuentaActivada("Bienvenido de nuevo charlenauta");
					
				} else {
					// Muestra los errores
					$('#login-form').yiiActiveForm('updateMessages',
							response, true);
				}
				
				l.stop();
			},
			error:function(){
				l.stop();
			}
		});
		return false;
	});
});

</script>

