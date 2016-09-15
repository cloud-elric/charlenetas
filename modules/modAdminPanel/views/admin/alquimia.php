<?php

use app\models\EntPosts;
use app\models\EntComentariosPosts;
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;
?>

<!-- .page-cont -->
<div class="page-cont">
	<!-- .row -->
	<div class="row">
		
		<?php

		foreach ($postsAlquimia as $postAlquimia){
		?>
		<div class="col s12 m6 l4">
			<div class="card card-alquimia">
				<h3><?= $postAlquimia->txt_titulo ?></h3>
				<p><?= $postAlquimia->num_likes ?></p>

				<div class="card-options">
					<div class="card-options-check">
						<input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
						<label for="filled-in-box1"></label>
					</div>

					<?php include 'templates/modalPost.php'; ?>
					
					
					<!-- <i class="ion ion-edit card-edit"></i> -->
				</div>
			</div>
		</div>

		<?php } ?>
		
	</div>
	<!-- end /.row -->

	<!-- .fixed-action-btn -->
	<div class="fixed-action-btn horizontal">
		<a class="btn-floating btn-large waves-effect waves-light btn-check">
			<!-- <i class="ion ion-wand"></i> -->
			<i class="ion ion-ios-trash-outline"></i>
		</a>
		<a class="btn-floating btn-large waves-effect waves-light btn-agregar">
			<i class="material-icons">add</i>
		</a>
	</div>
	<!-- end /.fixed-action-btn -->

</div>
<!-- end /.page-cont -->
<?php
	// foreach ($postsAlquimia as $postAlquimia){
	// 	//echo $postAlquimia->entAlquimias;
	// 	echo $postAlquimia->id_post . "   ";
	// 	echo $postAlquimia->id_tipo_post . "   ";
	// 	echo $postAlquimia->id_usuario . "   ";
	// 	echo $postAlquimia->id_usuario_administrador . "   ";
	// 	echo $postAlquimia->txt_titulo . "   ";
	// 	echo $postAlquimia->txt_token . "   ";
	// 	echo $postAlquimia->txt_descripcion . "   ";
	// 	echo $postAlquimia->txt_imagen . "   ";
	// 	echo $postAlquimia->txt_url . "   ";
	// 	echo $postAlquimia->num_likes . "   ";
	// 	echo $postAlquimia->fch_creacion . "   ";
	// 	echo $postAlquimia->fch_publicacion . "   ";
	// 	echo $postAlquimia->b_habilitado . "   ";
		
	// 	echo"</br>";
	// }
	// echo "total= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->count("id_tipo_post");
	// echo "total likes= " . EntPosts::find()->where(['id_tipo_post'=>$postAlquimia->id_tipo_post])->sum("num_likes");
	// echo "total comentarios= " . EntComentariosPosts::find()->where(['id_post'=>$postAlquimia->id_tipo_post])->count("id_post");

$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added




$this->registerJs ( "
		cargarFormulario();
", View::POS_END );


