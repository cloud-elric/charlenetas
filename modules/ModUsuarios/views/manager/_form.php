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
						],
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

	<?= $form->field($model, 'imageProfile', ['template'=>'<div class="btn"><span>Cargar Avatar</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6 animated delay-3']])->fileInput()?>
<!-- 
<div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
 -->
<div class="form-group">
        <?= Html::submitButton('<span class="ladda-label">'.($model->isNewRecord ? 'Registrarse' : 'Actualizar datos').'</span>', ['id'=>'js-registrase-btn','class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' ladda-button animated delay-4', 'data-style'=>'zoom-in'])?>
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
						
						$('#js-contenedor-crear-cuenta').hide();
						$('#js-message-sign-up').show();
						
						document.getElementById("sign-form").reset();
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
				    },
				    500:function(){
				    	l.stop();
					    }
				  }

			});
		return false;
	});
});

</script>