<?php
use yii\helpers\Url;
?>

<!-- .page-cont -->
<div class="page-cont dashboard">

	<div class="row">
	<h2>Notificaciones</h2>
	<br/>
	
	<?php foreach($notificaciones as $notificacion){ 
		  	  if($notificacion->id_tipo_post == 1){
	?>
				<div class="col s12 m6 l4">
					<a class="dashboard-card" href="<?=Url::base()?>/adminPanel/admin/espejo?page=0&token=<?= $notificacion->txt_token_objeto?>&idNotif=<?= $notificacion->id_notificacion ?>">
						<div class="dashboard-card-cont">
							<div class="row">
								<div class="col s10">
									<h3><?= $notificacion->txt_descripcion ?></h3>
								</div>
							</div>
						</div>
						<div>
							<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_titulo?></span></p>
						</div>
					</a>
				</div>	
		<?php 
		  	 }else if($notificacion->id_tipo_post == 2){
		?>
				<div class="col s12 m6 l4">
					<a class="dashboard-card" href="<?=Url::base()?>/adminPanel/admin/alquimia?page=0&token=<?= $notificacion->txt_token_objeto?>&idNotif=<?= $notificacion->id_notificacion ?>">
						<div class="dashboard-card-cont">
							<div class="row">
								<div class="col s10">
									<h3><?= $notificacion->txt_descripcion ?></h3>
								</div>
							</div>
						</div>
						<div>
							<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_titulo?></span></p>
						</div>
					</a>
				</div>	
		<?php 
		  	 }else if($notificacion->id_tipo_post == 3){
		?>
				<div class="col s12 m6 l4">
					<a class="dashboard-card" href="<?=Url::base()?>/adminPanel/admin/verdadazos?page=0&token=<?= $notificacion->txt_token_objeto?>&idNotif=<?= $notificacion->id_notificacion ?>">
						<div class="dashboard-card-cont">
							<div class="row">
								<div class="col s10">
									<h3><?= $notificacion->txt_descripcion ?></h3>
								</div>
							</div>
						</div>
						<div>
							<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_titulo?></span></p>
						</div>
					</a>
				</div>	
		<?php 
		  	 }else if($notificacion->id_tipo_post == 4){
		?>
				<div class="col s12 m6 l4">
					<a class="dashboard-card" href="<?=Url::base()?>/adminPanel/admin/hoy-pense?page=0&token=<?= $notificacion->txt_token_objeto?>&idNotif=<?= $notificacion->id_notificacion ?>">
						<div class="dashboard-card-cont">
							<div class="row">
								<div class="col s10">
									<h3><?= $notificacion->txt_descripcion ?></h3>
								</div>
							</div>
						</div>
						<div>
							<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_titulo?></span></p>
						</div>
					</a>
				</div>	
		<?php 
		  	 }else if($notificacion->id_tipo_post == 7){
		?>
				<div class="col s12 m6 l4">
					<a class="dashboard-card" href="<?=Url::base()?>/adminPanel/admin/solo-por-hoy?page=0&token=<?= $notificacion->txt_token_objeto?>&idNotif=<?= $notificacion->id_notificacion ?>">
						<div class="dashboard-card-cont">
							<div class="row">
								<div class="col s10">
									<h3><?= $notificacion->txt_descripcion ?></h3>
								</div>
							</div>
						</div>
						<div>
							<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_titulo?></span></p>
						</div>
					</a>
				</div>	
		<?php 
		  	 }
		?>
			
	<?php } ?>
	</div>
</div>	
		