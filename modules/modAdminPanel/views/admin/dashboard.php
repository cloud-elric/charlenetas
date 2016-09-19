


<!-- .page-cont -->
<div class="page-cont dashboard">

	<div class="row">
	<?php foreach($dashboard as $dash): ?>
		<div class="col s12 m6 l4">
			<a class="dashboard-card card-alquimia" href="/charlenetas/web/adminPanel/admin/<?= $dash->txt_action; ?>">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3><?= $dash->txt_nombre; ?></h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-card"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>
	  
	  	<!--<div class="col s12 m6 l4">
			<a class="dashboard-card card-contexto" href="/charlenetas/web/adminPanel/admin/contexto">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10 ">
							<h3>En contexto</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-network"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>
		
		<div class="col s12 m6 l4">
			<a class="dashboard-card card-espejo" href="/charlenetas/web/adminPanel/admin/espejo">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10 ">
							<h3>Espejo</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-flag"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>
		
		<div class="col s12 m6 l4">
			<a class="dashboard-card card-hoy-pense" href="/charlenetas/web/adminPanel/admin/hoy-pense">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10 ">
							<h3>Hoy pense</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-umbrella"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>
		
		<div class="col s12 m6 l4">
			<a class="dashboard-card card-media" href="/charlenetas/web/adminPanel/admin/media">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3>Media</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-images"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>

		<div class="col s12 m6 l4">
			<a class="dashboard-card card-sabias-que" href="/charlenetas/web/adminPanel/admin/sabias-que">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3>Sabias que</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-speakerphone"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>

		<div class="col s12 m6 l4">
			<a class="dashboard-card card-solo-por-hoy" href="/charlenetas/web/adminPanel/admin/solo-por-hoy">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3>Solo por hoy</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-crop"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>
		
		<div class="col s12 m6 l4">
			<a class="dashboard-card card-verdadazos" href="/charlenetas/web/adminPanel/admin/verdadazos">
				<div class="dashboard-card-cont">
					<div class="row">
						<div class="col s10">
							<h3>A verdadadoz</h3>
							<p>30 post</p>
						</div>
						<div class="col s2 text-center">
							<i class="ion ion-chatboxes"></i>
						</div>
					</div>
				</div>
				<div class="dashboard-card-foot">
					<p><i class="ion ion-email"></i> <span>30 mensajes</span></p>
				</div>
			</a>
		</div>-->
		<?php endforeach;?>
	
	</div>

</div>
<!-- end /.page-cont -->


<?php
use yii\helpers\Html;
?>

	<?= Html::a('Alquimia', ['/adminPanel/admin/alquimia']) ?>
	
	<?= Html::a('Verdadazos', ['/adminPanel/admin/verdadazos']) ?>
	
	<?= Html::a('Hoy pense', ['/adminPanel/admin/hoy-pense']) ?>
	
	<?= Html::a('Media', ['/adminPanel/admin/media']) ?>
	
	<?= Html::a('Contexto', ['/adminPanel/admin/contexto']) ?>
	
	<?= Html::a('Solo por hoy', ['/adminPanel/admin/solo-por-hoy']) ?>
	
	<?= Html::a('Sabias que', ['/adminPanel/admin/sabias-que']) ?>

