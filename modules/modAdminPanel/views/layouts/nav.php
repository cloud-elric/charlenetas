<?php 
	use app\models\CatTiposPosts;

	$dashboard = new CatTiposPosts();
	$posts = $dashboard->find()->orderBy('txt_nombre ASC')->all();

?>

<!-- .nav -->
<div class="nav" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
	<div>
		<div>
			<a class="active" href="<?= yii::$app->homeUrl . "adminPanel/admin/" . "dashboard"; ?>"><i class="ion ion-home"></i></a>

			<?php foreach($posts as $post): ?>
			
			<a href="<?= yii::$app->homeUrl . "adminPanel/admin/" . $post->txt_action; ?>"><i class="ion <?= $post->txt_ico ?>"></i></a>
			
			<?php endforeach;?>

			<a href="agenda.php"><i class="ion ion-ios-calendar-outline"></i></a>

			<a href="users.php"><i class="ion ion-android-people"></i></a>
		</div>
	</div>
</div>
<!-- end /.nav -->