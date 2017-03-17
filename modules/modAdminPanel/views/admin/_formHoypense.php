 <?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use dosamigos\tinymce\TinyMce;
use yii\web\View;
	
	$classActive = $hoyPense->isNewRecord ? '' : 'active';
	?>
<h4><?=$hoyPense->isNewRecord?'Agregar':'Editar'?> <span>Hoy pense</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		
		'layout' => 'horizontal',
		'id' => $hoyPense->isNewRecord ? 'form-hoypense' : 'editar-hoy-pense',
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

		<?= $form->field($hoyPense, 'txt_titulo', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])?>

		<?= $form->field($hoyPense, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>

		<?= $form->field($hoyPense, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
	</div>
<div class="row">
		<?php
		
echo TinyMce::widget ( 

		[ 
				'name' => 'EntPosts[txt_descripcion]',
				'value' => $hoyPense->txt_descripcion,
				'id' => $hoyPense->isNewRecord ? 'crear-wys-hoy-pense' : $hoyPense->txt_token,
				'options' => [ 
						'rows' => 15,
						'class' => $hoyPense->isNewRecord ? 'nuevo-elemento' : $hoyPense->txt_token 
				],
				'language' => 'es',
				'clientOptions' => [ 
						'themes' => 'modern',
						'plugins' => [ 
								"advlist autolink lists link charmap print preview anchor",
								"searchreplace visualblocks code fullscreen",
								"insertdatetime media table paste" 
						],
						'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image" 
				] 
		] );
		?>
		
	</div>

<?= Html::submitButton($hoyPense->isNewRecord?'crear':'editar', ['id'=>$hoyPense->isNewRecord?'js-crear-submit':'js-editar-submit', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name' => 'boton-hoy', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();

include 'templates/formato-fecha.php';


?>

