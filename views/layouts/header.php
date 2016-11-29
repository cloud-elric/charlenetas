<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\EntNotificaciones;
?>
<div class="header">
	<div class="">
		<a href="#" class="disabled">Workshops</a> <a href="#" class="disabled">Tutoriales</a>
	</div>
	<div class="logo">
		<img src="<?=Url::base()?>/webAssets/images/logo-charlenetas.png" alt="Charlenetas.com" />
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

		 	?>
		 	<a id="js-ingresar-cerrar-sesion" onclick="showModalLogin();">Ingresar</a>
		 	<?php 
		 }
		 ?>
		 
		 <!-- Notificaciones -->
			<?php 
				$notificaciones = new EntNotificaciones();
				$user = $notificaciones->find()->where(['id_usuario'=>Yii::$app->user->identity])->andWhere(['b_leido'=>0])->count('id_usuario');
			?>
		<!-- 	<div onClick="cargarNotificaciones()">
				<input type="button" value="Notificaciones"/>
				<span class="badge badge-warning"><?= $user ?></span>
			</div> -->
		 
<!-- 		<a href="#">Mi perfil</a> -->
		<a href="#" class="filters-toggle"><i class="material-icons">menu</i></a>
	</div>
</div>
