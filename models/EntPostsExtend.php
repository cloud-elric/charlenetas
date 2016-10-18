<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\ConstantesWeb;

class EntPostsExtend extends EntPosts
{
	
    /**
     * Obtiene post indicados por paginacion y cantidad por pagina
     *
     * @param integer $page
     * @param integer $pageSize
     */
	public static function getPostByPagination($page = 0, $pageSize=ConstantesWeb::PINS_A_MOSTRAR){

		$query = EntPosts::find('fch_publicacion <=NOW() AND b_habilitado=1');

		// Carga el dataprovider
		$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'sort'=> ['defaultOrder' => ['fch_publicacion'=>'asc']],
				'pagination' => [
						'pageSize' => $pageSize,
						'page' => $page
				]
		]);

		return $dataProvider->getModels();
	}
	
	/**
	 * Obtiene post indicados por paginacion y cantidad por pagina
	 *
	 * @param integer $page
	 * @param integer $pageSize
	 */
	public static function getPostPorPaginacion($page = 0, $pageSize=ConstantesWeb::POSTS_MOSTRAR){
	
		$query = EntPosts::find('fch_publicacion <=NOW() AND b_habilitado=1');
	
		// Carga el dataprovider
		$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'sort'=> ['defaultOrder' => ['fch_publicacion'=>'asc']],
				'pagination' => [
						'pageSize' => $pageSize,
						'page' => $page
				]
		]);
	
		return $dataProvider->getModels();
	}
	
	

	/**
	 * Busca un post por el token
	 * @param unknown $token
	 * @return * @return EntPostsExtend | NULL
	 */
	public static function getPostByToken($token){
		return EntPosts::find()->where(['txt_token'=>$token])->one();
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntRespuestasEspejo()
	{
		return $this->hasOne(EntRespuestasEspejo::className(), ['id_post' => 'id_post']);
	}
	
}
