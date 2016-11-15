<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;

$this->registerCssFile('@web/css/error.css',['depends' => [\app\assets\AppAsset::className()]]);

$nombre = $name;
$mensajeError = nl2br(Html::encode($message));

if($exception->statusCode==404){
	$mensajeError = 'La pagina a la que intenta ingresar no se encuentra.';
}else if($exception->statusCode==500){
	$mensajeError = 'Ha ocurrido un error en el servidor.';
}else if($exception->statusCode==403){
	$mensajeError = 'Usted no tiene permiso para ingresar a esta sección';
}

$this->title = $nombre;
?>

<div class="page-content vertical-align-middle">
	<header>
		<h1 class="animation-slide-top"><?= Html::encode($exception->statusCode) ?></h1>
		<p> <?= $mensajeError ?></p>
	</header>
	<p class="error-advise">Intenta encontrar el camino correcto desde la pagina de inicio</p>
	
	<?=Html::a( 'Ir a pagina de inicio', Yii::$app->homeUrl, ['class'=>'btn btn-primary btn-round'])?>
</div>
