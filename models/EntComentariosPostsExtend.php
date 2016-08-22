<?php

namespace app\models;

use Yii;
use app\models\ConstantesWeb;
use yii\data\ActiveDataProvider;

class EntComentariosPostsExtend extends \yii\db\ActiveRecord {
	
	/**
	 * Obtiene los comentarios de una pagina por una cantidad
	 *
	 * @param integer $page        	
	 * @param integer $pageSize        	
	 */
	public static function getComentariosPostByPagination($idPost = 0, $page = 0, $pageSize = ConstantesWeb::COMENTARIOS_A_MOSTRAR) {
		
		// query de la busqueda
		$query = EntComentariosPosts::find ()->where ( [ 
				'is',
				'id_comentario_padre',
				null 
		] )->andWhere ( [ 
				'b_habilitado' => 1,
				'id_post' => $idPost 
		] );
		
		// Carga el dataprovider
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query,
				'sort' => [ 
						'defaultOrder' => [ 
								'fch_comentario' => 'asc' 
						] 
				],
				'pagination' => [ 
						'pageSize' => $pageSize,
						'page' => $page 
				] 
		] );
		
		return $dataProvider->getModels ();
	}
	
	/**
	 * Obtiene un comentario por el token
	 * 
	 * @param string $token
	 * @return EntComentariosPosts|NULL
	 */
	public static function getComentarioByToken($token) {
		$comentario = EntComentariosPosts::find ()->where ( [ 
				'txt_token' => $token 
		] )->one ();
		
		return $comentario;
	}
}
