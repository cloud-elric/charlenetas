<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;
$classActive = $post->isNewRecord ? '' : 'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Solo por Hoy</span>
</h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
		
		'layout' => 'horizontal',
		'id' => $post->isNewRecord ? 'form-soloporhoy' : 'editar-solo-por-hoy',
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
	<?= $form->field($soloporhoy, 'num_articulo')->textInput()?>

		<?= $form->field($post, 'txt_url')->textInput()?>
		
		<?= $form->field($post, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>

		<?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		
		
		</div>
<div class="row">
		<?php
		
echo TinyMce::widget ( 

		[ 
				'name' => 'EntPosts[txt_descripcion]',
				'value' => $post->txt_descripcion,
				'id' => $post->isNewRecord ? 'crear-wys-solo-por-hoy' : $post->txt_token,
				'options' => [ 
						'rows' => 15,
						'class' => $post->isNewRecord ? 'nuevo-elemento' : $post->txt_token 
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

<?= Html::submitButton($post->isNewRecord?'crear':'editar', ['id'=>$post->isNewRecord?'js-crear-submit':'js-editar-submit', 'class'=>'btn btn-submit ladda-button', 'name' => 'boton-solo', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();

include 'templates/formato-fecha.php';
