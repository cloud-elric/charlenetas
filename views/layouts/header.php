<?php
use yii\helpers\Html;
?>
<div class="header">
	<div class="">
		<a href="#" class="disabled">Workshops</a> <a href="#" class="disabled">Tutoriales</a>
	</div>
	<div class="logo">
		<img src="webAssets/images/logo-charlenetas.png" alt="Charlenetas.com" />
	</div>
	<div class="">
		<!-- <div class="btn btn-link ">Ingresar</div>
		<div class="btn btn-secondary">Registrarme</div> -->
		<?php
		// Si el usuario esta autenticado
		 if(!Yii::$app->user->isGuest){
		//  echo Html::img(Yii::$app->user->identity->getImageProfile());	
		//  echo Yii::$app->user->identity->nombreCompleto.'<br>';
		 echo Html::a('Cerrar sesión', ['site/logout']);
		 }else{
		 	echo Html::a('Ingresar', ['#'], ['onclick'=>'showModalLogin();']);
		 }
?>
<!-- 		<a href="#">Mi perfil</a> -->
		<a href="#" class="filters-toggle"><i class="material-icons">menu</i></a>
	</div>
</div>
