
<!-- .page-cont -->
<div class="page-cont dashboard">

	<div class="row">
	<h2>Notificaciones</h2>
	<br/>
	
	<?php foreach($notificaciones as $notificacion){ ?>
		<div class="col s12 m6 l4">
			<a class="dashboard-card">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3><?= $notificacion->txt_titulo; ?></h3>
						</div>
					</div>
				</div>
				<div>
					<p><i class="ion ion-ios-bell-outline"></i> <span><?=$notificacion->txt_descripcion?></span></p>
				</div>
			</a>
		</div>	
		<?php 
			$notificacion->b_leido = 1; 
			$notificacion->save();
		?>	
	
	<?php } ?>
	</div>
</div>	
		