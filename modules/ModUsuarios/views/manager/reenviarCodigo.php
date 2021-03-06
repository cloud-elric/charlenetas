<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<style>

.account-activar h4 {
    color: #345678;
    font-family: 'Raleway', sans-serif;
    font-size: 1.1em;
    font-weight: 900;
    letter-spacing: 2px;
    margin-bottom: 12px;
    text-transform: uppercase;
    margin-bottom: 40px;
}

</style>
	<h4 class="animated">Reenviar correo de activación</h4>

	<div class="row">

    <?php
$form = ActiveForm::begin ( [ 
						'id' => 'peticion-activacion-form',
						// 'enableAjaxValidation' => true,
						'enableClientValidation' => true,
						// 'validationUrl' => Url::base().'/netas/validacion-usuario',
						'layout' => 'horizontal',
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

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])?>
        <div class="center">
                <?= Html::submitButton('<span class="ladda-label">Reenviar email</span>',['id'=>'js-recuperar-activacion-submit', 'class'=>'btn waves-effect waves-light center ladda-button animated', 'name' => 'login-button', 'data-style'=>'zoom-in'])?>
        </div>

    <?php ActiveForm::end(); ?>
    <div style="margin-top:10px;text-align: right;" class="animated">
			<?= Html::a('Iniciar sesión','',['id'=>'iniciar-sesion-activar',   'style'=>'font-size:14px;    text-decoration: underline; font-weight: 400;'])?>
		</div>
	</div>


<script>

$(document).ready(function(){
	$('#js-recuperar-activacion-submit').on('click', function(e){
		e.preventDefault();
		$('#peticion-activacion-form').submit();
	})

	$('body').on('beforeSubmit', '#peticion-activacion-form', function() {
		var form = $(this);
		// return false if form still have some validation errors
		if (form.find('.has-error').length) {
			return false;
		}
		
		var button = document.getElementById('js-recuperar-activacion-submit');
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
					$("#js-contenedor-activar").hide();
					$('#js-message-sign-up').show();
					document.getElementById("peticion-activacion-form").reset();
				} else {
					// Muestra los errores
					$('#peticion-activacion-form').yiiActiveForm('updateMessages',
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