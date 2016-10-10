<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use yii\db\mssql\PDO;

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
    	
    	try {
    		$bdd = new PDO('mysql:host=localhost;dbname=charlenetas_geekdb', 'root', 'root');
    	} catch(Exception $e) {
    		exit('Imposible conectar a la base de datos.');
    	}
    	
    	$sql = "INSERT INTO ent_citas (title, start, end) VALUES (:title, :start, :end)";
    	$q = $bdd->prepare($sql);
    	$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));
    
    }
}
