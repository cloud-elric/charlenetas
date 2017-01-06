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
use app\models\EntPostsExtend;
use app\models\EntRespuestasEspejo;
use app\models\EntNotificaciones;
use app\models\ConstantesWeb;
use sspl\meta\MetaData;
use app\models\CatTiposUsuarios;
use app\models\RelUsuarios;
use app\models\ModUsuariosEntUsuarios;
use app\models\EntUsuariosRespuestasSabiasQue;
use yii\web\NotFoundHttpException;
use app\models\EntClientes;
use app\models\EntAnuncios;
use yii\helpers\Url;
use app\models\EntUsuariosSubscripciones;

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
								'alquimia',
								'contexto',
								'espejo',
								'hoy-pense',
								'media',
								'sabias-que',
								'solo-por-hoy',
								'verdadazos' 
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'dashboard',
												'alquimia',
												'contexto',
												'espejo',
												'hoy-pense',
												'media',
												'sabias-que',
												'solo-por-hoy',
												'verdadazos',
												'usuarios',
												'notificaciones',
												'agenda',
												'habilitar-post',
												'mostrar-actions',
												'deshabilitar-post',
												'crear-alquimia',
												'crear-verdadazos',
												'crear-hoy-pense',
												'crear-media',
												'crear-contexto',
												'crear-solo-por-hoy',
												'crear-sabias-que',
												'editar-alquimia',
												'responder-espejo',
												'editar-verdadazos',
												'editar-hoy-pense',
												'editar-contexto',
												'editar-media',
												'editar-solo-por-hoy',
												'editar-sabias-que',
												'cargar-imagenes',
												'leer-notificacion',
												'asociar-contexto',
												'desasociar-contexto',
												'get-mas-posts-espejo',
												'get-mas-posts-media',
												'get-mas-posts-alquimia',
												'get-mas-posts-hoy-pense',
												'get-mas-posts-sabias-que',
												'get-mas-posts-solo-por-hoy',
												'get-mas-posts-verdadazos' 
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
	
	/**
	 * Action para mostrar el dashboard
	 *
	 * @return string
	 */
	public function actionDashboard() {
		$dashboard = new CatTiposPosts ();
		$posts = $dashboard->find ()->where(['b_habilitado'=>1])->orderBy ( 'txt_nombre ASC' )->all ();
		
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
		
		return $this->render ( 'alquimia', [ 
				"postsAlquimia" => $postsAlquimia 
		] );
	}
	public function actionVerdadazos($page = 0) {
		$idPost = 3;
		$postsVerdadazos = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'verdadazos', [ 
				"postsVerdadazos" => $postsVerdadazos 
		] );
	}
	public function actionHoyPense($page = 0) {
		$idPost = 4;
		$postsHoypense = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'hoyPense', [ 
				"postsHoyPense" => $postsHoypense 
		] );
	}
	public function actionMedia($page = 0) {
		$idPost = 5;
		$postsMedia = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'media', [ 
				"postsMedia" => $postsMedia 
		] );
	}
	public function actionContexto($searchTags = null, $page = 0) {
		$idPost = 6;
		$postsContexto = EntPosts::getPosts ( $page, $idPost, ConstantesWeb::POSTS_MOSTRAR, $searchTags );
		
		return $this->render ( 'contexto', [ 
				"postsContexto" => $postsContexto 
		] );
	}
	public function actionSoloPorHoy($page = 0) {
		$idPost = 7;
		$postsSoloPorHoy = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'soloPorHoy', [ 
				"postsSoloPorHoy" => $postsSoloPorHoy 
		] );
	}
	public function actionSabiasQue($page = 0) {
		$idPost = 8;
		$postsSabiasQue = EntPosts::getPosts ( $page, $idPost );
		
		return $this->render ( 'sabiasQue', [ 
				"postsSabiasQue" => $postsSabiasQue 
		] );
	}
	public function actionNotificaciones() {
		$notificaciones = new EntNotificaciones ();
		$admin = $notificaciones->find ()->where ( [ 
				'id_usuario' => Yii::$app->user->identity 
		] )->andWhere ( [ 
				'b_leido' => 0 
		] )->orderBy ( 'fch_creacion ASC' )->limit ( 15 )->all ();
		
		return $this->render ( 'notificaciones', [ 
				'notificaciones' => $admin 
		] );
	}
	public function actionAgenda() {
		return $this->render ( 'agenda' );
	}
	public function actionHabilitarPost($tokenPost = "post_3f6f718c45db9be09ccf7c5a427cb79557b217121b6bc") {
		$postHabilitar = EntPosts::getPostByToken ( $tokenPost );
		$postHabilitar->b_habilitado = 1;
		
		if ($postHabilitar->save ())
			echo "SUCCESS ";
		else
			echo "ERROR";
	}
	
	// mostrar actions del controlador
	public function actionMostrarActions() {
		// etaData::getControllersActions();
		return $this->render ( 'mostrarActions' );
	}
	public function actionCambiarUser($idUser, $idTipo) {
		$users = new ModUsuariosEntUsuarios ();
		$user = $users->find ()->where ( [ 
				'id_usuario' => $idUser 
		] )->one ();
		
		$user->id_tipo_usuario = $idTipo;
		$user->save ();
	}
	public function actionDeshabilitarPost($tokenPost = null) {
		$postDeshabilitar = EntPosts::getPostByToken ( $tokenPost );
		$postDeshabilitar->b_habilitado = 0;
		
		if ($postDeshabilitar->save ())
			echo "SUCCESS ";
		else
			echo "ERROR";
	}
	public function actionDeshabilitarPostContexto($tokenPost = null) {
		$postDeshabilitar = EntPosts::getPostByToken ( $tokenPost );
		$postDeshabilitar->b_habilitado = 0;
		
		$entContexto = EntContextos::find ()->all ();
		
		foreach ( $entContexto as $contexto ) {
			if ($contexto->id_contexto_padre == $postDeshabilitar->id_post) {
				$contexto->id_contexto_padre = null;
			} else if ($contexto->id_post == $postDeshabilitar->id_post) {
				$contexto->id_contexto_padre = null;
			}
			if ($contexto->save ()) {
				echo "Success ";
			} else {
				// print_r($contexto);
				echo "Error";
			}
		}
		
		if ($postDeshabilitar->save ()) {
			echo "SUCCESS";
		} else {
			echo "ERROR";
		}
	}
	
	/**
	 * Vista creacion de usuarios
	 */
	public function actionCrearUsuarios() {
		return $this->render ( 'crearUsuarios' );
	}
	
	/**
	 * Almacenar usuarios en la tabla
	 */
	public function actionAlmacenarUsuarios() {
		$tipoUsuarios = new CatTiposUsuarios ();
		
		if ($tipoUsuarios->load ( Yii::$app->request->post () )) {
			$tipoUsuarios->save ();
		}
	}
	
	/**
	 * almacena los actions para cada usuario
	 */
	public function actionAlmacenarRol($id_action) {
		$tiposUsuarios = new CatTiposUsuarios ();
		$usuario = $tiposUsuarios->find ()->orderBy ( 'id_tipo_usuario DESC' )->all ();
		
		$relaciones = new RelUsuarios ();
		
		foreach ( $usuario as $us ) {
			$relaciones->id_tipo_usuario = $us->id_tipo_usuario;
			$relaciones->id_action = $id_action;
			$relaciones->save ();
			break;
		}
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
				return [ 
						'status' => 'success',
						't' => $post->txt_titulo,
						'tk' => $post->txt_token 
				];
			}
		}
		
		return $this->renderAjax ( 'crearAlquimia', [ 
				'alquimia' => $alquimia,
				'post' => $post 
		] );
	}
	
	/**
	 * Metodo para la validacion de post
	 *
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
		
		if ($validacion = $this->validarVerdadazos ( $verdadazo )) {
			return $validacion;
		}
		
		if ($verdadazo->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			$verdadazo->id_usuario = $usuario->id_usuario;
			$verdadazo->imagen = UploadedFile::getInstance ( $verdadazo, 'imagen' );
			$verdadazo->txt_imagen = Utils::generateToken ( "img" ) . "." . $verdadazo->imagen->extension;
			$verdadazo->guardarVerdadazos ( $verdadazo );
			
			if ($verdadazo->cargarImagen ( $verdadazo )) {
				
				return [ 
						'status' => 'success',
						't' => $verdadazo->txt_descripcion,
						'tk' => $verdadazo->txt_token 
				];
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
			
			return array_merge ( ActiveForm::validate ( $post ) );
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
		
		if ($validacion = $this->validarVerdadazos ( $hoyPense )) {
			return $validacion;
		}
		
		if ($hoyPense->load ( Yii::$app->request->post () )) {
			
			$usuario = Yii::$app->user->identity;
			
			$hoyPense->imagen = UploadedFile::getInstance ( $hoyPense, 'imagen' );
			$hoyPense->txt_imagen = Utils::generateToken ( "img" ) . "." . $hoyPense->imagen->extension;
			$hoyPense->id_usuario = $usuario->id_usuario;
			
			$hoyPense->guardarHoyPense ( $hoyPense );
			
			if ($hoyPense->cargarImagen ( $hoyPense )) {
				return [ 
						'status' => 'success',
						't' => $hoyPense->txt_titulo,
						'tk' => $hoyPense->txt_token 
				];
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
			
			return array_merge ( ActiveForm::validate ( $post ) );
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
		
		if ($validacion = $this->validarMedia ( $media )) {
			return $validacion;
		}
		
		if ($media->load ( Yii::$app->request->post () )) {
			
			$usuario = Yii::$app->user->identity;
			
			$media->id_usuario = $usuario->id_usuario;
			$media->guardarMedia ( $media );
			
			return [ 
					'status' => 'success',
					't' => "http://img.youtube.com/vi/" . Utils::getIdVideoYoutube ( $media->txt_url ) . "/mqdefault.jpg",
					'tk' => $media->txt_token 
			];
		}
		
		return $this->renderAjax ( 'crearMedia', [ 
				'media' => $media 
		] );
	}
	public function validarMedia($post) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () )) {
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			return array_merge ( ActiveForm::validate ( $post ) );
		}
	}
	
	/**
	 * Guarda contexto
	 */
	public function actionCrearContexto() {
		// Declaracion de modelos
		$contexto = new EntContextos ();
		$post = new EntPosts ( [ 
				'scenario' => 'crearContexto' 
		] );
		
		// usuario logueado
		$usuario = Yii::$app->user->identity;
		
		if ($validacion = $this->validarContexto ( $post, $contexto )) {
			return $validacion;
		}
		
		if ($contexto->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->id_usuario = $usuario->id_usuario;
			$post->guardarContexto ( $contexto, $post );
			
			if ($post->cargarImagen ( $post )) {
				return [ 
						'status' => 'success',
						't' => $post->txt_descripcion,
						'tk' => $post->txt_token 
				];
			}
		}
		
		return $this->renderAjax ( 'crearContexto', [ 
				'contexto' => $contexto,
				'post' => $post 
		] );
	}
	
	/**
	 * Valida contexto
	 */
	public function validarContexto($post, $contexto) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $contexto->load ( Yii::$app->request->post () )) {
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			return array_merge ( ActiveForm::validate ( $post ), ActiveForm::validate ( $contexto ) );
		}
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
		
		if ($validacion = $this->validarSoloPorHoy ( $post, $soloporhoy )) {
			return $validacion;
		}
		
		if ($soloporhoy->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			$usuario = Yii::$app->user->identity;
			$post->id_usuario = $usuario->id_usuario;
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			$post->guardarSoloPorHoy ( $soloporhoy, $post );
			
			if ($post->cargarImagen ( $post )) {
				
				return [ 
						'status' => 'success',
						't' => $post->txt_descripcion,
						'tk' => $post->txt_token 
				];
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
	public function actionCrearSabiasQue($respuesta = null) {
		// Declaracion de modelos
		$sabiasque = new EntSabiasQue ();
		$post = new EntPosts ( [ 
				'scenario' => 'crearSabiasQue' 
		] );
		
		if ($validacion = $this->validarSabiasQue ( $post, $sabiasque )) {
			return $validacion;
		}
	
		if ($sabiasque->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$usuario = Yii::$app->user->identity;
			
			$post->id_usuario = $usuario->id_usuario;
			$post->guardarSabiasQue ( $sabiasque, $post, $respuesta );
			
			return [ 
					'status' => 'success',
					't' => $post->txt_descripcion,
					'tk' => $post->txt_token 
			];
			;
		}
		
		return $this->renderAjax ( 'crearSabiasQue', [ 
				'sabiasque' => $sabiasque,
				'post' => $post 
		] );
	}
	public function validarSabiasQue($post, $sabiasque) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $sabiasque->load ( Yii::$app->request->post () )) {
			// $post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			return array_merge ( ActiveForm::validate ( $post ), ActiveForm::validate ( $sabiasque ) );
		}
	}
	
	/**
	 * Editar alquimia
	 *
	 * @param string $token        	
	 */
	public function actionEditarAlquimia($token = null) {
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		$post->scenario = 'editarAlquimia';
		$post->fch_publicacion = Utils::changeFormatDate ( $post->fch_publicacion );
		// Declaracion de modelos
		$alquimia = $post->entAlquimias;
		
		// Validacion de los modelos
		if ($validacion = $this->validarAlquimia ( $post, $alquimia )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($alquimia->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			
			if (! empty ( $post->imagen )) {
				$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			}
			
			$post->id_usuario = $usuario->id_usuario;
			$post->editarAlquimia ( $alquimia, $post );
			
			if (! empty ( $post->imagen )) {
				$post->cargarImagen ( $post );
			}
			
			return [ 
					'status' => 'success',
					't' => $post->txt_titulo,
					'tk' => $post->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formAlquimia', [ 
				'alquimia' => $alquimia,
				'post' => $post 
		] );
	}
	
	/**
	 * Action para responder el espejo
	 *
	 * @param unknown $token        	
	 */
	public function actionResponderEspejo($token = null) {
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		
		$isEdicion = false;
		if ($respuesta = $post->entRespuestasEspejo) {
			$isEdicion = true;
			$respuesta->fch_publicacion_respuesta = Utils::changeFormatDate ( $respuesta->fch_publicacion_respuesta );
		} else {
			$respuesta = new EntRespuestasEspejo ();
		}
		
		$respuesta->id_post = $post->id_post;
		
		if ($validacion = $this->validarRespuestaEspejo ( $respuesta )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($respuesta->load ( Yii::$app->request->post () )) {
			
			$respuesta->guardarRespuesta ( $respuesta );
			
			if ($post->id_usuario != Yii::$app->user->identity->id_usuario) {
				// Guardar la notificacion
// 				$notificaciones = new EntNotificaciones ();
// 				$notificaciones->guardarNotificacionRespuestasAdmin ( $post, $notificaciones );
				
				$usuario = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$post->id_usuario])->one();
				$this->enviarEmailEspejoContestado($usuario, $post->txt_token);
				
				$suscrito = EntUsuariosSubscripciones::find()->where(['id_post'=>$post->id_post])->one();
				if($suscrito){
					$user = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$suscrito->id_usuario])->one();
					$this->enviarEmailSuscritoEspejo($user, $token);
				}
			}
			
			return [ 
					'status' => 'success',
					'tk' => $post->txt_token,
					'e' => $isEdicion 
			];
		}
		
		return $this->renderAjax ( '_formRespuestaEspejo', [ 
				'respuesta' => $respuesta 
		] );
	}
	
	/**
	 * Editar verdadazos
	 *
	 * @param string $token        	
	 */
	public function actionEditarVerdadazos($token = null) {
		// Busca el post por el token
		$verdadazo = $this->getPostByToken ( $token );
		$verdadazo->scenario = 'editarVerdadazos';
		$verdadazo->fch_publicacion = Utils::changeFormatDate ( $verdadazo->fch_publicacion );
		
		// Validacion de los modelos
		if ($validacion = $this->validarVerdadazos ( $verdadazo )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($verdadazo->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$verdadazo->imagen = UploadedFile::getInstance ( $verdadazo, 'imagen' );
			
			if (! empty ( $verdadazo->imagen )) {
				$verdadazo->txt_imagen = Utils::generateToken ( "img" ) . "." . $verdadazo->imagen->extension;
			}
			
			$verdadazo->id_usuario = $usuario->id_usuario;
			$verdadazo->editarVerdadazos ( $verdadazo );
			
			if (! empty ( $verdadazo->imagen )) {
				$verdadazo->cargarImagen ( $verdadazo );
			}
			
			return [ 
					'status' => 'success',
					't' => $verdadazo->txt_descripcion,
					'tk' => $verdadazo->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formVerdadazos', [ 
				'verdadazo' => $verdadazo 
		] );
	}
	
	/**
	 * Editar hoy pense
	 *
	 * @param string $token        	
	 */
	public function actionEditarHoyPense($token = null) {
		// Busca el post por el token
		$hoypense = $this->getPostByToken ( $token );
		$hoypense->scenario = 'editarHoyPense';
		$hoypense->fch_publicacion = Utils::changeFormatDate ( $hoypense->fch_publicacion );
		
		// Validacion de los modelos
		if ($validacion = $this->validarHoyPense ( $hoypense )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($hoypense->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$hoypense->imagen = UploadedFile::getInstance ( $hoypense, 'imagen' );
			
			if (! empty ( $hoypense->imagen )) {
				$hoypense->txt_imagen = Utils::generateToken ( "img" ) . "." . $hoypense->imagen->extension;
			}
			
			$hoypense->id_usuario = $usuario->id_usuario;
			$hoypense->editarHoyPense ( $hoypense );
			
			if (! empty ( $hoypense->imagen )) {
				$hoypense->cargarImagen ( $hoypense );
			}
			
			return [ 
					'status' => 'success',
					't' => $hoypense->txt_titulo,
					'tk' => $hoypense->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formHoypense', [ 
				'hoyPense' => $hoypense 
		] );
	}
	
	/**
	 * Editar contexto
	 *
	 * @param string $token        	
	 */
	public function actionEditarContexto($token = null) {
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		$post->scenario = 'editarHoyPense';
		$post->fch_publicacion = Utils::changeFormatDate ( $post->fch_publicacion );
		
		$contexto = $post->entContextos;
		// Validacion de los modelos
		if ($validacion = $this->validarContexto ( $post, $contexto )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($post->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			
			if (! empty ( $post->imagen )) {
				$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			}
			
			$post->id_usuario = $usuario->id_usuario;
			$post->editarContexto ( $post, $contexto );
			
			if (! empty ( $post->imagen )) {
				$post->cargarImagen ( $post );
			}
			
			return [ 
					'status' => 'success',
					't' => $post->txt_titulo,
					'tk' => $post->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formContexto', [ 
				'post' => $post,
				'contexto' => $contexto 
		] );
	}
	
	/**
	 * Editar Media
	 *
	 * @param string $token        	
	 */
	public function actionEditarMedia($token = null) {
		// Busca el post por el token
		$media = $this->getPostByToken ( $token );
		$media->scenario = 'editarMedia';
		$media->fch_publicacion = Utils::changeFormatDate ( $media->fch_publicacion );
		
		// Validacion de los modelos
		if ($validacion = $this->validarMedia ( $media )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($media->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$media->imagen = UploadedFile::getInstance ( $media, 'imagen' );
			
			if (! empty ( $media->imagen )) {
				$media->txt_imagen = Utils::generateToken ( "img" ) . "." . $media->imagen->extension;
			}
			
			$media->id_usuario = $usuario->id_usuario;
			$media->editarMedia ( $media );
			
			if (! empty ( $media->imagen )) {
				$media->cargarImagen ( $media );
			}
			
			return [ 
					'status' => 'success',
					't' => "http://img.youtube.com/vi/" . Utils::getIdVideoYoutube ( $media->txt_url ) . "/mqdefault.jpg",
					'tk' => $media->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formMedia', [ 
				'media' => $media 
		] );
	}
	
	/**
	 * Editar Solo Por Hoy
	 *
	 * @param string $token        	
	 */
	public function actionEditarSoloPorHoy($token = null) {
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		$post->scenario = 'editarSoloPorHoy';
		$post->fch_publicacion = Utils::changeFormatDate ( $post->fch_publicacion );
		// Declaracion de modelos
		$soloporhoy = $post->entSoloPorHoys;
		
		// Validacion de los modelos
		if ($validacion = $this->validarSoloPorHoy ( $post, $soloporhoy )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($soloporhoy->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			
			if (! empty ( $post->imagen )) {
				$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			}
			
			$post->id_usuario = $usuario->id_usuario;
			$post->editarSoloPorHoy ( $soloporhoy, $post );
			
			if (! empty ( $post->imagen )) {
				$post->cargarImagen ( $post );
			}
			
			return [ 
					'status' => 'success',
					't' => $post->txt_titulo,
					'tk' => $post->txt_token 
			];
		}
		
		return $this->renderAjax ( '_formSoloporhoy', [ 
				'soloporhoy' => $soloporhoy,
				'post' => $post 
		] );
	}
	
	/**
	 * Valida que los campos sean validos
	 */
	public function validarRespuestaEspejo($respuesta) {
		if (Yii::$app->request->isAjax && $respuesta->load ( Yii::$app->request->post () )) {
			
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			return ActiveForm::validate ( $respuesta );
		}
	}
	/**
	 * Editar Sabias Que
	 *
	 * @param string $token        	
	 */
	public function actionEditarSabiasQue($token = null, $respuesta=null) {
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		$post->scenario = 'editarSabiasQue';
		$post->fch_publicacion = Utils::changeFormatDate ( $post->fch_publicacion );
		// Declaracion de modelos
		$sabiasque = $post->entSabiasQue;
		
		// Validacion de los modelos
		if ($validacion = $this->validarSabiasQue ( $post, $sabiasque )) {
			return $validacion;
		}
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($sabiasque->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			
			if (! empty ( $post->imagen )) {
				$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			}
			$sabiasque->b_verdadero = $respuesta;
			$post->id_usuario = $usuario->id_usuario;
			$post->editarSabiasQue ( $sabiasque, $post );
			
			if (! empty ( $post->imagen )) {
				$post->cargarImagen ( $post );
			}
			
			return [ 
					'status' => 'success',
					't' => $post->txt_descripcion,
					'tk' => $post->txt_token,
					'b'=>$sabiasque->b_verdadero
			];
		}
		
		return $this->renderAjax ( '_formSabiasque', [ 
				'sabiasque' => $sabiasque,
				'post' => $post 
		] );
	}
	
	/**
	 * Carga las imagenes disponible de youtube
	 */
	public function actionCargarImagenes() {
		$data = Yii::$app->request->post ();
		
		if (array_key_exists ( 'url', $data ) && ! empty ( $data ['url'] )) {
			$url = $data ['url'];
			$idVideo = Utils::getIdVideoYoutube ( $url );
			
			return $this->renderAjax ( '_cargaImagenes', [ 
					'idVideo' => $idVideo 
			] );
		} else {
			echo 'error';
		}
	}
	
	/**
	 * Busca un post por su token
	 *
	 * @param unknown $token        	
	 * @throws NotFoundHttpException
	 * @return EntPostsExtend
	 */
	private function getPostByToken($token) {
		if (($post = EntPostsExtend::getPostByToken ( $token )) !== null) {
			return $post;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
	public function actionLeerNotificacion($token) {
		$notificaciones = new EntNotificaciones ();
		$notificacion = $notificaciones->find ()->where ( [ 
				'txt_token_objeto' => $token 
		] )->one ();
		
		$notificacion->b_leido = 1;
		$notificacion->save ();
	}
	
	/**
	 * Asocia un contexto con otro
	 *
	 * @param unknown $token1        	
	 * @param unknown $token2        	
	 */
	public function actionAsociarContexto($token1, $token2) {
		Yii::$app->response->format = Response::FORMAT_JSON;
		$post = $this->getPostByToken ( $token1 );
		
		// padre
		$post2 = $this->getPostByToken ( $token2 );
		
		$contexto = $post->entContextos;
		
		if ($post2->entContextos->idContextoPadre) {
			$contexto->id_contexto_padre = $post2->entContextos->idContextoPadre->id_post;
		} else {
			$contexto->id_contexto_padre = $post2->id_post;
		}
		
		if ($contexto->save ()) {
			
			return [ 
					'status' => 'success' 
			];
		}
		
		return [ 
				'status' => 'error' 
		];
	}
	
	/**
	 *
	 * @param unknown $token        	
	 */
	public function actionDesasociarContexto($token) {
		Yii::$app->response->format = Response::FORMAT_JSON;
		$post = $this->getPostByToken ( $token );
		
		$contexto = $post->entContextos;
		
		$contexto->id_contexto_padre = null;
		
		if ($contexto->save ()) {
			
			return [ 
					'status' => 'success' 
			];
		}
		
		return [ 
				'status' => 'error' 
		];
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsEspejo($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_ESPEJO;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsEspejo', [ 
				'postsEspejo' => $listaPost 
		] );
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsMedia($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_MEDIA;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsMedia', [ 
				'postsMedia' => $listaPost 
		] );
	}
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsAlquimia($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_ALQUIMIA;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsAlquimia', [ 
				'postsAlquimia' => $listaPost 
		] );
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsHoyPense($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_HOY_PENSE;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsHoyPense', [ 
				'postsHoyPense' => $listaPost 
		] );
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsSabiasQue($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_SABIAS_QUE;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsSabiasQue', [ 
				'postsSabiasQue' => $listaPost 
		] );
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsSoloPorHoy($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_SOLO_POR_HOY;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsSoloPorHoy', [ 
				'postsSoloPorHoy' => $listaPost 
		] );
	}
	
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPostsVerdadazos($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		$tipoPost = ConstantesWeb::POST_TYPE_VERDADAZOS;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPosts ( $page, $tipoPost );
		
		// Pintar vista
		return $this->renderAjax ( 'itemsVerdadazos', [ 
				'postsVerdadazos' => $listaPost 
		] );
	}
	
	public function actionGetMasUsuarios($page = 1) {
	
		// Layout que usara la vista
		$this->layout = false;
		//$tipoPost = ConstantesWeb::POST_TYPE_ALQUIMIA;
	
		// Recupera n numero de registros por paginacion
		$listaUsuarios = EntUsuarios::getUsuarios( $page );
	
		// Pintar vista
		return $this->renderAjax ( 'itemsUsuarios', [
				'usuarios' => $listaUsuarios
		] );
	}
	
	public function actionClientes(){
		$clientes = EntClientes::find()->where(['b_habilitado'=>1])->all();
		
		return $this->render('clientes',[
				'clientes' =>$clientes
		]);
	}
	
	/**
	 * Guarda cliente
	 */
	public function actionCrearCliente() {
		// Declaracion de modelos
		$cliente = new EntClientes();
	
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($cliente->load ( Yii::$app->request->post ())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$cliente->save();
			
			return [
				'status' => 'success',
				'id' => $cliente->id_cliente,
				'nombre' => $cliente->txt_nombre,
				'correo' => $cliente->txt_correo,
				'tel' => $cliente->num_telefono
			];
		}
	
		return $this->renderAjax ( 'crearCliente', [
				'cliente' => $cliente
		] );
	}
	
	public function actionDeshabilitarCliente($idCliente = null) {
		$clienteDeshabilitar = EntClientes::find()->where(['id_cliente'=>$idCliente])->andWhere(['b_habilitado'=>1])->one();
		$clienteDeshabilitar->b_habilitado = 0;
	
		if ($clienteDeshabilitar->save ())
			echo "cliente deshabilitado";
		else
			echo "error al deshabilitar cliente";
	}
	
	/**
	 * Editar cliente
	 *
	 * @param string $token
	 */
	public function actionEditarCliente($token = null) {
		// Busca el post por el token
		$this->layout = false;
		$cliente = EntClientes::find()->where(['id_cliente'=>$token])->andWhere(['b_habilitado'=>1])->one();
		//$cliente->scenario = 'editarCliente';
	
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($cliente->load ( Yii::$app->request->post ())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$cliente->save();
				
			return [
					'status' => 'success',
					'id' => $cliente->id_cliente,
					'nombre' => $cliente->txt_nombre,
					'correo' => $cliente->txt_correo,
					'tel' => $cliente->num_telefono
			];;
		}
	
		return $this->renderAjax ( '_formCliente', [
				'cliente' => $cliente
		] );
	}
	
	public function actionMostrarAnuncios($idC){
		$cliente = EntClientes::find()->where(['id_cliente'=>$idC])->one();
		$anuncios = EntAnuncios::find()->where(['id_cliente'=>$idC])->andWhere(['b_habilitado'=>1])->orderBy('id_anuncio DESC')->all();
		
		return $this->render('anuncios',[
			'cliente' => $cliente,
			'anuncios' => $anuncios
		]);
	}
	
	public function actionCrearAnuncio($idC = 0){
		$anuncio = new EntAnuncios();
		
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($anuncio->load ( Yii::$app->request->post ())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			$anuncio->imagen = UploadedFile::getInstance ( $anuncio, 'imagen' );
			$anuncio->txt_imagen = Utils::generateToken ( "img" ) . "." . $anuncio->imagen->extension;
			$anuncio->fch_creacion = Utils::getFechaActual();
			$anuncio->fch_creacion = Utils::changeFormatDateInput ( $anuncio->fch_creacion );
			$anuncio->fch_finalizacion = Utils::changeFormatDateInput ( $anuncio->fch_finalizacion );
			$anuncio->save();
			$url = Url::base()."/uploads/imagenesAnuncios/";
			
			$anuncio2 = new EntAnuncios();	
			$anuncio2->imagen2 = UploadedFile::getInstance ( $anuncio2, 'imagen2' );
			$anuncio2->id_anuncio = $anuncio->id_anuncio + 1;
			$anuncio2->id_cliente = $anuncio->id_cliente;
			$anuncio2->txt_imagen = Utils::generateToken ( "img" ) . "." . $anuncio2->imagen2->extension;
			$anuncio2->fch_creacion = Utils::changeFormatDateInput ( $anuncio->fch_creacion );
			$anuncio2->fch_finalizacion = Utils::changeFormatDateInput ( $anuncio->fch_finalizacion );
			$anuncio2->save();
// 			print_r($anuncio2);
// 			exit();
			$anuncio2->cargarImagenAnuncio2( $anuncio2 );
			
			
			if ($anuncio->cargarImagenAnuncio ( $anuncio )) {
				return [
						'status' => 'success',
						'id' => $anuncio->id_anuncio,
						'url' => $url,
						'img' => $anuncio->txt_imagen,
						'id2' => $anuncio2->id_anuncio,
						'img2' => $anuncio2->txt_imagen
				];
			}
		}
		
		return $this->renderAjax ( 'crearAnuncio', [
				'anuncio' => $anuncio,
				'id' => $idC
		] );
	}
	
	public function actionDeshabilitarAnuncio($idA = null) {
		$anuncioDeshabilitar = EntAnuncios::find()->where(['id_anuncio'=>$idA])->andWhere(['b_habilitado'=>1])->one();
		$anuncioDeshabilitar->b_habilitado = 0;
		echo $anuncioDeshabilitar->id_anuncio . "--" . $anuncioDeshabilitar->b_habilitado. "--";

		if ($anuncioDeshabilitar->save(false)){
			echo "anuncio deshabilitado";
		}else{
			print_r($anuncioDeshabilitar->errors);
			echo "error al deshabilitar anuncio";
		}
	}
	
	public function actionEditarAnuncio($token = null) {
		// Busca el post por el token
		$this->layout = false;
		$anuncio = EntAnuncios::find()->where(['id_anuncio'=>$token])->andWhere(['b_habilitado'=>1])->one();
	
		// Si la informacion es enviada se carga a su respectivo modelo
		if ($anuncio->load ( Yii::$app->request->post ())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			$anuncio->fch_creacion = Utils::changeFormatDateInput ( $anuncio->fch_creacion );
			$anuncio->fch_finalizacion = Utils::changeFormatDateInput ( $anuncio->fch_finalizacion );
			$anuncio->imagen = UploadedFile::getInstance ( $anuncio, 'imagen' );
				
			if (! empty ( $anuncio->imagen )) {
				$anuncio->txt_imagen = Utils::generateToken ( "img" ) . "." . $anuncio->imagen->extension;
			}
			
			if (! empty ( $anuncio->imagen )) {
				$anuncio->cargarImagenAnuncio ( $anuncio );
			}
			
			$anuncio->save();
	
			return [
					'status' => 'success',
					'id' => $anuncio->id_anuncio
			];
		}
	
		return $this->renderAjax ( '_formAnuncio', [
				'anuncio' => $anuncio,
				'id' => $anuncio->id_cliente
		] );
	}
	
	private function enviarEmailEspejoContestado($user, $token){
	
		$utils = new Utils();
		$parametrosEmail = [
				'nombre' => $user->txt_username,
				'correo' => $user->txt_email,
				'token' => $token
		];
		
 		$utils->sendPreguntaContestada( $user->txt_email, $parametrosEmail );
	}
	
	private function enviarEmailSuscritoEspejo($user, $token){
	
		$utils = new Utils();
		$parametrosEmail = [
				'nombre' => $user->txt_username,
				'correo' => $user->txt_email,
				'token' => $token
		];
	
		$utils->sendSuscripcion( $user->txt_email, $parametrosEmail );
	}
}