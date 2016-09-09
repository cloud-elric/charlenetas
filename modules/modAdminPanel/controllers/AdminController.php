<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\EntComentariosPosts;
use app\models\EntPosts;

/**
 * Default controller for the `adminPanel` module
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
    
	public function actionDashboard()
	{
		return $this->render('dashboard');
	}
	
	/**
	 * Los parametros los resive por get
	 * @param number $page
	 * @param string $q
	 * @return string
	 */
	public function actionUsuarios($page = 0, $q='')
	{
		/**
		 * getUsuarios es un metodo static para mostrar usuarios con el string $q
		 * @var array $usuarios
		 */
		$usuarios = EntUsuarios::getUsuarios($page, $q);
		
		
		return $this->render('usuarios', ["usuarios"=>$usuarios]);
	}
	
	public function actionEspejo($page = 0)
	{
		$idPost = 1;
		$postsEspejo = EntPosts::getPosts($page, $idPost);
		
		return $this->render('espejo',["postsEspejo"=>$postsEspejo]);
	}
	
	public function actionAlquimia($page = 0,$post = 2)
	{
		$postsAlquimia = EntPosts::getPosts($page, $post);
		
		return $this->render('Alquimia',["postsAlquimia"=>$postsAlquimia]);
	}
	
	public function actionVerdadazos()
	{
		return $this->render('Verdadazos');
	}
	
	public function actionHoyPense()
	{
		return $this->render('HoyPense');
	}
	
	public function actionMedia()
	{
		return $this->render('Media');
	}
	
	public function actionContexto()
	{
		return $this->render('Contexto');
	}
	
	public function actionSoloPorHoy()
	{
		return $this->render('SoloPorHoy');
	}
	
	public function actionSabiasQue()
	{
		return $this->render('SabiasQue');
	}
	
	public function actionNotificaciones()
	{
		return $this->render('Notificaciones');
	}
	
	public function actionAgenda()
	{
		return $this->render('Agenda');
	}
	
}