<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_usuarios_subscripciones".
 *
 * @property string $id_post
 * @property string $id_usuario
 * @property string $b_leido
 *
 * @property EntEspejos $idPost
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntUsuariosSubscripciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_usuarios_subscripciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_post', 'id_usuario'], 'required'],
            [['id_post', 'id_usuario', 'b_leido'], 'integer'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => EntEspejos::className(), 'targetAttribute' => ['id_post' => 'id_post']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'id_usuario' => 'Id Usuario',
            'b_leido' => 'B Leido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(EntEspejos::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(EntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
    
    /**
     * Verifica si el usuario ya se ha inscrito al post espejo
     * @param unknown $idUsuario
     * @param unknown $idPost
     * @return boolean
     */
    public function existsSubscripcion($idUsuario, $idPost){
    	// Busca la subscripcion
    	$subscripcion = $this->findSubscripcion($idUsuario, $idPost);
    	
    	// Si existe
    	if($subscripcion){
    		return true;
    	}
    	
    	return false;
    }
    
    /**
     * Busca subscripcion por usuario y post
     * 
     * @param number $idUsuario
     * @param number $idPost
     * @return EntUsuariosSubscripciones | NULL
     */
    public static function findSubscripcion($idUsuario, $idPost){
    	$subscripcion = EntUsuariosSubscripciones::find()->where(['id_post'=>$idPost, 'id_usuario'=>$idUsuario])->one();
    	
    	return $subscripcion;
    }
    
    /**
     * guardamos la subscripcion del usuario
     * 
     * @param number $idUsuario
     * @param number $idPost
     * @return EntUsuariosSubscripciones|NULL
     */
    public function guardarSubscripcion($idUsuario, $idPost){
    	$this->id_post = $idPost;
    	$this->id_usuario = $idUsuario;
    	
    	return $this->save()?$this:null;
    }
}
