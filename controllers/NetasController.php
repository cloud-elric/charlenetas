<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\EntPostsExtend;
use app\models\EntComentariosPosts;
use app\models\EntComentariosPostsExtend;
use app\models\EntUsuariosSubscripciones;
use app\models\EntEspejos;
use app\modules\ModUsuarios\models\Utils;
use app\models\CatTiposFeedback;
use app\models\EntUsuariosFeedbacks;
use app\models\ViewContadorFeedbackComentarios;
use app\models\EntUsuariosLikePost;
use app\models\EntUsuariosCalificacionAlquimia;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\modules\ModUsuarios\models\LoginForm;
use app\models\CatTiposPosts;
use app\models\ConstantesWeb;
use app\models\EntPosts;
use app\models\EntAlquimias;

class NetasController extends Controller {
	
	/**
	 * Definicion de permisos
	 *
	 * {@inheritdoc}
	 *
	 * @see \yii\base\Component::behaviors()
	 */
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => \yii\filters\AccessControl::className (),
						'only' => [ 
								'des-suscripcion-espejo',
								'suscripcion-espejo',
								'comentar-post',
								'agregar-feedback',
								'like-post',
								'cargar-input-comentario',
								'calificar-alquimia',
								'get-calificacion-usuario',
								'validar-respuesta',
								'perfil-usuario' 
						],
						'rules' => [
								
								// allow authenticated users
								[ 
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				] 
		];
		// everything else is denied
	}
	
	
	/**
	 * Obtenemos la calificacion del usuario logueado
	 *
	 * @param unknown $token        	
	 */
	public function actionGetCalificacionUsuario($token) {
		
		// Layout
		$this->layout = false;
		
		// usuario logueado
		$usuario = Yii::$app->user->identity;
		
		// Buscamos el post
		$post = $this->getPostByToken ( $token );
		
		// Busca el registro de la calificacion del usuario
		$calificacionUsuario = Yii::$app->user->identity->getEntUsuariosCalificacionAlquimias ()->where ( [ 
				'id_post' => $post->id_post 
		] )->one ();
		
		// Obtenemos la calificacion del usuario
		if ($calificacionUsuario) {
			$numCalificacion = $calificacionUsuario->num_calificacion;
		} else {
			$numCalificacion = 0;
		}
		
		echo $numCalificacion;
	}
	
	/**
	 * Obtiene el comentario input
	 *
	 * @param unknown $token        	
	 * @return string
	 */
	public function actionCargarInputComentario($token) {
		// Layout
		$this->layout = false;
		
		// Buscamos el post
		$post = $this->getPostByToken ( $token );
		
		// pinta el input
		echo $this->render ( 'include/elementos/inputComentario', [ 
				'token' => $post->txt_token,
				'respuesta' => false 
		] );
	}
	
	/**
	 * Obtiene el input de la respuesta
	 *
	 * @param unknown $token        	
	 */
	public function actionCargarInputRespuesta($token) {
		// Layout
		$this->layout = false;
		
		// Buscamos el post
		$comentario = $this->getComentarioByToken ( $token );
		
		// pinta el input
		echo $this->render ( 'include/elementos/inputComentario', [ 
				'token' => $comentario->txt_token,
				'respuesta' => true 
		] );
	}
	
	/**
	 * Valida al usuario
	 */
	public function actionValidacionUsuario() {
		$model = new LoginForm ();
		$model->scenario = 'login';
		if (Yii::$app->request->isAjax && $model->load ( Yii::$app->request->post () )) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate ( $model );
		}
	}
	
	/**
	 * Busca todos los post por orden de fecha de publicacion
	 */
	public function actionIndex() {
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPostByPagination ();
		
		// Tipos de post
		$tiposPost = CatTiposPosts::find ()->where ( [ 
				'b_habilitado' => 1 
		] )->all ();
		
		// Pintar vista
		return $this->render ( 'index', [ 
				'listaPost' => $listaPost,
				'tiposPost' => $tiposPost 
		] );
	}
	
	/**
	 * Obtiene los post por paginacion
	 */
	public function actionGetMasPosts($page = 1) {
		
		// Layout que usara la vista
		$this->layout = false;
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPostByPagination ( $page );
		
		// Pintar vista
		return $this->render ( 'masPosts', [ 
				'listaPost' => $listaPost 
		] );
	}
	
	/**
	 * Carga un post por su token
	 *
	 * @param unknown $token        	
	 */
	public function actionCargarPost($token) {
		
		// Layout que usara la vista
		$this->layout = false;
		
		// Se obtiene el post por el token. En caso de no encontrarse lanzara una excepcion
		$post = $this->getPostByToken ( $token );
		
		// si el post es tipo
		if ($post->id_tipo_post == ConstantesWeb::POST_TYPE_CONTEXTO) {
			$contextoPadre = $post->entContextos;
			if (! empty ( $contextoPadre->id_contexto_padre )) {
				
				$post = EntPosts::find ()->where ( [ 
						'id_post' => $contextoPadre->id_contexto_padre 
				] )->one ();
			}
		}
		
		// Nombre de la vista (Tarjeta con datos completos) que se mostraran
		$render = $this->cargarTarjetaCompleta ( $post->id_tipo_post );
		
		// Vista a pintar pasando el registro encontrado
		return $this->render ( $render, [ 
				'post' => $post 
		] );
	}
	
	/**
	 * Carga comentarios de un post
	 *
	 * @param string $token        	
	 * @param number $page        	
	 * @return string
	 */
	public function actionCargarComentarios($token, $page = 0) {
		// Layout que usara la vista
		$this->layout = false;
		
		// Se obtiene el post por el token. En caso de no encontrarse lanzara una excepcion
		$post = $this->getPostByToken ( $token );
		
		// Cargar los comentarios del post
		$comentarios = EntComentariosPostsExtend::getComentariosPostByPagination ( $post->id_post, $page );
		
		// Tipos de feedbacks
		$feedbacks = $this->obtenerTiposFeedbacks ();
		
		// Pintar vista
		return $this->render ( '_comentariosPost', [ 
				'comentarios' => $comentarios,
				'post' => $post,
				'feedbacks' => $feedbacks,
				'respuestas' => false 
		] );
	}
	
	/**
	 * Suscribe al usuario a un post de tipo espejo
	 *
	 * @param string $token        	
	 * @return json
	 */
	public function actionSuscripcionEspejo($token = null) {
		$this->layout = false;
		
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Obtenemos el post
		$post = $this->getPostByToken ( $token );
		
		// Verificamos si el usuario ya se subscribio al post
		$suscripcion = new EntUsuariosSubscripciones ();
		$existeSubscripcion = $suscripcion->existsSubscripcion ( $idUsuario, $post->id_post );
		
		// Si el usuario ya esta subscrito le decimos al usuario que no
		if ($existeSubscripcion) {
			echo 'subscrito';
			return;
		}
		
		// Se guarda la subscripcion del usuario
		$suscripcion->guardarSubscripcion ( $idUsuario, $post->id_post );
		
		// Si se guardo la subscripcion exitosamente la respuesta sera si
		if (! $suscripcion) {
			echo 'error';
			return;
		}
		
		// Actualiza el contador de espejo
		$this->actualizarSubscriptoresEspejo ( $post->id_post );
		
		// Impresion de la respuesta
		echo 'success';
	}
	
	/**
	 * Remueve la subscripcion de un usuario
	 *
	 * @param unknown $token        	
	 */
	public function actionDesSuscripcionEspejo($token = null) {
		$this->layout = false;
		
		$idUsuario = Yii::$app->user->identity->id_usuario;
		;
		
		// Obtenemos el post
		$post = $this->getPostByToken ( $token );
		
		// Verificamos si el usuario ya se subscribio al post
		$existeSubscripcion = EntUsuariosSubscripciones::findSubscripcion ( $idUsuario, $post->id_post );
		
		// Si el usuario ya esta subscrito le decimos al usuario que no
		if ($existeSubscripcion) {
			$existeSubscripcion->delete ();
			$this->actualizarSubscriptoresEspejo ( $post->id_post );
			echo 'success';
		} else {
			echo 'sinSubscripcion';
		}
	}
	
	/**
	 * Usuario comenta post
	 *
	 * @param unknown $token        	
	 */
	public function actionComentarPost($token = null) {
		$this->layout = false;
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Obtenemos el post
		$post = $this->getPostByToken ( $token );
		
		$comentario = new EntComentariosPosts ();
		$comentario->load ( Yii::$app->request->post () );
		
		if ($comentario->guardarComentarioUsuario ( $idUsuario, $post->id_post )) {
			// Tipos de feedbacks
			$feedbacks = $this->obtenerTiposFeedbacks ();
			
			return $this->render ( 'include/elementos/comentario', [ 
					'comentario' => $comentario,
					'feedbacks' => $feedbacks,
					'respuesta' => false 
			] );
		}
	}
	
	/**
	 * Guardamos un punto dependiendo del feedback del usuario
	 *
	 * @param string $token
	 *        	token del comentario
	 * @param string $feed        	
	 */
	public function actionAgregarFeedback($token, $feed) {
		$this->layout = false;
		
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		$comentario = $this->getComentarioByToken ( $token );
		$feedback = $this->getFeedbackByToken ( $feed );
		
		// Revisa si existe un registro previo
		if (! ($usuarioFeedback = EntUsuariosFeedbacks::existFeedbackUsuario ( $idUsuario, $comentario->id_comentario_post, $feedback->id_tipo_feedback ))) {
			// Generar un registro para el usuario
			$entUsuariosFeedbacks = new EntUsuariosFeedbacks ();
			$entUsuariosFeedbacks->guardarUsuarioFeed ( $idUsuario, $comentario->id_comentario_post, $feedback->id_tipo_feedback );
		} else {
			$usuarioFeedback->delete ();
		}
		
		// Generar contador
		$feedbackComentarios = ViewContadorFeedbackComentarios::find ()->where ( [ 
				'id_comentario' => $comentario->id_comentario_post,
				'id_tipo_feedback' => $feedback->id_tipo_feedback 
		] )->one ();
		
		// Si existen feedbacks al comentario
		if ($feedbackComentarios) {
			$feedbackComentarios = $feedbackComentarios->num_usuarios;
		} else {
			$feedbackComentarios = 0;
		}
		
		// Asignar contador
		switch ($feedback->id_tipo_feedback) {
			case 1 : // like
				$comentario->num_likes = $feedbackComentarios;
				break; // no like
			case 2 :
				$comentario->num_dislikes = $feedbackComentarios;
				break;
			case 3 : // troll
				$comentario->num_trolls = $feedbackComentarios;
				break;
		}
		
		// Actualizar los comentarios para que sepamos cuantos hay de cada cosa
		$comentario->save ();
	}
	
	/**
	 * Da like a un post
	 *
	 * @param unknown $token        	
	 */
	public function actionLikePost($token) {
		// no se usara un layout
		$this->layout = false;
		
		// id del usuario logueado
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		
		// Si el usuario no le ha dado like al post guardamos su like
		if (! ($usuarioLike = EntUsuariosLikePost::existsUsuarioLike ( $idUsuario, $post->id_post ))) {
			
			// Guarda el registro
			$usuarioLike = new EntUsuariosLikePost ();
			$usuarioLike->guardarUsuarioLike ( $idUsuario, $post->id_post );
		} else {
			// Elimina el like del usuario al post
			$usuarioLike->delete ();
		}
		
		// Obtenemos el numero de likes del post
		$numLikes = $post->viewContadorLikes;
		
		// Si no existen likes
		if (! $numLikes) {
			$numLikes = 0;
		} else {
			$numLikes = $numLikes->num_likes;
		}
		
		// Actualizamos los like del post
		$post->actualizarNumLikes ( $numLikes );
	}
	
	/**
	 * Califica usuario un post de tipo alquimia
	 *
	 * @param unknown $token        	
	 */
	public function actionCalificarAlquimia($token, $calificacion = 0) {
		// no se usara un layout
		$this->layout = false;
		
		// id del usuario logueado
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Busca el post por el token
		$post = $this->getPostByToken ( $token );
		
		// Si el usuario no ha dado calificacion guardamos su calificacion
		if (! ($calificacionUsuario = EntUsuariosCalificacionAlquimia::existsCalificacionUsuario ( $idUsuario, $post->id_post ))) {
			$usuarioCalificacion = new EntUsuariosCalificacionAlquimia ();
			$usuarioCalificacion->guardarCalificacionUsuario ( $idUsuario, $post->id_post, $calificacion );
			
			// Obtenemos el numero de likes del post
			$alquimia = $post->entAlquimias;
			$numCalificaciones = $alquimia->calificacionAlquimia;
			
			// Si existe calificaciones
			if ($numCalificaciones) {
				$alquimia->actualizarCalificacion ( $numCalificaciones->num_calificacion );
			} else {
				echo 'nada se encontro';
			}
		} else {
			$calificacionUsuario->num_calificacion = $calificacion;
			$calificacionUsuario->save ();
		}
	}
	
	/**
	 * Carga las respuesta de un comentario
	 *
	 * @param unknown $token        	
	 * @param unknown $page        	
	 */
	public function actionCargarRespuestas($token, $page) {
		
		// no se usara un layout
		$this->layout = false;
		
		// Busca el comentario por el token
		$comentario = $this->getComentarioByToken ( $token );
		
		// Busqueda de las respuestas por la paginacion
		$respuestasComentario = EntComentariosPosts::getRespuestasComentario ( $comentario->id_comentario_post, $page );
		
		// Tipos de feedbacks
		$feedbacks = $this->obtenerTiposFeedbacks ();
		
		// Pintar vista
		return $this->render ( '_comentariosPost', [ 
				'comentarios' => $respuestasComentario,
				'feedbacks' => $feedbacks,
				'respuestas' => true 
		] );
	}
	
	/**
	 * Agrega respuesta a un comentario
	 *
	 * @param unknown $token        	
	 */
	public function actionResponderComentario($token) {
		// no se usara un layout
		$this->layout = false;
		
		// id del usuario logueado
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Busca el comentario por el token
		$comentario = $this->getComentarioByToken ( $token );
		
		$respuesta = new EntComentariosPosts ();
		$respuesta->load ( Yii::$app->request->post () );
		
		$respuesta->id_comentario_padre = $comentario->id_comentario_post;
		
		if ($respuesta->guardarComentarioUsuario ( $idUsuario, $comentario->id_post )) {
			// Tipos de feedbacks
			$feedbacks = $this->obtenerTiposFeedbacks ();
			
			return $this->render ( 'include/elementos/comentario', [ 
					'comentario' => $respuesta,
					'feedbacks' => $feedbacks,
					'respuesta' => true 
			] );
		}
	}
	
	/**
	 * Muestra la ventana de perfil del usuario
	 */
	public function actionPerfilUsuario() {
		// id del usuario logueado
		$idUsuario = Yii::$app->user->identity->id_usuario;
		
		// Buscamos el usuario
		$usuario = EntUsuarios::findOne ( $idUsuario );
		
		return $this->render ( 'perfilUsuario', [ 
				'usuario' => $usuario 
		] );
	}
	
	/**
	 * Ventana para comprar creditos
	 */
	public function actionComprarCreditos() {
	}
	
	/**
	 * Valida la respuesta del usuario con la respuesta correcta
	 *
	 * @param unknown $token        	
	 */
	public function actionValidarRespuesta($token) {
		// busca el post necesario
		$post = $this->getPostByToken($token);
		
		$sabiasQue = $post->entSabiasQue;
		
	}
	
	/**
	 * Busca un comentario por su token
	 *
	 * @param unknown $token        	
	 * @throws NotFoundHttpException
	 * @return EntComentariosPosts
	 */
	private function getComentarioByToken($token) {
		if (($comentario = EntComentariosPostsExtend::getComentarioByToken ( $token )) !== null) {
			return $comentario;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/**
	 * Busca un feedback por su token
	 *
	 * @param unknown $token        	
	 * @throws NotFoundHttpException
	 * @return CatTiposFeedback
	 */
	private function getFeedbackByToken($token) {
		if (($feedback = CatTiposFeedback::getFeedbackByToken ( $token )) !== null) {
			return $feedback;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/**
	 * Obtenemos todos los tipos de feedbacks para un comentario
	 *
	 * @return \yii\db\ActiveRecord[]
	 */
	private function obtenerTiposFeedbacks() {
		$feedbacks = CatTiposFeedback::find ()->all ();
		
		return $feedbacks;
	}
	
	/**
	 * Actualiza la subscripcion de un espejo
	 *
	 * @param unknown $idPost        	
	 */
	private function actualizarSubscriptoresEspejo($idPost) {
		// Actualiza el contador de espejo
		$espejo = EntEspejos::find ()->where ( [ 
				'id_post' => $idPost 
		] )->one ();
		$espejo->num_subscriptores = count ( $espejo->entUsuariosSubscripciones );
		$espejo->save ();
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
	
	/**
	 * Dependiendo del token regresa un string con el render de la tarjeta
	 *
	 * @param unknown $tipoTarjeta        	
	 * @return string
	 */
	private function cargarTarjetaCompleta($tipoTarjeta) {
		switch ($tipoTarjeta) {
			case 1 : // Espejo
				$render = '//netas/include/_espejoTarjetaCompleta';
				break;
			case 2 : // Alquimia
				$render = '//netas/include/_alquimiaTarjetaCompleta';
				break;
			case 3 : // Verdadazos
				$render = '//netas/include/_verdadazosTarjetaCompleta';
				break;
			case 4 : // Hoy pense
				$render = '//netas/include/_hoyPenseTarjetaCompleta';
				break;
			case 5 : // Media
				$render = '//netas/include/_mediaTarjetaCompleta';
				break;
			case 6 : // En contexto
				$render = '//netas/include/_contextoTarjetaCompleta';
				break;
			case 7 : // Solo por hoy
				$render = '//netas/include/_soloPorHoyTarjetaCompleta';
				break;
			default :
				$render = '//netas/include/_alquimiaTarjetaCompleta';
				break;
		}
		
		return $render;
	}
	public function actionGt($tk) {
		echo Utils::generateToken ( $tk );
	}
	public function actionTest($url) {
	}
}