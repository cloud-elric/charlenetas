<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\modules\ModUsuarios\models\Utils;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "ent_comentarios_posts".
 *
 * @property string $id_comentario_post
 * @property string $id_comentario_padre
 * @property string $id_post
 * @property string $id_usuario
 * @property string $txt_comentario
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 * @property EntComentariosPosts $idComentarioPadre
 * @property EntComentariosPosts[] $entComentariosPosts
 * @property EntPosts $idPost
 */
class EntComentariosPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_comentarios_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comentario_padre', 'id_post', 'id_usuario'], 'integer'],
            [['id_usuario', 'txt_comentario'], 'required'],
            [['txt_comentario'], 'string'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_comentario_padre'], 'exist', 'skipOnError' => true, 'targetClass' => EntComentariosPosts::className(), 'targetAttribute' => ['id_comentario_padre' => 'id_comentario_post']],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntPosts::className(), 'targetAttribute' => ['id_post' => 'id_post']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comentario_post' => 'Id Comentario Post',
            'id_comentario_padre' => 'Id Comentario Padre',
            'id_post' => 'Id Post',
            'id_usuario' => 'Id Usuario',
            'txt_comentario' => 'Txt Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(EntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdComentarioPadre()
    {
        return $this->hasOne(EntComentariosPosts::className(), ['id_comentario_post' => 'id_comentario_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntComentariosPosts()
    {
        return $this->hasMany(EntComentariosPosts::className(), ['id_comentario_padre' => 'id_comentario_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntPosts::className(), ['id_post' => 'id_post']);
    }
    
    /**
     * Guarda el comentario del usuario
     * 
     * @param number $idUsuario
     * @param number $idPost
     * @return EntComentariosPosts|NULL
     */
    public function guardarComentarioUsuario($idUsuario, $idPost){
    	$this->id_post = $idPost;
    	$this->id_usuario = $idUsuario;
    	$this->fch_comentario = Utils::getFechaActual();
    	$this->txt_token = Utils::generateToken('com');
    	
    	return $this->save()?$this:null;
    }
    
    
    /**
     * Obtenemos la respuestas del comentario
     * 
     * @param unknown $idComentario
     * @param number $page
     * @param unknown $pageSize
     */
    public static function getRespuestasComentario($idComentario, $page=0, $pageSize=ConstantesWeb::NUMERO_DE_RESPUESTAS){
    	// query de la busqueda
    	$query = EntComentariosPosts::find ()->where ( [
    			'id_comentario_padre'=>$idComentario,
    	] )->andWhere ( [
    			'b_habilitado' => 1,
    	] );
    	
    	// Carga el dataprovider
    	$dataProvider = new ActiveDataProvider( [
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
}
