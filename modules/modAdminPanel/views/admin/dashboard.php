<?php 

use app\models\EntPosts;

$this->title = 'Dashboard';

//Retorna el tatal de post que estan habilitados en la BD
function totalPost($idTipo){
	$posts = new EntPosts();
	$postsHabilitados = $posts->find()->where(['id_tipo_post'=>$idTipo])->andWhere(['b_habilitado'=>1])->count();
	
	return $postsHabilitados;
}

?>
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
					<p><i class="ion ion-document"></i> <span><?=totalPost($dash->id_tipo_post)?> post</span></p>
				</div>
			</a>
		</div>
	  
		<?php endforeach;?>
	</div>

</div>
<!-- end /.page-cont -->


