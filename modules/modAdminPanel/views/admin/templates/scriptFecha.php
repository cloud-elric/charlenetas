<?php 
use yii\web\View;

// $this->registerJs ( "
// 		$('.datepicker').pickadate({
//     	weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
// 		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
// 		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
// 		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
// 		today: 'Hoy',
// 		clear: 'Limpiar',
// 		close: 'Cerrar',
// 		format: 'dd mmm, yyyy',
//   		formatSubmit: 'yyyy/mm/dd',
// 		container: 'body',
// 		selectMonths: true, // Creates a dropdown to control month
//     	selectYears: 15 // Creates a dropdown of 15 years to control year
//   });
// ", View::POS_END );

$this->registerJs ( "
		$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
	container: 'body',
	format: 'dd-mmm-yyyy',
  });
", View::POS_END );