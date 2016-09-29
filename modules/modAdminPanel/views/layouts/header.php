<?php
use yii\helpers\Html;
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
			<a href="">
				<i class="ion ion-ios-bell-outline"></i>
				<span class="badge badge-warning">8</span>
			</a>

			<!-- .dropdown-button (btn) -->
			<a class='dropdown-button' href='#' data-activates='dropdown-user'>Juan <i class="ion ion-ios-arrow-down"></i></a>

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