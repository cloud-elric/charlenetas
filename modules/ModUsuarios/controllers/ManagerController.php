<?php

namespace app\modules\ModUsuarios\controllers;

use Yii;
use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\modules\ModUsuarios\models\LoginForm;
use vendor\facebook\FacebookI;
use app\modules\ModUsuarios\models\Utils;
use app\modules\ModUsuarios\models\EntUsuariosActivacion;
use app\modules\ModUsuarios\models\EntUsuariosCambioPass;
use app\modules\ModUsuarios\models\EntUsuariosFacebook;
use yii\web\UploadedFile;
use yii\base\Response;
use app\models\ConstantesWeb;
use yii\widgets\ActiveForm;
use app\models\EntUsuariosCreditos;
use app\models\CatTipoCreditos;

/**
 * Default controller for the `musuarios` module
 */
class ManagerController extends Controller {
	
	/**
	 * Registrar usuario en la base de datos
	 */
	public function actionSignUp() {
		$model = new EntUsuarios ( [ 
				'scenario' => 'registerInput' 
		] );
		
		if ($model->load ( Yii::$app->request->post () )) {
			
			// Validacion de los modelos
			if ($validacion = $this->validarUsuario ( $model )) {
				return $validacion;
			}
			
			// Obtiene la imagen de perfil para le usuario
			$model->imageProfile = UploadedFile::getInstance ( $model, 'imageProfile' );
			if (!empty ( $model->imageProfile )) {
				$nombreImagen = Utils::generateToken ( 'ava' ) . '.' . $model->imageProfile->extension;
				$model->txt_imagen = $nombreImagen;
			}
			if ($user = $model->signup ()) {
				
				if (!empty ( $model->imageProfile )) {
					// Guarda la imagen de usuario
					$model->upload ( $nombreImagen );
				}
				if (Yii::$app->params ['modUsuarios'] ['mandarCorreoActivacion']) {
					
					$activacion = new EntUsuariosActivacion ();
					$activacion->saveUsuarioActivacion ( $user->id_usuario );
					
					// Enviar correo de activación
					$utils = new Utils ();
					// Parametros para el email
					$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
							'activar-cuenta/' . $activacion->txt_token 
					] );
					$parametrosEmail ['user'] = $user->getNombreCompleto ();
					
					// Envio de correo electronico
					$utils->sendBienvenida ( $user->txt_email, $parametrosEmail );
					// $this->redirect ( [
					// 'login'
					// ] );

					//Agregar creditos al usuario por registrarse
					$contestar = CatTipoCreditos::find()->where(['id_credito'=>ConstantesWeb::REGISTRO])->one();
					$userCreditos = new EntUsuariosCreditos();
					$userCreditos->agregarCreditos($user->id_usuario, $contestar->costo);

					return [ 
							'status' => 'success',
							'message'=>$model->nombreCompleto,
					];
				} else {
					
					if (Yii::$app->getUser ()->login ( $user )) {
						return $this->goHome ();
					}
				}
			}
			
