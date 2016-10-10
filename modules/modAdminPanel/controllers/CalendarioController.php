<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use yii\db\mssql\PDO;
use app\modules\ModUsuarios\models\Utils;

/**
 * Calendario controller for the `adminPanel` module
 */
class CalendarioController extends Controller
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
     * Vista del calendario
     */
    public function actionCalendario(){
    	
    	return $this->renderAjax ( '_crearCitas');
    }
    
    /**
     * conecta a la bese de datos para mostrar las citas
     */
    public function actionAnadirCitas(){
    	
    	$json = array();
    	 
    	$requete = "SELECT * FROM ent_citas ORDER BY id";
    	 
    	try {
    		$bdd = new PDO('mysql:host=localhost;dbname=charlenetas_geekdb', 'root', 'root');
    	} catch(Exception $e) {
    		exit('Imposible conectar a la base de datos.');
    	}
    	 
    	$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    	 
    	echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
    	 
    }
    
    /**
     * Cambia la fecha y la hora de la cita al mover el evento en el calendario
     */
    public function actionActualizarCitas(){
    	
    	$id=$_POST['id'];
    	$title=$_POST['title'];
    	$start=$_POST['start'];
    	$end=$_POST['end'];
    	
    	try {
    		$bdd = new PDO('mysql:host=localhost;dbname=charlenetas_geekdb', 'root', 'root');
    	} catch(Exception $e) {
    		exit('Imposible conectar a la base de datos.');
    	}
    	
    	$sql = "UPDATE ent_citas SET title=?, start=?, end=? WHERE id=?";
    	$q = $bdd->prepare($sql);
    	$q->execute(array($title,$start,$end,$id));
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
    	
    	try {
    		$bdd = new PDO('mysql:host=localhost;dbname=charlenetas_geekdb', 'root', 'root');
    	} catch(Exception $e) {
    		exit('Imposible conectar a la base de datos.');
    	}
    	
    	//$citas = new EntCitas();
    	//$comparar = $citas->find()->where(['start'=>$cita->start])->one();
    	
    	//if($comparar == false){
	    	$sql = "INSERT INTO ent_citas (title, start, end, id_usuario, txt_token) VALUES (:title, :start, :end, :id_usuario, :txt_token)";
    		$q = $bdd->prepare($sql);
    		$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end, ':id_usuario'=>$id_usuario, ':txt_token'=>$txt_token));
    	//}else 
    		//echo "Ya hay una cita a esa hora  ";
    }
}
