<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class EntComentariosPostsExtend extends \yii\db\ActiveRecord {
	
	/**
	 * Obtiene los comentarios de una pagina por una cantidad
	 *
	 * @param integer $page        	
	 * @param integer $pageSize        	
	 */
	public static function getComentariosPostByPagination($idPost=0,$page = 0, $pageSize = 1) {
		
		// query de la busqueda
		$query = EntComentariosPosts::find ()->where ( [ 
				'is',
				'id_comentario_padre',
				null 
		] )->andWhere ( [ 
				'b_habilitado' => 1,
				'id_post'=>$idPost
		] );
		
		// Carga el dataprovider
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query,
				'sort'=> ['defaultOrder' => ['fch_comentario'=>'asc']],
				'pagination' => [ 
						'pageSize' => $pageSize,
						'page' => $page 
				] 
		] );
		
		return $dataProvider->getModels ();
	}
}
