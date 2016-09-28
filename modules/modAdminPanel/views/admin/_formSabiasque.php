<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$classActive = $post->isNewRecord ? '' : 'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Sabias que</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		'layout' => 'horizontal',
		'id' => $post->isNewRecord ? 'form-sabiasque' : 'editar-sabias-que',
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

<div class="row">
		<?php
		if ($post->isNewRecord) {
			echo $form->field ( $sabiasque, 'b_verdadero',['labelOptions' => [ 
						'class' => 'mdl-textfield__label active' 
				]])->radioList ( [ 
					'0' => 'No',
					'1' => 'Si' 
			], [ 
					'item' => function ($index, $label, $name, $checked, $value) {
						$checked = $checked ? 'checked' : '';
						$return = '<input class="with-gap" name="' . $name . '" type="radio" '.$checked.' id="respuesta_' . $index . '"  value="' . $value . '"/>';
						$return .= '<label for="respuesta_' . $index . '">' . $label . '</label>';
						return $return;
					} 
			])->label ();
		} else {
			echo $form->field ( $sabiasque, 'b_verdadero' )->radioList ( [ 
					'0' => 'No',
					'1' => 'Si' 
			], [ 
					'item' => function ($index, $label, $name, $checked, $value) {
						$checked = $checked ? 'checked' : '';
						$return = '<input class="with-gap" name="' . $name . '" type="radio" '.$checked.' id="edit_respuesta_' . $index . '"  value="' . $value . '"/>';
						$return .= '<label for="edit_respuesta_' . $index . '">' . $label . '</label>';
						return $return;
					} 
			])->label ();
		}
		
		?>
		
		<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		
		<?= $form->field($post, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
	
	</div>

<?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>

<?php

ActiveForm::end ();

include 'templates/formato-fecha.php';
