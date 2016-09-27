<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_notificaciones".
 *
 * @property string $id_notificacion
 * @property string $id_usuario
 * @property string $txt_titulo
 * @property string $txt_token_objeto
 * @property string $txt_descripcion
 * @property string $b_leido
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class EntNotificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_notificacion', 'id_usuario', 'txt_titulo', 'txt_token_objeto', 'txt_descripcion'], 'required'],
            [['id_notificacion', 'id_usuario', 'b_leido'], 'integer'],
            [['txt_titulo'], 'string', 'max' => 50],
            [['txt_token_objeto'], 'string', 'max' => 60],
            [['txt_descripcion'], 'string', 'max' => 500],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_notificacion' => 'Id Notificacion',
            'id_usuario' => 'Id Usuario',
            'txt_titulo' => 'Txt Titulo',
            'txt_token_objeto' => 'Txt Token Objeto',
            'txt_descripcion' => 'Txt Descripcion',
            'b_leido' => 'B Leido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
    
    /**
     * 
     * @param unknown $id_usuario
     * @param unknown $token_post
     */
    public function respuestarPosts($id_usuario, $token_post){
	    	
    	$notificaciones = EntNotificaciones();
    	
    	$notificaciones->id_usuario = $id_usuario;
    	$notificaciones->txt_token_objeto = $token_post;
    	
    	$transaction = EntNotificaciones::getDb ()->beginTransaction ();
    	try {
    		if ($notificaciones->save ()) {
    	
    			$transaction->commit ();
    			return true;
    		}
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	
    	return false;
    }
}
