<?php
use yii\web\View;

$this->registerJs ( "
		$('.datepicker').pickadate({
		
// 		weekdaysShort: ['D', 'L', 'M', 'Mi', 'J', 'V', 'S'],
// 		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
// 		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
// 		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		today: 'Hoy',
		clear: 'Limpiar',
		close: 'Cerrar',
		container: 'body',
		format: 'dd-mmm-yyyy',
  		formatSubmit: 'yyyy-mm-dd',
		selectMonths: true, // Creates a dropdown to control month
    	selectYears: 15 // Creates a dropdown of 15 years to control year
  });
", View::POS_END );
?>