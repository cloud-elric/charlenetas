<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$classActive = $verdadazo->isNewRecord?'':'active';
?>

<h4><?=$verdadazo->isNewRecord?'Agregar':'Editar'?> <span>Verdadazo</span></h4>

<?php
$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		],
		
		'layout' => 'horizontal',
		'id' => $verdadazo->isNewRecord?'form-verdadazos':'editar-verdadazos',
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

	<div class='row open'>
    
		<?= $form->field($verdadazo, 'imagen', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
		<?= $form->field($verdadazo, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
		<?= $form->field($verdadazo, 'txt_descripcion', ['options'=>['class'=>'input-field col s12']])->textInput(['maxlength' => true])->textarea(['class'=>'materialize-textarea'])?>
  	 
   </div>
   
     <?= Html::submitButton('Crear <i class="ion ion-ios-paperplane right"></i>', array('class'=>'btn btn-submit waves-effect'))?>
       
<?php ActiveForm::end();

include 'templates/formato-fecha.php';
