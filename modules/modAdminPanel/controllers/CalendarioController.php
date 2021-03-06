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
use app\models\EntNotificaciones;

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
								'eliminar-citas',
								'disponiblidad-tiempo'
						],
						'rules' => [
								[
										'actions' => [
												'calendario',
								'anadir-citas',
								'actualizar-citas',
								'agregar-citas',
								'eliminar-citas',
								'disponibilidad-tiempo'
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
    public function actionCalendario($token = null){
    	if(!empty($token)){
    		$this->leerNotificacion($token);
    	}
    	
    	return $this->render ( '_crearCitas');
    }
    
    /**
     * conecta a la base de datos para mostrar las citas en el calendario
     */
    public function actionAnadirCitas(){
    	
    	$json = array();
    	 
    	$entCitas = new EntCitas();
    	$ordenCitas = $entCitas->find()->where(['b_habilitado'=>1])->orderBy('id ASC')->asArray()->all();
        $respuesta= [];
		//var_dump($ordenCitas);
		//exit();
		foreach($ordenCitas as $cita){
			if($cita['id'] == "disponible"){
				
				unset($cita['rendering']);
				unset($cita['constraint']);
				$cita['id'] = $cita['id_cita'];
			}
			$respuesta[] = $cita;
		}

    	echo json_encode($respuesta);
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
    	$actualizar = $entCitas->find()->where(['id_cita'=>$id])->one();
    	
    	$actualizar->title = $title;
    	$actualizar->start = $start;
    	$actualizar->end = $end;
    	$actualizar->save();
    }
    
    /**
     * Agregar citas a la base de datos
     */
    public function actionAgregarCitas(){
		Yii::$app->response->format = Response::FORMAT_JSON;
    	
    	$title=$_POST['title'];
    	$start=$_POST['start'];
    	$end=$_POST['end'];
    	$id_usuario = 0;//Yii::$app->user->identity->id_usuario;
    	$txt_token = Utils::generateToken ( 'cita_' );
    	
    	$entCitas = new EntCitas();
    	
		$entCitas->id = "disponible";
    	$entCitas->title = $title;
    	$entCitas->start = $start;
    	$entCitas->end = $end;
    	$entCitas->id_usuario = $id_usuario;
    	$entCitas->txt_token = $txt_token;
		$entCitas->rendering = "inverse-background";
		$entCitas->constraint = "disponible";
		$entCitas->overlap = 1;
		$entCitas->b_habilitado = 1;
    	
    	$entCitas->save();
		$idCita = $entCitas->id_cita;

		return [
			"idCita" => $idCita,
			"idUser" => $entCitas->id_usuario
		];
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
    
    public function leerNotificacion($token) {
    	$notificaciones = new EntNotificaciones();
    	$notificacion = $notificaciones->find()->where(['txt_token_objeto' => $token ])->one();
    
    	$notificacion->b_leido = 1;
    	$notificacion->save ();
    }

	public function actionDisponibilidadTiempo(){

		return $this->render('disponibilidad');
	}

	public function actionFormularioCrearDisponibilidad(){
		return $this->renderAjax ( 'crearDisponibilidad', [ 
				
		] );
	}

	/**
     * Datos de usuarios al dar click en la cita
     */
    public function actionDatosUsuarios(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	$idUser = $_POST['idUser'];
    	$idCita = $_POST['idCita'];

		$user = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$idUser])->one();
		$cita = EntCitas::find()->where(['id_cita'=>$idCita])->one();
		
		//Cambiar formato fecha
		$start1 = new \DateTime($cita->start);
		$end1 = new \DateTime($cita->end);
		$horaInicio = date_format($start1, 'g:i A');
		$horaFin = date_format($end1, 'g:i A');
		$fecha = date_format($start1, 'j-F-Y');

		$mes = explode('-', $fecha);
		$meses = array('January'=>'Enero', 'February' =>'Febrero', 'March'=>'Marzo', 'April'=>'Abril', 'May'=>'Mayo', 'June'=>'Junio', 'July'=>'Julio',
		'August'=>'Agosto', 'September'=>'Septiembre', 'October'=>'Octubre', 'November'=>'Noviembre', 'December'=>'Diciembre');
		foreach($meses as $key=>$value){
			if($key == $mes[1]){
				$fecha = $mes[0] . "-" . $value . "-" . $mes[2];
			}
		}
    	
    	return [
			'userNombre' => $user->txt_username,
			'userAp' => $user->txt_apellido_paterno,
			'userEmail' => $user->txt_email,
			'horaInicio' => $horaInicio,
			'horaFin' => $horaFin,
			'fecha' => $fecha
		];
    }
}
