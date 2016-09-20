<?php

namespace app\modules\modAdminPanel\controllers;

use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\EntComentariosPosts;
use app\models\EntPosts;
use app\models\EntAlquimias;
use Yii;
use app\models\EntContextos;
use app\models\EntSoloPorHoys;
use app\models\EntSabiasQue;
use yii\web\UploadedFile;
use app\modules\ModUsuarios\models\Utils;
use app\modules\modAdminPanel\components\AccessRule;
use yii\filters\AccessControl;
use app\models\CatTiposPosts;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Default controller for the `adminPanel` module
 */
class AdminController extends Controller {
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
								'dashboard',
								'alquimia' 
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'dashboard',
												'alquimia' 
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
	 * 
	 * @return string
	 */
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	public function actionDashboard() {
		$dashboard = new CatTiposPosts ();
		$posts = $dashboard->find ()->orderBy ( 'txt_nombre ASC' )->all ();
		
		return $this->render ( 'dashboard', [ 
				"dashboard" => $posts 
		] );
	}
	
	/**
	 * Los parametros los resive por get
	 * 
	 * @param number $page        	
	 * @param string $q        	
	 * @return string
	 */
	public function actionUsuarios($page = 0, $q = '') {
		/**
		 * getUsuarios es un metodo static para mostrar usuarios con el string $q
		 * 
		 * @var array $usuarios
		 */
		$usuarios = EntUsuarios::getUsuarios ( $page, $q );
		
		return $this->render ( 'usuarios', [ 
				"usuarios" => $usuarios 
		] );
	}
	public function actionEspejo($page = 0) {
		$idPost = 1;
		$postsEspejo = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'espejo', [ 
				"postsEspejo" => $postsEspejo 
		] );
	}
	public function actionAlquimia($page = 0) {
		$idPost = 2;
		$postsAlquimia = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'Alquimia', [ 
				"postsAlquimia" => $postsAlquimia 
		] );
	}
	public function actionVerdadazos($page = 0) {
		$idPost = 3;
		$postsVerdadazos = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'Verdadazos', [ 
				"postsVerdadazos" => $postsVerdadazos 
		] );
	}
	public function actionHoyPense($page = 0) {
		$idPost = 4;
		$postsHoypense = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'HoyPense', [ 
				"postsHoyPense" => $postsHoypense 
		] );
	}
	public function actionMedia($page = 0) {
		$idPost = 5;
		$postsMedia = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'Media', [ 
				"postsMedia" => $postsMedia 
		] );
	}
	public function actionContexto($page = 0) {
		$idPost = 6;
		$postsContexto = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'Contexto', [ 
				"postsContexto" => $postsContexto 
		] );
	}
	public function actionSoloPorHoy($page = 0) {
		$idPost = 7;
		$postsSoloPorHoy = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'SoloPorHoy', [ 
				"postsSoloPorHoy" => $postsSoloPorHoy 
		] );
	}
	public function actionSabiasQue($page = 0) {
		$idPost = 8;
		$postsSabiasQue = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'SabiasQue', [ 
				"postsSabiasQue" => $postsSabiasQue 
		] );
	}
	public function actionNotificaciones() {
		return $this->render ( 'Notificaciones' );
	}
	public function actionAgenda() {
		return $this->render ( 'Agenda' );
	}
	public function actionHabilitarPost($tokenPost = "post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc") {
		$postHabilitar = EntPosts::getPostByToken ( $tokenPost );
		$postHabilitar->b_habilitado = 1;
		
		if ($postHabilitar->save ())
			echo "SUCCESS ";
		else
			echo "ERROR";
	}
	public function actionDeshabilitarPost($tokenPost = "post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc") {
		$postDeshabilitar = EntPosts::getPostByToken ( $tokenPost );
		$postDeshabilitar->b_habilitado = 0;
		
		if ($postDeshabilitar->save ())
			echo "SUCCESS ";
		else
			echo "ERROR";
	}
	
	/**
	 * Guarda alquimia
	 */
	public function actionCrearAlquimia() {
		// Declaracion de modelos
		$alquimia = new EntAlquimias ();
		$post = new EntPosts ( [ 
				'scenario' => 'crearAlquimia' 
		] );
		$alquimia->num_calificacion_admin = 0;
		
		// Validacion de los modelos
		if ($validacion = $this->validarAlquimia ( $post, $alquimia )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($alquimia->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			$post->id_usuario = $usuario->id_usuario;
			$post->guardarAlquimia ( $alquimia, $post );
			
			if ($post->cargarImagen ( $post )) {
				return ['status'=>'success', 't'=>$post->txt_titulo,'tk'=>$post->txt_token];
			}
		}
		
		return $this->renderAjax ( 'crearAlquimia', [ 
				'alquimia' => $alquimia,
				'post' => $post 
		] );
	}
	
	/**
	 * Metodo para la validacion de post
	 * @param EntPosts $post
	 * @param EntAlquimias $alquimia
	 * @return array
	 */
	public function validarAlquimia($post, $alquimia) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $alquimia->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			return array_merge ( ActiveForm::validate ( $post ), ActiveForm::validate ( $alquimia ) );
		}
	}
	
	/**
	 * Guarda Verdadazos
	 */
	public function actionCrearVerdadazos() {
		// Declaracion de modelos
		$verdadazo = new EntPosts ( [ 
				'scenario' => 'crearVerdadazos' 
		] );
		
		if ($validacion = $this->validarVerdadazos( $verdadazo )) {
			return $validacion;
		}
		
		if ($verdadazo->load ( Yii::$app->request->post () )) {
			$verdadazo->imagen = UploadedFile::getInstance ( $verdadazo, 'imagen' );
			$verdadazo->guardarVerdadazos ( $verdadazo );
			
			if ($post->cargarImagen ( $verdadazo )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearVerdadazos', [ 
				'verdadazo' => $verdadazo 
		] );
	}
	public function validarVerdadazos($post) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
				
			return array_merge ( ActiveForm::validate ( $post ));
		}
	}
	
	/**
	 * Guarda HoyPense
	 */
	public function actionCrearHoyPense() {
		// Declaracion de modelos
		$hoyPense = new EntPosts ( [ 
				'scenario' => 'crearHoyPense' 
		] );
		
		if ($validacion = $this->validarVerdadazos( $hoyPense )) {
			return $validacion;
		}
		
		if ($hoyPense->load ( Yii::$app->request->post () )) {
			$hoyPense->imagen = UploadedFile::getInstance ( $hoyPense, 'imagen' );
			$hoyPense->guardarHoyPense ( $hoyPense );
			
			if ($hoyPense->cargarImagen ( $hoyPense )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearHoyPense', [ 
				'hoyPense' => $hoyPense 
		] );
	}
	public function validarHoyPense($post) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
	
			return array_merge ( ActiveForm::validate ( $post ));
		}
	}
	
	/**
	 * Guarda Media
	 */
	public function actionCrearMedia() {
		// Declaracion de modelos
		$media = new EntPosts ( [ 
				'scenario' => 'crearMedia' 
		] );
		
		if ($validacion = $this->validarMedia( $media )) {
			return $validacion;
		}
		
		if ($media->load ( Yii::$app->request->post () )) {
			$media->imagen = UploadedFile::getInstance ( $media, 'imagen' );
			$media->guardarMedia ( $media );
			
			if ($media->cargarImagen ( $media )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearMedia', [ 
				'media' => $media 
		] );
	}
	public function validarMedia($post) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
	
			return array_merge ( ActiveForm::validate ( $post ));
		}
	}
	
	/**
	 * Guarda contexto
	 */
	public function actionCrearContexto() {
		// Declaracion de modelos
		$contexto = new EntContextos ();
		$post = new EntPosts ( [ 
				'scenario' => 'crear' 
		] );
		
		if ($contexto->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->guardarContexto ( $contexto, $post );
			
			if ($post->cargarImagen ( $post )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearContexto', [ 
				'contexto' => $contexto,
				'post' => $post 
		] );
	}
	
	/**
	 * Guarda solo por hoy
	 */
	public function actionCrearSoloPorHoy() {
		// Declaracion de modelos
		$soloporhoy = new EntSoloPorHoys ();
		$post = new EntPosts ( [ 
				'scenario' => 'crearSoloPorHoy' 
		] );
		
		if ($validacion = $this->validarSoloPorHoy( $post, $soloporhoy )) {
			return $validacion;
		}
		
		if ($soloporhoy->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->guardarSoloPorHoy ( $soloporhoy, $post );
			
			if ($post->cargarImagen ( $post )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearSoloPorHoy', [ 
				'soloporhoy' => $soloporhoy,
				'post' => $post 
		] );
	}
	public function validarSoloPorHoy($post, $soloporhoy) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $soloporhoy->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
				
			return array_merge ( ActiveForm::validate ( $post ), ActiveForm::validate ( $soloporhoy ) );
		}
	}
	
	/**
	 * Guarda sabias que
	 */
	public function actionCrearSabiasQue() {
		// Declaracion de modelos
		$sabiasque = new EntSabiasQue ();
		$post = new EntPosts ( [ 
				'scenario' => 'crearSabiasQue' 
		] );
		
		if ($validacion = $this->validarSoloPorHoy( $post, $sabiasque )) {
			return $validacion;
		}
		
		if ($sabiasque->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->guardarSabiasQue ( $sabiasque, $post );
			
			if ($post->cargarImagen ( $post )) {
				return;
			}
		}
		
		return $this->renderAjax ( 'crearSabiasQue', [ 
				'sabiasque' => $sabiasque,
				'post' => $post 
		] );
	}
	public function validarSabiasQue($post, $sabiasque) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $sabiasque->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
	
			return array_merge ( ActiveForm::validate ( $post ), ActiveForm::validate ( $sabiasque ) );
		}
	}

	
	/**
	 * Editar
	*/ 
	public function actionEditarAlquimia($token = null){
		
		$token = 'post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc';
		$posts = EntPosts::getPosts($page = 0, $token);
		$alquimia = new EntAlquimias();
		
		return $this->render('_formAlquimia',['Alquimia'=>$alquimia, 'posts'=> $posts]);
	}
	

}