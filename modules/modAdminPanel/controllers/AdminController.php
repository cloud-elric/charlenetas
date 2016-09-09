<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\EntComentariosPosts;
use app\models\EntPosts;
use app\models\EntPostsExtend;

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
	
	public function actionAlquimia($page = 0)
	{
		$idPost = 2;
		$postsAlquimia = EntPosts::getPosts($page, $idPost);
		
		return $this->render('Alquimia',["postsAlquimia"=>$postsAlquimia]);
	}
	
	public function actionVerdadazos($page = 0)
	{
		$idPost = 3;
		$postsVerdadazos = EntPosts::getPosts($page, $idPost);
				
		return $this->render('Verdadazos',["postsVerdadazos"=>$postsVerdadazos]);
	}
	
	public function actionHoyPense($page = 0)
	{
		$idPost = 4;
		$postsHoypense = EntPosts::getPosts($page, $idPost);
		
		return $this->render('HoyPense',["postsHoyPense"=>$postsHoypense]);
	}
	
	public function actionMedia($page = 0)
	{
		$idPost = 5;
		$postsMedia = EntPosts::getPosts($page, $idPost);
		
		return $this->render('Media',["postsMedia"=>$postsMedia]);
	}
	
	public function actionContexto($page = 0)
	{
		$idPost = 6;
		$postsContexto = EntPosts::getPosts($page, $idPost);
		
		return $this->render('Contexto',["postsContexto"=>$postsContexto]);
	}
	
	public function actionSoloPorHoy($page = 0)
	{
		$idPost = 7;
		$postsSoloPorHoy = EntPosts::getPosts($page, $idPost);
		
		return $this->render('SoloPorHoy',["postsSoloPorHoy"=>$postsSoloPorHoy]);
	}
	
	public function actionSabiasQue($page = 0)
	{
		$idPost = 8;
		$postsSabiasQue = EntPosts::getPosts($page, $idPost);
		
		return $this->render('SabiasQue',["postsSabiasQue"=>$postsSabiasQue]);
	}
	
	public function actionNotificaciones()
	{
		return $this->render('Notificaciones');
	}
	
	public function actionAgenda()
	{
		return $this->render('Agenda');
	}
	
	public function actionHabilitarPost($tokenPost = "post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc")
	{
		$postHabilitar = EntPosts::getPostByToken($tokenPost);
		$postHabilitar->b_habilitado = 1;
		
		if($postHabilitar->save())
			echo "SUCCESS ";
		else 
			echo "ERROR";
	}
	
	public function actionDeshabilitarPost($tokenPost = "post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc")
	{
		$postDeshabilitar = EntPosts::getPostByToken($tokenPost);
		$postDeshabilitar->b_habilitado = 0;
		
		if($postDeshabilitar->save())
			echo "SUCCESS ";
		else
			echo "ERROR";
	}
	
}