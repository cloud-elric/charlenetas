<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\EntEspejos;

$classActive = $post->isNewRecord ? '' : 'active';
$espejo = new EntEspejos();
?>

<h4><?=$post->isNewRecord?'Preguntar al ':'Editar'?> <span>Espejo</span>
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
		
		<?= $form->field($post, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
		
		<?php 
		echo $form->field ( $espejo, 'b_anonimo')->checkbox([],false);
		?>
		
	</div>

<?= Html::submitButton('<span class="ladda-label">Preguntar </span>', array('style'=>'margin-top: 20px;', 'class'=>'btn btn-submit waves-effect ladda-button','id'=>'js-preguntar-btn','data-style'=>'zoom-in'))?>

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

		var valor = 0;
		$("input:checked").each(function(){
			//console.log($(this).val());
			valor = $(this).val();
		});

		var url = form.attr('action')+"?anonimo="+valor;
		var button = document.getElementById('js-preguntar-btn');
		var l = Ladda.create(button);
	 	l.start();
		// submit form
			$.ajax({
				url : url,// url para peticion
				type : 'post', // Metodo en el que se enviara la informacion
				data: form.serialize(),
				success : function(response) { 
					console.log(response); 

					// Si la respuesta contiene la propiedad status y es success
					if (response.hasOwnProperty('status')
							&& response.status == 'error') {
						// Muestra los errores
						$('#form-espejo').yiiActiveForm('updateMessages',
								response, true);
						
					} else {
						
						$('#modal-pregunta-espejo').closeModal();
						mensajeCuentaActivada('Tu pregunta ha sido guardada. Espera la respuesta');
						$("#js-creador-espejo").after(response);
						document.getElementById("form-espejo").reset();
					}
					
					l.stop();
				},
				error:function(){
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