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
												'verdadazos'
												
												
												
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
		
		$token_post = "com2fe4b8b63ae89b5d7661dee3f5151e9757eaa75c65b4d";
		$usuario = EntComentariosPosts::find()->where(['txt_token'=>$token_post]);
		
		return $this->render ( 'Notificaciones', ["notificaciones"=>$usuario]);
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
			
			$verdadazo->imagen = UploadedFile::getInstance ( $verdadazo, 'imagen' );
			$verdadazo->txt_imagen = Utils::generateToken ( "img" ) . "." . $verdadazo->imagen->extension;
			$verdadazo->guardarVerdadazos ( $verdadazo );
			
			if ($verdadazo->cargarImagen ( $verdadazo )) {

				return ['status'=>'success', 't'=>$verdadazo->txt_descripcion,'tk'=>$verdadazo->txt_token];
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
			

			
				return ['status'=>'success', 't'=>"http://img.youtube.com/vi/".Utils::getIdVideoYoutube($media->txt_url)."/mqdefault.jpg",'tk'=>$media->txt_token];
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
		
		if ($validacion = $this->validarSoloPorHoy ( $post, $soloporhoy )) {
			return $validacion;
		}
		
		if ($soloporhoy->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			
			$usuario = Yii::$app->user->identity;
			
			$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
			$post->txt_imagen = Utils::generateToken ( "img" ) . "." . $post->imagen->extension;
			$post->guardarSoloPorHoy ( $soloporhoy, $post );
			
			if ($post->cargarImagen ( $post )) {

				return ['status'=>'success', 't'=>$post->txt_descripcion,'tk'=>$post->txt_token];

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
		
		if ($validacion = $this->validarSoloPorHoy ( $post, $sabiasque )) {
			return $validacion;
		}
		
		if ($sabiasque->load ( Yii::$app->request->post () ) && $post->load ( Yii::$app->request->post () )) {
			$usuario = Yii::$app->user->identity;
			
			$post->id_usuario = $usuario->id_usuario;
			$post->guardarSabiasQue ( $sabiasque, $post );
			

				return ['status'=>'success', 't'=>$post->txt_descripcion,'tk'=>$post->txt_token];;

		}
		
		return $this->renderAjax ( 'crearSabiasQue', [ 
				'sabiasque' => $sabiasque,
				'post' => $post 
		] );
	}
	public function validarSabiasQue($post, $sabiasque) {
		if (Yii::$app->request->isAjax && $post->load ( Yii::$app->request->post () ) && $sabiasque->load ( Yii::$app->request->post () )) {
			//$post->imagen = UploadedFile::getInstance ( $post, 'imagen' );
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
			
			return [ 
					'status' => 'success',
					'tk' => $post->txt_token,
					'e' => $isEdicion 
			];
		}
		
		return $this->renderAjax ( '_formRespuestaEspejo', [ 
				'respuesta' => $respuesta 
		]
		 );
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
					't' => $media->txt_titulo,
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
		]
		 );
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
	public function actionEditarSabiasQue($token = null) {
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
			
			$post->id_usuario = $usuario->id_usuario;
			$post->editarSabiasQue ( $sabiasque, $post );
			
			if (! empty ( $post->imagen )) {
				$post->cargarImagen ( $post );
			}
			
			return [ 
					'status' => 'success',
					't' => $post->txt_descripcion,
					'tk' => $post->txt_token 
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
					'idVideo'=>$idVideo,
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
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}