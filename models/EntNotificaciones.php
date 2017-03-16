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
            [['id_usuario', 'txt_titulo', 'txt_token_objeto', 'txt_descripcion'], 'required'],
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
     * Guarda las notificaciones de las respuestas de los comentario en los posts
     * @param unknown $comentario
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacion($comentario, $notificaciones){
    	
    	$notificaciones->id_usuario = $comentario->id_usuario;
    	$notificaciones->txt_token_objeto = $comentario->txt_token;
    	$notificaciones->txt_descripcion = "te han respondido";
    	$notificaciones->txt_titulo = "te han respondido";
    	
    	
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    	
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	
    	return false;
    }
    
    /**
     * Nofificaciones al admin al hacerle una pregunta espejo
     * @param unknown $post   EntPosts
     * @param unknown $notificaciones  EntNotificaciones
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacionPreguntas($post, $notificaciones){
    	 
    	$notificaciones->id_usuario = 25;//Yii::$app->user->identity->id_usuario;
    	$notificaciones->id_tipo_post = 1;
    	$notificaciones->txt_token_objeto = $post->txt_token;
    	$notificaciones->txt_descripcion = $post->txt_descripcion;
    	$notificaciones->txt_titulo = "Un charlenauta realizó una pregunta";
    	 
    	 
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    			 
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	 
    	return false;
    }
    
    /**
     * Notificaciones a los usuarios al responder un espejo
     * @param unknown $post
     * @param unknown $notificaciones
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacionRespuestasAdmin($post, $notificaciones){
    
    	$notificaciones->id_usuario = $post->id_usuario;
    	$notificaciones->txt_token_objeto = $post->txt_token;
    	$notificaciones->txt_descripcion = "te han respondido tu pregunta";
    	$notificaciones->txt_titulo = "te han respondido tu pregunta";
    
    
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    
    	return false;
    }
    
    /**
     * Notificaciones al admin, si al usuario le gusto la respuesta del admin en espejo
     * @param unknown $post
     * @param unknown $notificaciones
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacionAcuerdo($post, $notificaciones){
    
    	$notificaciones->id_usuario = 25;
    	$notificaciones->id_tipo_post = 1;
    	$notificaciones->txt_token_objeto = $post->txt_token;
    	$notificaciones->txt_descripcion = "Al usuario le gusto o no tu respuesta";
    	$notificaciones->txt_titulo = "Al usuario le gusto o no tu respuesta";
    
    
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    
    	return false;
    }
    
    /**
     * Nofificaciones al admin al hacer una cita
     * @param unknown $cita EntCitas
     * @param unknown $notificaciones  EntNotificaciones
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacionCitas($notificaciones, $title, $txt_token){
    
    	$notificaciones->id_usuario = 25;
    	$notificaciones->txt_token_objeto = $txt_token;
    	$notificaciones->txt_descripcion = "Un charlenauta realizó una cita";
    	$notificaciones->txt_titulo = $title;
    
    
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    
    	return false;
    }
    
    /**
     * Guarda las notificaciones de los comentario en los posts
     * @param unknown $comentario
     * @throws Exception
     * @return boolean
     */
    public function guardarNotificacionComentarioPost($comentario, $notificaciones){
    	$com = EntPosts::find()->where(['id_post'=>$comentario->id_post])->one(); 
    	
    	$notificaciones->id_usuario = 25;
    	$notificaciones->id_tipo_post = $com->id_tipo_post;
    	$notificaciones->txt_token_objeto = $com->txt_token;
    	$notificaciones->txt_descripcion = $comentario->txt_comentario;
    	$notificaciones->txt_titulo = "Un charlenauta comentó un post";
    	 
    	 
    	$transaction = EntNotificaciones::getDb()->beginTransaction ();
    	try {
    		if ($notificaciones->save()) {
    			 
    			$transaction->commit();
    			return true;
    		}
    		//print_r($notificaciones->errors);
    		//exit();
    		$transaction->rollBack ();
    	} catch ( \Exception $e ) {
    		$transaction->rollBack ();
    		throw $e;
    	}
    	 
    	return false;
    }
}
