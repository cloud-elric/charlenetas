<?php 
use yii\web\View;

$this->registerJs ( "
		$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
	container: 'body',
	format: 'dd-mmm-yyyy',
  });
", View::POS_END );