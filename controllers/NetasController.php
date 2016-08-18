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

class NetasController extends Controller {
	
	/**
	 * Busca todos los post por orden de fecha de publicacion
	 */
	public function actionIndex() {
		
		// Recupera n numero de registros por paginacion
		$listaPost = EntPostsExtend::getPostByPagination ();
		
		// Pintar vista
		return $this->render ( 'index', [ 
				'listaPost' => $listaPost 
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
		
		// Pintar vista
		return $this->render ( '_comentariosPost', [ 
				'comentarios' => $comentarios,
				'post' => $post 
		] );
	}
	
	/**
	 * Suscribe al usuario a un post de tipo espejo
	 *
	 * @param string $token        	
	 * @return json
	 */
	public function actionSuscripcionEspejo($token = null) {
		
		/**
		 *
		 * @todo Colocar al usuario en sesion
		 * @var integer $idUsuario
		 */
		$idUsuario = 18;
		
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
		/**
		 *
		 * @todo Colocar al usuario en sesion
		 * @var integer $idUsuario
		 */
		$idUsuario = 18;
		
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
		/**
		 *
		 * @todo Colocar al usuario en sesion
		 * @var integer $idUsuario
		 */
		$idUsuario = 18;
		
		// Obtenemos el post
		$post = $this->getPostByToken ( $token );
		
		$comentario = new EntComentariosPosts ();
		$comentario->load ( Yii::$app->request->post () );
		
		if ($comentario->guardarComentarioUsuario ( $idUsuario, $post->id_post )) {
			return $this->render ( 'include/elementos/comentario', [ 
					'comentario' => $comentario 
			] );
		}
	}
	
	
	private function obtenerTiposFeedbacks(){
	#$feedbacks = CatTiposFeedback::	
		
	}
	
	/**
	 * Actualiza la subscripcion de un espejo
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
	
	public function actionGt($tk){
		echo Utils::generateToken($tk);
	}
}