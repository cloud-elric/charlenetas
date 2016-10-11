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
			<a class='dropdown-button' data-activates='dropdown-agenda' href="#">
				<i class="ion ion-ios-calendar-outline"></i>
				<span class="badge badge-danger">8</span>
			</a>

			<!-- .dropdown-content AGENDA (dropdown) -->
			<ul id='dropdown-agenda' class='dropdown-content dropdown-content-agenda'>
				<li><a href="#!">Agenda 1</a></li>
				<li><a href="#!">Agenda 2</a></li>
				<li><a href="#!">Agenda 3</a></li>
				<li><a href="#!">Agenda 4</a></li>
				<li><a href="#!">Agenda 5</a></li>
			</ul>

			<!-- Notificaciones -->
			<?php 
				$notificaciones = new EntNotificaciones();
				$admin = $notificaciones->find()->where(['id_usuario'=>Yii::$app->user->identity])->andWhere(['b_leido'=>0])->count('id_usuario');
			?>
			<a class='dropdown-button' data-activates='dropdown-notificaciones' href="#">
			<!-- <a data-activates='dropdown-notificaciones' href="<?= yii::$app->homeUrl . "adminPanel/admin/notificaciones" ?>"> -->
				<i class="ion ion-ios-bell-outline"></i>
				<span class="badge badge-warning"><?= $admin ?></span>
			</a>

			<!-- .dropdown-content NOTIFICACIONES (dropdown) -->
			<ul id='dropdown-notificaciones' class='dropdown-content dropdown-content-notificaciones'>
				<li><a href="#!">Notificación 1</a></li>
				<li><a href="#!">Notificación 2</a></li>
				<li><a href="#!">Notificación 3</a></li>
				<li><a href="#!">Notificación 4</a></li>
				<li><a href="#!">Notificación 5</a></li>
			</ul>

			<!-- .dropdown-button (btn) -->
			<a class='dropdown-button' href='#' data-activates='dropdown-user'>
				<span class="toolbar-span"><?=Yii::$app->user->identity->nombreCompleto?></span> <i class="ion ion-ios-arrow-down dropdown-user-ion"></i></a>

			<!-- .dropdown-content USER (dropdown) -->
			<ul id='dropdown-user' class='dropdown-content dropdown-content-user'>
				<li><a href="#!">Perfil</a></li>
				<li><a href="#!">Extra</a></li>
				<li><?=Html::a('Cerrar sesión', ['../site/logout'])?></li>
			</ul>

		</div>
		<!-- end /.toolbar -->
	</div>
	<!-- end /.header-cont -->
</div>
<!-- end /.header -->