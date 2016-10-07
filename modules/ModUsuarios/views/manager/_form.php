<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<h4 class="animated">Registrarse</h4>

<div class="row">

    <?php
				
$form = ActiveForm::begin ( [ 
						'id' => 'sign-form',
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
										'class' => 'input-field col s6 animated' 
								] 
						]
						,
						'errorCssClass' => 'invalid',
						'options' => [ 
								'enctype' => 'multipart/form-data' 
						] 
				] );
				?>
<div class="row">
    <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true])?>

    <?php $form->field($model, 'txt_apellido_materno')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true])?>
    
  	 <?= $form->field($model, 'imageProfile')->fileInput()?>

<div class="form-group">
        <?= Html::submitButton('<span class="ladda-label">'.($model->isNewRecord ? 'Create' : 'Update').'</span>', ['id'=>'js-registrase-btn','class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' ladda-button', 'data-style'=>'zoom-in'])?>
    </div>
	</div>
<?php ActiveForm::end(); ?>
</div>


<script>
$(document).ready(function(){
	$('body').on('beforeSubmit', '#sign-form', function() {
		var form = $(this);
		// return false if form still have some validation errors
		if (form.find('.has-error').length) {
			return false;
		}
		
		var button = document.getElementById('js-registrase-btn');
		var l = Ladda.create(button);
	 	l.start();
		// submit form
		// submit form
			$.ajax({
				url : form.attr('action'),// url para peticion
				type : 'post', // Metodo en el que se enviara la informacion
				data : new FormData(this), // La informacion a mandar
				dataType: 'json',  // Tipo de respuesta
				cache : false, // sin cache
				contentType : false,
				processData : false,
				success : function(response) { 

					// Si la respuesta contiene la propiedad status y es success
					if (response.hasOwnProperty('status')
							&& response.status == 'success') {
						var token = $('#js-token-post').val();
						showPostAfterLogin(token);
						cargarCerrarSesion();
					} else {
						// Muestra los errores
						$('#sign-form').yiiActiveForm('updateMessages',
								response, true);
					}
					
					l.stop();
				},
				statusCode: {
				    404: function() {
				      alert( "page not found" );
				    }
				  }

			});
		return false;
	});
});

</script>