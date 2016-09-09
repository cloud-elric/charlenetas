<?php
use app\modules\modAdminPanel\assets\ModuleAsset;
use yii\web\View;


$bundle = ModuleAsset::register ( Yii::$app->view );
$bundle->js [] = 'js/charlenetas-alquimia.js'; // dynamic file added
foreach ( $postsAlquimia as $postAlquimia ) {
	echo count ( $postAlquimia->entAlquimias );
}

include 'templates/modalPost.php';

$this->registerJs ( "
		cargarFormulario();
", View::POS_END );