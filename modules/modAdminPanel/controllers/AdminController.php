<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;

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
	
	public function actionUsuarios($page = 0, $q='')
	{
		$usuarios  = EntUsuarios::getUsuarios($q, $page);
		return $this->render('usuarios', ["usuarios"=>$usuarios]);
	}
	
	public function actionEspejo()
	{
		return $this->render('espejo');
	}
	
	public function actionAlquimia()
	{
		return $this->render('Alquimia');
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