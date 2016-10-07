<?php
use yii\helpers\Html;
use app\models\EntNotificaciones;
?>
<!-- .header -->
<div class="header">
	<!-- .logo -->
	<div class="logo">
		<a href=""><img src="<?= $bundle->baseUrl?>/imgs/logo.png" alt="Charlenetas"></a>
	</div>
	<!-- end /.logo -->

	<!-- .header-cont -->
	<div class="header-cont">
		<!-- .toolbar -->
		<div class="toolbar">

			<!-- Agenda -->
			<a href="">
				<i class="ion ion-ios-calendar-outline"></i>
				<span class="badge badge-danger">8</span>
			</a>

			<!-- Notificaciones -->
			<?php 
				$notificaciones = new EntNotificaciones();
				$admin = $notificaciones->find()->where(['id_usuario'=>Yii::$app->user->identity])->andWhere(['b_leido'=>0])->count('id_usuario');
			?>
			<a href="<?= yii::$app->homeUrl . "adminPanel/admin/notificaciones" ?>">
				<i class="ion ion-ios-bell-outline"></i>
				<span class="badge badge-warning"><?= $admin ?></span>
			</a>

			<!-- .dropdown-button (btn) -->
			<a class='dropdown-button' href='#' data-activates='dropdown-user'><?=Yii::$app->user->identity->nombreCompleto?> <i class="ion ion-ios-arrow-down"></i></a>

			<!-- .dropdown-content (dropdown) -->
			<ul id='dropdown-user' class='dropdown-content'>
				<li><a href="#!">Perfil</a></li>
				<li><a href="#!">Extra</a></li>
				<li><?=Html::a('Cerrar sesión', ['../site/logout'])?></li>
			</ul>
			
			<!-- <a href=""><i class="ion ion-ios-unlocked"></i></a> -->

		</div>
		<!-- end /.toolbar -->
	</div>
	<!-- end /.header-cont -->
</div>
<!-- end /.header -->