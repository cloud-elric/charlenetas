
<!-- .page-cont -->
<div class="page-cont dashboard">

	<div class="row">
	<?php foreach($dashboard as $dash): ?>
		<div class="col s12 m6 l4">
			<a class="dashboard-card <?= $dash->txt_clase_css ?>" href="<?= yii::$app->homeUrl . "adminPanel/admin/" . $dash->txt_action; ?>">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3><?= $dash->txt_nombre; ?></h3>
						</div>
						<div class="col s2 text-center">
							<i class="ion <?= $dash->txt_ico ?>"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-document"></i> <span><?=count($dash->entPosts)?> post</span></p>
				</div>
			</a>
		</div>
	  
		<?php endforeach;?>

		<!-- <div class="col s12 m6 l4" onClick="cargarNotificaciones()">
			<a class="dashboard-card card-notificaciones" href="#">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3>Notificaciones</h3>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-ios-bell-outline"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-document"></i> <span>8 post</span></p>
				</div>
			</a>
		</div> -->
		

<!-- 		<div onClick="cargarNotificaciones()">
			<input type="button" value="Notificaciones" /> -->
<!-- 		</div> -->

	
	</div>

</div>
<!-- end /.page-cont -->


