<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use yii\db\mssql\PDO;
use app\modules\ModUsuarios\models\Utils;
use app\models\EntCitas;

/**
 * Calendario controller for the `adminPanel` module
 */
class CalendarioController extends Controller
{
	public $layout = 'main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Vista del calendario
     */
    public function actionCalendario(){
    	
    	return $this->render ( '_crearCitas');
    }
    
    /**
     * conecta a la base de datos para mostrar las citas en el calendario
     */
    public function actionAnadirCitas(){
    	
    	$json = array();
    	 
    	$entCitas = new EntCitas();
    	$ordenCitas = $entCitas->find()->where(['b_habilitado'=>1])->orderBy('id ASC')->asArray()->all();
    	 
    	echo json_encode($ordenCitas);
    	 
    }
    
    /**
     * Cambia la fecha y la hora de la cita al mover el evento en el calendario
     */
    public function actionActualizarCitas(){
    	
    	$id=$_POST['id'];
    	$title=$_POST['title'];
    	$start=$_POST['start'];
    	$end=$_POST['end'];
    	
    	$entCitas = new EntCitas();
    	$actualizar = $entCitas->find()->where(['id'=>$id])->one();
    	
    	$actualizar->title = $title;
    	$actualizar->start = $start;
    	$actualizar->end = $end;
    	$actualizar->save();
    }
    
    /**
     * Agregar citas a la base de datos
     */
    public function actionAgregarCitas(){
    	
    	$title=$_POST['title'];
    	$start=$_POST['start'];
    	$end=$_POST['end'];
    	$id_usuario = 25;//Yii::$app->user->identity;
    	$txt_token = Utils::generateToken ( 'cita_' );
    	
    	$entCitas = new EntCitas();
    	
    	$entCitas->title = $title;
    	$entCitas->start = $start;
    	$entCitas->end = $end;
    	$entCitas->id_usuario = $id_usuario;
    	$entCitas->txt_token = $txt_token;
    	
    	$entCitas->save();
    	//print_r($entCitas);
    }
    
    /**
     * Eliminar citas de la base de datos
     */
    public function actionEliminarCitas(){
    	$id = $_POST['id'];
    	
    	$entCitas = new EntCitas();
    	$eliminar = $entCitas->find()->where(['id'=>$id])->one();
    	
    	$eliminar->b_habilitado = 0;
    	$eliminar->save();
    }
}
