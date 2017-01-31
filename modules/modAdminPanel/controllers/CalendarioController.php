<?php

namespace app\modules\modAdminPanel\controllers;

use Yii;
use yii\web\Controller;
use app\modules\ModUsuarios\models\Utils;
use app\models\EntCitas;
use yii\filters\AccessControl;
use app\modules\modAdminPanel\components\AccessRule;
use app\modules\ModUsuarios\models\EntUsuarios;
use yii\web\Response;
use app\models\EntUsuariosCreditos;
use app\models\CatTipoCreditos;
use app\models\ModUsuariosEntUsuarios;

/**
 * Calendario controller for the `adminPanel` module
 */
class CalendarioController extends Controller
{
	public $layout = 'main';
	
	public function behaviors() {
		// http://code.tutsplus.com/tutorials/how-to-program-with-yii2-user-access-controls--cms-23173
		return [
	
				'access' => [
						'class' => AccessControl::className (),
						// We will override the default rule config with the new AccessRule class
						'ruleConfig' => [
								'class' => AccessRule::className ()
						],
						'only' => [
								'calendario',
								'anadir-citas',
								'actualizar-citas',
								'agregar-citas',
								'eliminar-citas'
						],
						'rules' => [
								[
										'actions' => [
												'calendario',
								'anadir-citas',
								'actualizar-citas',
								'agregar-citas',
								'eliminar-citas'
										],
										'allow' => true,
										// Allow users, moderators and admins to create
										'roles' => [
												EntUsuarios::ROLE_ADMIN
										]
								]
						]
				]
		];
	}
	
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
    	$id_usuario = Yii::$app->user->identity->id_usuario;
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
    	$txt = $_POST['txt'];
    	
    	$entCitas = new EntCitas();
    	$eliminar = $entCitas->find()->where(['id'=>$id])->one();
    	
    	$tipoCredito = new CatTipoCreditos();
    	$costo = $tipoCredito->find()->where(['nombre'=>'Cita'])->one();
    	//$creditos = $creditosUsuarios->find()->where(['id_usuario'=>$id_usuario])->one();
    	
    	$regresar = new EntUsuariosCreditos();
    	$regresar->id_usuario = $eliminar->id_usuario;
    	$regresar->numero_creditos = $costo->costo;
    	$regresar->txt_descripcion = "Devolucion cita";
    	$regresar->save();
    	
    	$eliminar->b_habilitado = 0;
    	$eliminar->title = $txt;
    	$eliminar->save();
    	
    	$user = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$eliminar->id_usuario])->one();
    	$this->enviarEmailCambioCita($user, $eliminar);
    }
    
    /**
     * Verificacion de citas por el admin
     */
    public function actionVerificarCitas(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	
    	$id = $_POST['id'];
    	 
    	$entCitas = new EntCitas();
    	$verificar = $entCitas->find()->where(['id'=>$id])->one();
    	 
    	$verificar->b_activo = 1;
    	$verificar->save();
    	
    	$user = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$verificar->id_usuario])->one();
    	$this->enviarEmailAceptarCita($user);
    	
    	return ['id' => $verificar->id];
    }
    
    private function enviarEmailCambioCita($user, $cita){
    	$utils = new Utils();
    	$parametrosEmail = [
    		'nombre' => $user->txt_username,
    		'ap_paterno' => $user->txt_apellido_paterno,
    		'correo' => $user->txt_email,
    		'desc' => $cita->title
    	];
    	
    	$utils->sendCambioCita($user->txt_email, $parametrosEmail );
    }
    
    private function enviarEmailAceptarCita($user){
    	$utils = new Utils();
    	$parametrosEmail = [
    			'nombre' => $user->txt_username,
    			'ap_paterno' => $user->txt_apellido_paterno,
    			'correo' => $user->txt_email,
    	];
    	 
    	$utils->sendAceptarCita($user->txt_email, $parametrosEmail );
    }
}