			// return $this->redirect(['view', 'id' => $model->id_usuario]);
		}
		return $this->renderAjax ( 'signUp', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Crea peticion para el cambio de contraseña
	 */
	public function actionPeticionActivar() {
	
		$model = new LoginForm ();
		$model->scenario = 'recovery';
		if ($model->load ( Yii::$app->request->post () ) ) {
				
			// Validacion de los modelos
			if ($validacion = $this->validarLogin ( $model )) {
				return $validacion;
			}
				
			$activacion = EntUsuariosActivacion::find()->where(['id_usuario'=> $model->userEncontrado->id_usuario])->one();
			
			if(empty($activacion)){
				$activacion->saveUsuarioActivacion (  $model->userEncontrado->id_usuario );
			}
			
			$user = EntUsuarios::find()->where(['id_usuario'=>$model->userEncontrado->id_usuario])->one();
				
			// Enviar correo de activación
			$utils = new Utils ();
			// Parametros para el email
			$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [
					'activar-cuenta/' . $activacion->txt_token
			] );
			$parametrosEmail ['user'] = $user->getNombreCompleto ();
				
			// Envio de correo electronico
				
			// Envio de correo electronico
			if($utils->sendBienvenida ( $user->txt_email, $parametrosEmail ) ){
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
				return ['status'=>'success'];
			}
		}
	
		if (Yii::$app->request->isAjax) {
	
			return $this->renderAjax ( 'reenviarCodigo', [
					'model' => $model
			] );
		}
	
	}
	
	/**
	 * Crea peticion para el cambio de contraseña
	 */
	public function actionPeticionPass() {
		
		$model = new LoginForm ();
		$model->scenario = 'recovery';
		if ($model->load ( Yii::$app->request->post () ) ) {
			
			// Validacion de los modelos
			if ($validacion = $this->validarLogin ( $model )) {
				return $validacion;
			}
			
			$peticionPass = new EntUsuariosCambioPass ();
			
			$peticionPass->saveUsuarioPeticion ( $model->userEncontrado->id_usuario );
			$user = $peticionPass->idUsuario;
			
			// Enviar correo de activación
			$utils = new Utils ();
			// Parametros para el email
			$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
					'cambiar-pass/' . $peticionPass->txt_token 
			] );
			
			
			$parametrosEmail ['user'] = $user->getNombreCompleto ();
			
			// Envio de correo electronico
			if($utils->sendRecuperarPassword( $user->txt_email, $parametrosEmail )){
				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				
				return ['status'=>'success'];
			}
		}
		
		if (Yii::$app->request->isAjax) {
				
			return $this->renderAjax ( 'peticionPass', [
					'model' => $model
			] );
		}
		
	}
	
	/**
	 * Cambia la contraseña del usuario
	 *
	 * @param string $t        	
	 */
	public function actionCambiarPass($t = null) {
		$peticion = $this->findPeticionByToken ( $t );
		if (empty ( $peticion )) {
			/**
			 *
			 * @todo Poner mensaje de que la peticion ha expirado
			 */
			return $this->goHome();
		}
		
		$model = new EntUsuarios ();
		$model->scenario = 'cambiarPass';
		
		// Si los campos estan correctos por POST
		if ($model->load ( Yii::$app->request->post () )) {
			$user = $peticion->idUsuario;
			$user->setPassword ( $model->password );
			$user->save ();
			
			$peticion->updateUsuarioPeticion ();
			
			if($user->id_status==EntUsuarios::STATUS_PENDIENTED){
				$activacion = EntUsuariosActivacion::find()->where(['id_usuario'=>$user->id_usuario])->one();
				
				if(!empty($activacion)){
					$activacion->actualizaActivacion ();
				}
				
				$user->activarUsuario ();
			}
			
				if (Yii::$app->getUser ()->login ( $user )) {
						return $this->goHome ();
					}
		}
		
		$this->layout = '@app/modules/ModUsuarios/views/manager/mainLogin';
		
		
		return $this->render ( 'cambiarPass', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Activa la cuenta del usuario
	 *
	 * @param string $t        	
	 */
	public function actionActivarCuenta($t = null) {
		$activacion = $this->findActivacionByToken ( $t );
		
		$usuario = $activacion->idUsuario;
		
		if ($usuario->id_status == EntUsuarios::STATUS_ACTIVED) {
			return $this->goHome ();
		}
		
		$usuario->activarUsuario ();
		$activacion->actualizaActivacion ();
		
		if (Yii::$app->getUser ()->login ( $usuario )) {
			Yii::$app->getSession()->setFlash('cuentaActivada', 'Bienvenido. Tu cuenta ha sido activada');
			return $this->goHome ();
		}
	}
	
	/**
	 * Loguea al usuario
	 */
	public function actionLogin() {
		$this->layout = false;
		
		if (! Yii::$app->user->isGuest) {
			
			if (Yii::$app->user->identity->id_tipo_usuario == ConstantesWeb::USUARIO_ADMINISTRADOR) {
				return $this->redirect ( 'adminPanel/admin/dashboard' );
			}
			
			return $this->goHome ();
		}
		
		$model = new LoginForm ();
		$model->scenario = 'login';
		
		// Validacion de los modelos
		if ($validacion = $this->validarLogin ( $model )) {
			return $validacion;
		}
		
		if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
			if (Yii::$app->request->isAjax) {
				return [ 
						'status' => 'success' 
				];
			}
			
			if (Yii::$app->user->identity->id_tipo_usuario == ConstantesWeb::USUARIO_ADMINISTRADOR) {
				return $this->redirect ( 'adminPanel/admin/dashboard' );
			}
			return $this->goBack ();
		}
		if (Yii::$app->request->isAjax) {
			
			return $this->renderAjax ( 'login', [ 
					'model' => $model 
			] );
		}
		$this->layout = '@app/modules/modAdminPanel/views/admin/mainLogin';
		return $this->render ( '@app/modules/modAdminPanel/views/admin/login', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Metodo para la validacion del usuario
	 *
	 * @param EntUsuarios $model        	
	 * @return array
	 */
	public function validarUsuario($model) {
		if (Yii::$app->request->isAjax && $model->load ( Yii::$app->request->post () )) {
			$model->imageProfile = UploadedFile::getInstance ( $model, 'imageProfile' );
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			
			return ActiveForm::validate ( $model );
		}
	}
	
	/**
	 * Metodo para la validacion del usuario
	 *
	 * @param EntUsuarios $model        	
	 * @return array
	 */
	public function validarLogin($model) {
		if (Yii::$app->request->isAjax && $model->load ( Yii::$app->request->post () )) {
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			
			return ActiveForm::validate ( $model );
		}
	}
	
	/**
	 * Callback para facebook
	 */
	public function actionCallbackFacebook() {
		$fb = new FacebookI ();
		
		// Obtenemos la respuesta de facebook
		$data = $fb->recoveryDataUserJavaScript ();
		
		// Si no existe la informacion enviada de facebook
		if (gettype ( $data ) == "string") {
			if ($data == "error" || empty ( $data )) {
				$this->redirect ( [ 
						'site/login' 
				] );
			}
		}
		
		// asi podemos obtener sus datos de los amigos
		// foreach ( $data ['friendsInApp'] as $key => $value ) {
		// $value->id;
		// $value->name;
		// }
		
		// Buscamos al usuario por email
		$existUsuario = EntUsuarios::findByEmail ( $data ['profile'] ['email'] );
		// Si no existe creamos su cuenta
		if (! $existUsuario) {
			$entUsuario = new EntUsuarios ();
			$entUsuario->addDataFromFaceBook ( $data );
			
			$existUsuario = $entUsuario->signup ( true );
			if($existUsuario){
				//Agregar creditos al usuario por registrarse
				$contestar = CatTipoCreditos::find()->where(['id_credito'=>ConstantesWeb::REGISTRO])->one();
				$userCreditos = new EntUsuariosCreditos();
				$userCreditos->agregarCreditos($existUsuario->id_usuario, $contestar->costo);
			}
		}
		
		// Buscamos si existe la cuenta de facebook en la base de datos
		$existUsuarioFacebook = EntUsuariosFacebook::getUsuarioFaceBookByIdFacebook ( $data ['profile'] ['id'] );
		
		// Si no existe
		if (! $existUsuarioFacebook) {
			$existUsuarioFacebook = new EntUsuariosFacebook ();
		}
		
		$existUsuarioFacebook->id_usuario = $existUsuario->id_usuario;
		$usuarioGuardado = $existUsuarioFacebook->saveDataFacebook ( $data );
		
		if (Yii::$app->getUser ()->login ( $existUsuario, 360000 * 24 * 30 )) {
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			
			return [ 
					'status' => 'success' 
			];
		}
		
		return [ 
				'status' => 'error' 
		];
	}
	public function actionTest() {
		$utils = new Utils ();
		$utils->sendEmailActivacion ();
	}
	
	/**
	 * Busca la peticion de cambio de contraseña por el token
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuariosCambioPass
	 */
	protected function findPeticionByToken($t = null) {
		if (($model = EntUsuariosCambioPass::getPeticionByToken ( $t )) !== null) {
			
			return $model;
		}
	}
	
	/**
	 * Busca la activacion por el token
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuariosActivacion
	 * @throws NotFoundHttpException
	 */
	protected function findActivacionByToken($t = null) {
		if (($model = EntUsuariosActivacion::getActivacionByToken ( $t )) !== null) {
			
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/**
	 * Busca al usuario
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuarios
	 * @throws NotFoundHttpException
	 */
	protected function findUsuarioById($id = null) {
		if (($model = EntUsuarios::findIdentity ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
