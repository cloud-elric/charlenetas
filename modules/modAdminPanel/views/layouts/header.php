<?php
use yii\helpers\Html;
use app\models\EntNotificaciones;
use app\models\EntCitas;
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
			<?php 
				$citas = new EntCitas();
				
				$hoy = date("Y-m-d 00:00:00");
				$maniana = date("Y-m-d 00:00:00");
				$maniana = date("Y-m-d 00:00:00", strtotime($maniana . '+1 day'));
				
				//$agenda = $citas->find()->where(['>=', 'start', $hoy])->andWhere(['<=', 'start', $maniana])->count('id_usuario');
				$mostrarAgenda = $citas->find()->where(['>=', 'start', $hoy])->andWhere(['<=', 'start', $maniana])->all();
				
				$notif = new EntNotificaciones();
				$notiCitas = $notif->find()->all();
				
				$contador = 0;
				
			?>
			<a  class='dropdown-button' data-activates='dropdown-agenda' href="#">
				<i class="ion ion-ios-calendar-outline"></i>
				
				<?php foreach($mostrarAgenda as $mostrarCita){
					 	foreach($notiCitas as $notiCita){ 
						  if($mostrarCita->txt_token === $notiCita->txt_token_objeto && $notiCita->b_leido == 0){
						  	$contador++;
				?>
							<span class="badge badge-danger"><?= $contador ?></span>
				<?php	
						  }else{
			    ?>
			    			<span class="badge badge-danger"><?= $contador ?></span>
			    <?php
						  }
						}
				 	  } 
				 ?>
			</a>

			<!-- .dropdown-content AGENDA (dropdown) -->
			<ul id='dropdown-agenda' class='dropdown-content dropdown-content-agenda'>
				<?php foreach($mostrarAgenda as $mostrarCita){
					 	foreach($notiCitas as $notiCita){ 
						  if($mostrarCita->txt_token === $notiCita->txt_token_objeto){
				?>
							<li><a href="#!"><?= $mostrarCita->title?></a></li>
				<?php	
							//$notiCita->b_leido = 1;
							//$notiCita->save();
						  }
						}
				 	  } 
				 ?>
			</ul>

			<!-- Notificaciones -->
			<?php 
				$notificaciones = new EntNotificaciones();
				//$admin = $notificaciones->find()->where(['id_usuario'=>Yii::$app->user->identity])->andWhere(['b_leido'=>0])->orderBy('fch_creacion ASC')->limit(15)->count('id_usuario');
				$mostrarNotificaciones = $notificaciones->find()->where(['id_usuario'=>Yii::$app->user->identity])->andWhere(['b_leido'=>0])->orderBy('fch_creacion ASC')->limit(5)->all();
				
				$cont = 0;
			?>
			<a id="js-mostrar-notificaciones" class='dropdown-button' data-activates='dropdown-notificaciones' href="#" >
			<!-- <a data-activates='dropdown-notificaciones' href="<?= yii::$app->homeUrl . "adminPanel/admin/notificaciones" ?>"> -->
				<i class="ion ion-ios-bell-outline"></i>
				
				<?php foreach($mostrarNotificaciones as $mostrarNotificacion){ 
						
						//Comparar si es cita o es otra notificacion
						$cadena1 = "cita";
						$comparar1 = strpos($mostrarNotificacion->txt_token_objeto, $cadena1);
					
						if($comparar1 === false){
							$cont++;
				?>
							<span class="badge badge-warning"><?= $cont ?></span>
				<?php 
						}else{
				?>
							<span class="badge badge-warning"><?= $cont ?></span>
				<?php 
						}
					}
				?>
			</a>
			
			<!-- .dropdown-content NOTIFICACIONES (dropdown) -->
			<ul id='dropdown-notificaciones' class='dropdown-content dropdown-content-notificaciones'>
				<?php foreach($mostrarNotificaciones as $mostrarNotificacion){ 
						
						//Comparar si es cita o es otra notificacion
						$cadena = "cita";
						$comparar = strpos($mostrarNotificacion->txt_token_objeto, $cadena);
					
						if($comparar === false){
				?>
							<li class="js-notificacion-item" data-token="<?= $mostrarNotificacion->txt_token_objeto?>"><a href="#!"><?= $mostrarNotificacion->txt_titulo ?></a></li>
				<?php 
							
							//$mostrarNotificacion->b_leido = 1;
							//$mostrarNotificacion->save();

						}
					}
				?>
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