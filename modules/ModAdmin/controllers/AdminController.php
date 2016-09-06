<?php

namespace app\modules\ModAdmin\controllers;

use yii\web\Controller;
use app\models\EntPosts;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	
	/**
	 * es un action de prueba
	 */
	public function actionPrueba(){
		
		
		$post =  EntPosts::find()->where(["id_tipo_post"=>1])->all();
		
		return $this->render("prueba", ["post"=>$post]);
	}
}
