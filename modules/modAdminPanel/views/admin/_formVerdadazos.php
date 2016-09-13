<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$form = ActiveForm::begin ( [
		'options' => [
				'enctype' => 'multipart/form-data'
		]
] );
?>

    <?= $form->field($verdadazo, 'txt_titulo')->textInput(['maxlength' => true])?>

    <?= $form->field($verdadazo, 'txt_descripcion')->textInput(['maxlength' => true])?>

  	 <?= $form->field($verdadazo, 'imagen')->fileInput()?>
  	 
  	 <?= $form->field($verdadazo, 'fch_publicacion')->textInput(["class"=>"datepicker"])?>
   
     <?= Html::submitButton('Crear')?>
       
<?php ActiveForm::end();

$this->registerJs ( "
		$('.datepicker').pickadate({
    	weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		today: 'Hoy',
		clear: 'Limpiar',
		close: 'Cerrar',
		format: 'dd mmm, yyyy',
  		formatSubmit: 'yyyy/mm/dd',
		selectMonths: true, // Creates a dropdown to control month
    	selectYears: 15 // Creates a dropdown of 15 years to control year
  });
", View::POS_END );