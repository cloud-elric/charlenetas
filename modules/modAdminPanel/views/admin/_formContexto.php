<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$classActive = $post->isNewRecord?'':'active';
?>

<h4><?=$post->isNewRecord?'Agregar':'Editar'?> <span>Contexto</span></h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
 		
		'layout' => 'horizontal',
		'id' => $post->isNewRecord?'form-contexto':'editar-contexto',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label '.$classActive 
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );
?>
<div class='row'>
    <?= $form->field($post, 'txt_titulo')->textInput(['maxlength' => true])?>

  	 <?= $form->field($post, 'txt_url')->textInput()?>
  	 
  	 <?= $form->field($post, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
  	 
  	 <?= $form->field($post, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
  	 
  	 <?= $form->field($contexto, 'txt_tags',  ['template'=>'{error}{input}', 'options'=>['class'=>'input-field col s12']])->dropdownList(['tags'=>'tags'],['class'=>'js-example-tags'])->label(false)?>
  	 
  	  <?= $form->field($post, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
   </div>
     <?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>
       
<?php ActiveForm::end();

include 'templates/formato-fecha.php';

?>

<script>

$(".js-example-tags").select2({
	  tags: 'true'
	})

</script>
