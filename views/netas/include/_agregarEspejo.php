<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $post->isNewRecord ? '' : 'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Espejo</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		
		'layout' => 'horizontal',
		'id' => $post->isNewRecord ? 'form-espejo' : 'editar-espejo',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label ' . $classActive 
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
<div class='row'>
		<?= $form->field($post, 'txt_descripcion')->textInput(['maxlength' => true])->textarea()?>
	</div>

<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php

ActiveForm::end ();

?>

<script>
$(document).ready(function(){
	$('body').on('beforeSubmit', '#form-espejo', function() {
		var form = $(this);
		// return false if form still have some validation errors
		if (form.find('.has-error').length) {
			return false;
		}
		
		var button = document.getElementById('js-registrase-btn');
		var l = Ladda.create(button);
	 	l.start();
		// submit form
			$.ajax({
				url : form.attr('action'),// url para peticion
				type : 'post', // Metodo en el que se enviara la informacion
				success : function(response) { 

					// Si la respuesta contiene la propiedad status y es success
					if (response.hasOwnProperty('status')
							&& response.status == 'success') {
						var token = $('#js-token-post').val();
						showPostAfterLogin(token);
						cargarCerrarSesion();
						loadEspejoPreguntar();
					} else {
						// Muestra los errores
						$('#form-espejo').yiiActiveForm('updateMessages',
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