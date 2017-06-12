<?php 
use yii\helpers\Html;

//Cambiar formato fecha
$start1 = new \DateTime($model['start']);
$end1 = new \DateTime($model['end']);
$horaInicio = date_format($start1, 'g:i A');
$horaFin = date_format($end1, 'g:i A');
$fecha = date_format($start1, 'j-F-Y');

$mes = explode('-', $fecha);
$meses = array('January'=>'Enero', 'February' =>'Febrero', 'March'=>'Marzo', 'April'=>'Abril', 'May'=>'Mayo', 'June'=>'Junio', 'July'=>'Julio',
'August'=>'Agosto', 'September'=>'Septiembre', 'October'=>'Octubre', 'November'=>'Noviembre', 'December'=>'Diciembre');
foreach($meses as $key=>$value){
	if($key == $mes[1]){
		$fecha = $mes[0] . "-" . $value . "-" . $mes[2];
	}
}
?>
<div class="col m6">
    <span><?= "FECHA: " . $fecha . " HORARIO: " . $horaInicio . " a " . $horaFin?></span>
</div>