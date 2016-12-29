<?php 
	use app\models\CatTiposPosts;
use yii\helpers\Html;

	$dashboard = new CatTiposPosts();
	$posts = $dashboard->find()->where(['b_habilitado'=>1])->orderBy('txt_nombre ASC')->all();

?>

<!-- .nav -->
<div class="nav" data-options='{"direction": "vertical", "contentSelector": ">", "containerSelector": ">"}'>
	<div>
		<div>
			<a class="<?=$this->context->action->id=='dashboard'?'active':''?> tooltipped" data-position="right" data-delay="50" data-tooltip="Dashboard" href="<?= yii::$app->homeUrl . "adminPanel/admin/" . "dashboard"; ?>">
			<i class="ion ion-home"></i></a>

			<?php foreach($posts as $post): ?>
			
			<a class="<?=$this->context->action->id==$post->txt_action?'active':''?> tooltipped" data-position="right" data-delay="50" data-tooltip="<?= $post->txt_nombre ?>" href="<?= yii::$app->homeUrl . "adminPanel/admin/" . $post->txt_action; ?>"><i class="ion <?= $post->txt_ico ?>"></i></a>
			
			<?php endforeach;?>

			<!--  <a class="tooltipped" data-position="right" data-delay="50" data-tooltip="Calendario" href="<?= yii::$app->homeUrl . "adminPanel/calendario/calendario" ?>"><i class="ion ion-ios-calendar-outline"></i></a>-->

			<a class="tooltipped" data-position="right" data-delay="50" data-tooltip="Usuarios" href="<?= yii::$app->homeUrl . "adminPanel/admin/usuarios"?>"><i class="ion ion-android-people"></i></a>
			
			<a class="tooltipped" data-position="right" data-delay="50" data-tooltip="Clientes" href="<?= yii::$app->homeUrl . "adminPanel/admin/clientes"?>"><i class="ion ion-android-people"></i></a>

		</div>
	</div>
</div>
<!-- end /.nav -->